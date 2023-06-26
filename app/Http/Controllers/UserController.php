<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Coupon;
use App\Models\Company;
use App\Models\UserCoupon;
use App\Models\Article;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {
    public function index() {
        Session::start();
        $coupons = Coupon::visible()
            ->OrderBy('coupon_id', 'desc')
            ->take(6)
            ->join('areas', 'coupons.area_id', '=', 'areas.area_id')
            ->select('coupons.*', 'areas.prefecture')
            ->get();

        // コラムの表示
        $articlesQuery = Article::visible();  // コラムデータを取得
        $articles = $articlesQuery->take(3)->get();

        return view('users.index', compact('coupons', 'articles'));
    }

    public function mypage(Request $request) {
        Session::start();
        if (!$request->session()->has('userId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('loginUserForm');
        }
        // ログイン中のユーザーIDを取得
        $userId = $request->session()->get('userId');

        // user_coupon テーブルからユーザーIDに紐付いたクーポンIDを取得
        $savedCoupons = UserCoupon::where('user_id', $userId)->pluck('coupon_id');

        // クーポンIDに対応するクーポン情報を取得
        $coupons = Coupon::whereIn('coupon_id', $savedCoupons)->get();

        return view('users.mypage', ['coupons' => $coupons]);
    }

    public function main(Request $request) {
        Session::start();

        // クーポンの表示
        $selectedArea = $request->input('area');

        $couponsQuery = Coupon::visible()
            ->orderBy('coupon_id', 'desc')
            ->join('areas', 'coupons.area_id', '=', 'areas.area_id')
            ->select('coupons.*', 'areas.prefecture');

        if ($selectedArea && $selectedArea !== 'すべてのエリア') {
            $couponsQuery->where('areas.prefecture', $selectedArea);
        }

        $coupons = $couponsQuery->take(6)->get();

        foreach ($coupons as $coupon) {
            $companyName = Company::where('company_id', $coupon->company_id)->value('company_name');
            $coupon->company_name = $companyName;
        }

        $areas = Area::select('prefecture')->distinct()->get();

        // コラムの表示
        $articlesQuery = Article::visible();  // コラムデータを取得
        $articles = $articlesQuery->take(6)->get();

        return view('users.main', compact('coupons', 'areas', 'articles'));
    }

    public function couponDetail(Request $request) {
        Session::start();
        $couponId = $request->query('coupon_id');
        $coupon = Coupon::find($couponId);

        return view('users.coupon_detail', ['coupon' => $coupon]);
    }

    public function saveCoupon(Request $request) {
        // ユーザーがログインしているかどうかを確認する
        if (!$request->session()->has('userId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('loginUserForm');
        }

        // フォームデータからユーザーIDとクーポンIDを取得する
        $userId = $request->input('user_id');
        $couponId = $request->input('coupon_id');

        // クーポンをuser_couponテーブルに保存する
        $userCoupon = new UserCoupon();
        $userCoupon->user_id = $userId;
        $userCoupon->coupon_id = $couponId;
        $userCoupon->save();

        // クーポン保存後にマイページにリダイレクトする
        return redirect()->route('mypage');
    }

    public function couponUse(Request $request) {
        Session::start();
        $couponId = $request->query('coupon_id');
        $coupon = Coupon::find($couponId);

        return view('users.coupon_use', ['coupon' => $coupon]);
    }

    public function articleDetail(Request $request) {
        Session::start();
        $articleId = $request->query('article_id');
        $article = Article::find($articleId);

        return view('users.article_detail', ['article' => $article]);
    }
}
