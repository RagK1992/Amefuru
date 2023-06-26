<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Company;
use App\Models\Area;
use App\Models\Coupon;

class CompanyController extends Controller {
    public function viewLoginCompany() {
        return view('company.login_for_company');
    }

    public function viewCompanyManage(Request $request) {
        Session::start();
        if (!$request->session()->has('companyId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginCompany');
        }

        // ログインユーザーの company_id を取得
        $companyId = $request->session()->get('companyId');

        // company_id が一致するクーポンデータを取得
        $coupons = Coupon::where('company_id', $companyId)->get();

        return view('company.company_manage', compact('coupons'));
    }

    public function loginCompany(Request $request) {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'メールアドレスは必須入力です。',
                'email.email' => 'メールアドレスは正しくご入力ください。',
                'password.required' => 'パスワードは必須入力です。',
            ]
        );

        $company = Company::where('email', $credentials['email'])->first();

        if ($company && Hash::check($credentials['password'], $company->password)) {
            // セッションを開始する
            Session::start();
            // 認証成功
            $request->session()->put('companyId', $company->company_id);
            return redirect()->route('viewCompanyManage');
        } else {
            // 認証失敗
            return redirect()->back()->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません。']);
        }
    }


    public function companyEdit(Request $request, $coupon_id) {
        Session::start();
        if (!$request->session()->has('companyId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('loginCompanyForm');
        }


        $companies = Company::pluck('company_name', 'company_id');
        $prefectures = Area::pluck('prefecture', 'area_id');
        $coupon = Coupon::findOrFail($coupon_id);

        return view('company.company_edit', compact('companies', 'prefectures', 'coupon'));
    }

    public function companyEditConfirm(Request $request) {
        Session::start();
        if (!$request->session()->has('companyId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('loginCompanyForm');
        }

        $companies = Company::pluck('company_name', 'company_id');
        $prefectures = Area::pluck('prefecture', 'area_id');

        try {
            //値のバリデーション
            $validatedData = $request->validate(
                [
                    'coupon_id' => 'required',
                    'company_id' => 'required',
                    'area_id' => 'required',
                    'coupon_name' => 'required',
                    'coupon_description' => 'required',
                    'expiry' => 'required|date_format:Y-m-d',
                    'terms_and_conditions' => 'required',
                    'coupon_img' => 'required|image|max:2048',
                ],
                [
                    'company_id.required' => '企業名を選択してください',
                    'area_id.required' => '地域名を選択してください',
                    'coupon_name.required' => 'クーポン名は必須入力です。',
                    'coupon_description.required' => 'クーポン内容は必須入力です。',
                    'expiry.required' => '有効期限は必須入力です。',
                    'expiry.date_format' => '有効期限は正しい値を入力してください',
                    'terms_and_conditions.required' => '利用条件は必須入力です。',
                    'coupon_img.required' => '掲載画像は必須です。',
                    'coupon_img.image' => '画像のサイズが容量を超えています',
                ]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            // データ保存時にエラーが発生した場合
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // 画像の保存
        $image = $request->file('coupon_img');
        // ファイル名
        $filename = $image->getClientOriginalName();
        // 新しいファイル名
        $uniqueFilename = uniqid() . '_' . $filename;

        $imagePath = $image->storeAs('img/temp', $uniqueFilename, 'public');

        // 入力値をセッションに保存
        session()->put('coupon_id', $validatedData['coupon_id']);
        session()->put('company_id', $validatedData['company_id']);
        session()->put('area_id', $validatedData['area_id']);
        session()->put('coupon_name', $validatedData['coupon_name']);
        session()->put('coupon_description', $validatedData['coupon_description']);
        session()->put('expiry', $validatedData['expiry']);
        session()->put('terms_and_conditions', $validatedData['terms_and_conditions']);
        session()->put('image_path', $imagePath);

        // クーポンIDに基づいてクーポン情報を取得
        $coupon = Coupon::find($validatedData['coupon_id']);

        // 確認画面にリダイレクト
        return view('company.company_edit_confirm', compact('companies', 'prefectures', 'validatedData', 'imagePath', 'coupon'));
    }

    public function companyEditSubmit(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('companyId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('loginCompanyForm');
        }

        $couponId = $request->input('coupon_id');
        $company_id = session('company_id');
        $area_id = session('area_id');
        $coupon_name = session('coupon_name');
        $coupon_description = session('coupon_description');
        $expiry = session('expiry');
        $terms_and_conditions = session('terms_and_conditions');
        $imagePath = session('image_path');

        // 一時フォルダから指定のフォルダに移動
        $sourcePath = 'public/' . $imagePath;
        $uniqueFilename = uniqid() . '_' . basename($imagePath);
        $destinationPath = 'public/img/' . $uniqueFilename;

        Storage::move($sourcePath, $destinationPath);

        // クーポンを更新
        $coupon = Coupon::find($couponId);
        $coupon->company_id = $company_id;
        $coupon->area_id = $area_id;
        $coupon->coupon_name = $coupon_name;
        $coupon->coupon_description = $coupon_description;
        $coupon->expiry = $expiry;
        $coupon->terms_and_conditions = $terms_and_conditions;
        $coupon->coupon_img = $destinationPath;
        $coupon->save();

        // ログイン画面にリダイレクト
        return Redirect::to('/company_manage');
    }
}
