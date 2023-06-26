<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\UserCoupon;

class CouponController extends Controller {
    public function saveCoupon(Request $request, $couponId) {
        // ログイン中のユーザーIDを取得
        $userId = $request->session()->get('userId');

        // user_coupon テーブルに保存済みのクーポンを登録
        UserCoupon::create([
            'user_id' => $userId,
            'coupon_id' => $couponId,
        ]);

        // user_coupon テーブルからユーザーIDに紐付いたクーポンIDを取得
        $savedCoupons = UserCoupon::where('user_id', $userId)->pluck('coupon_id');

        // クーポンIDに対応するクーポン情報を取得
        $coupons = Coupon::whereIn('coupon_id', $savedCoupons)->get();

        // マイページビューにクーポン情報を渡して表示
        return view('mypage', ['coupons' => $coupons]);
    }
}
