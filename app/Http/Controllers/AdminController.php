<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Area;
use App\Models\Coupon;
use App\Models\Article;

class AdminController extends Controller {
    public function viewLoginAdmin() {
        return view('admin.login_for_admin');
    }

    public function viewAdminManage(Request $request) {
        Session::start();
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $coupons = Coupon::visible()->get(); // クーポンデータを取得
        $articles = Article::visible()->get();  // コラムデータを取得

        return view('admin.admin_manage', compact('coupons', 'articles'));
    }

    public function loginAdmin(Request $request) {
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

        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // セッションを開始する
            Session::start();
            // 認証成功
            $request->session()->put('adminId', $admin->admin_id); // ログインユーザーのIDをセッションに保存
            return redirect()->route('viewAdminManage');
        } else {
            // 認証失敗
            return redirect()->back()->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません。']);
        }
    }

    public function couponRegister(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $companies = Company::pluck('company_name', 'company_id');
        $prefectures = Area::pluck('prefecture', 'area_id');
        return view('admin.coupon_register', compact('companies', 'prefectures'));
    }

    public function couponRegisterConfirm(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $companies = Company::pluck('company_name', 'company_id');
        $prefectures = Area::pluck('prefecture', 'area_id');


        try {
            //値のバリデーション
            $validatedData = $request->validate(
                [
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
        session()->put('company_id', $validatedData['company_id']);
        session()->put('area_id', $validatedData['area_id']);
        session()->put('coupon_name', $validatedData['coupon_name']);
        session()->put('coupon_description', $validatedData['coupon_description']);
        session()->put('expiry', $validatedData['expiry']);
        session()->put('terms_and_conditions', $validatedData['terms_and_conditions']);
        session()->put('image_path', $imagePath);

        // 確認画面にリダイレクト
        return view('admin.coupon_register_confirm', compact('companies', 'prefectures', 'validatedData', 'imagePath'));
    }

    public function couponRegisterSubmit(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

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

        // データを保存
        Coupon::create([
            'company_id' => $company_id,
            'area_id' => $area_id,
            'coupon_name' => $coupon_name,
            'coupon_description' => $coupon_description,
            'expiry' => $expiry,
            'terms_and_conditions' => $terms_and_conditions,
            'coupon_img' => $destinationPath
        ]);

        // ログイン画面にリダイレクト
        return Redirect::to('/admin_manage');
    }

    public function couponEdit(Request $request, $coupon_id) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $companies = Company::pluck('company_name', 'company_id');
        $prefectures = Area::pluck('prefecture', 'area_id');
        $coupon = Coupon::findOrFail($coupon_id);

        return view('admin.coupon_edit', compact('companies', 'prefectures', 'coupon'));
    }

    public function couponEditConfirm(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
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
        return view('admin.coupon_edit_confirm', compact('companies', 'prefectures', 'validatedData', 'imagePath', 'coupon'));
    }

    public function couponEditSubmit(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
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
        return Redirect::to('/admin_manage');
    }

    public function couponDelete(Request $request) {
        $couponId = $request->input('coupon_id');

        // クーポンを論理削除（deletedカラムの値を1に変更）
        $coupon = Coupon::find($couponId);
        $coupon->deleted = 1;
        $coupon->save();

        // 削除が完了したらリダイレクトなどの処理を行う
        // ...

        return redirect()->route('viewAdminManage');
    }

    public function articleRegister() {
        Session::start();
        return view('admin.article_register');
    }

    public function articleRegisterConfirm(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $adminId = $request->session()->get('adminId');
        session()->put('adminId', $adminId);

        try {
            //値のバリデーション
            $validatedData = $request->validate(
                [
                    'article_title' => 'required',
                    'article_description' => 'required',
                    'article_thumbnail' => 'required|image|max:2048',
                ],
                [
                    'article_title.required' => 'コラムタイトルは必須です',
                    'article_description.required' => '本文は必須です',
                    'article_thumbnail.required' => 'サムネイル画像は必須です。',
                    'article_thumbnail.image' => 'サムネイル画像のサイズが容量を超えています',
                ]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            // データ保存時にエラーが発生した場合
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // 画像の保存
        $image = $request->file('article_thumbnail');
        // ファイル名
        $filename = $image->getClientOriginalName();
        // 新しいファイル名
        $uniqueFilename = uniqid() . '_' . $filename;

        $imagePath = $image->storeAs('img/temp', $uniqueFilename, 'public');

        // 入力値をセッションに保存
        session()->put('article_title', $validatedData['article_title']);
        session()->put('article_description', $validatedData['article_description']);
        session()->put('imagePath', $imagePath);

        // 確認画面にリダイレクト
        return view('admin.article_register_confirm', compact('validatedData', 'imagePath'));
    }

    public function articleRegisterSubmit(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $adminId = $request->session()->get('adminId');
        $article_description = $request->input('article_description');
        $article_description = nl2br($article_description);

        $article_title = session('article_title');
        $imagePath = session('imagePath');

        // 一時フォルダから指定のフォルダに移動
        $sourcePath = 'public/' . $imagePath;
        $uniqueFilename = uniqid() . '_' . basename($imagePath);
        $destinationPath = 'public/img/article' . $uniqueFilename;

        Storage::move($sourcePath, $destinationPath);

        // データを保存
        Article::create([
            'admin_id' => $adminId,
            'article_title' => $article_title,
            'article_description' => $article_description,
            'article_thumbnail' => $destinationPath
        ]);

        // ログイン画面にリダイレクト
        return Redirect::to('/admin_manage');
    }

    public function articleEdit(Request $request, $article_id) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $article = Article::findOrFail($article_id);

        return view('admin.article_edit', compact('article'));
    }

    public function articleEditConfirm(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        try {
            //値のバリデーション
            $validatedData = $request->validate(
                [
                    'article_id' => 'required',
                    'article_title' => 'required',
                    'article_description' => 'required',
                    'article_thumbnail' => 'required|image|max:2048',
                ],
                [
                    'article_title.required' => 'コラムタイトルは必須です',
                    'article_description.required' => '本文は必須です',
                    'article_thumbnail.required' => 'サムネイル画像は必須です。',
                    'article_thumbnail.image' => 'サムネイル画像のサイズが容量を超えています',
                ]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            // データ保存時にエラーが発生した場合
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $article_description = $request->input('article_description');
        $article_description = nl2br($article_description);

        // 画像の保存
        $image = $request->file('article_thumbnail');
        // ファイル名
        $filename = $image->getClientOriginalName();
        // 新しいファイル名
        $uniqueFilename = uniqid() . '_' . $filename;

        $imagePath = $image->storeAs('img/temp', $uniqueFilename, 'public');

        // 入力値をセッションに保存
        session()->put('article_id', $validatedData['article_id']);
        session()->put('article_title', $validatedData['article_title']);
        session()->put('article_description', $validatedData['article_description']);
        session()->put('image_path', $imagePath);

        // コラムIDに基づいてクーポン情報を取得
        $article = Article::find($validatedData['article_id']);

        // 確認画面にリダイレクト
        return view('admin.article_edit_confirm', compact('validatedData', 'imagePath', 'article'));
    }

    public function articleEditSubmit(Request $request) {
        Session::start();
        // 管理者がログインしているかどうかを確認する
        if (!$request->session()->has('adminId')) {
            // ログインしていない場合はログインページにリダイレクトする
            return redirect()->route('viewLoginAdmin');
        }

        $article_id = session('article_id');
        $article_title = session('article_title');
        $article_description = session('article_description');
        $article_description = nl2br($article_description);
        $imagePath = session('image_path');

        // 一時フォルダから指定のフォルダに移動
        $sourcePath = 'public/' . $imagePath;
        $uniqueFilename = uniqid() . '_' . basename($imagePath);
        $destinationPath = 'public/img/' . $uniqueFilename;

        Storage::move($sourcePath, $destinationPath);

        // クーポンを更新
        $article = Article::find($article_id);
        $article->article_id = $article_id;
        $article->article_title = $article_title;
        $article->article_description = $article_description;
        $article->article_thumbnail = $destinationPath;
        $article->save();

        // ログイン画面にリダイレクト
        return Redirect::to('/admin_manage');
    }

    public function articleDelete(Request $request) {
        $articleId = $request->input('article_id');

        // クーポンを論理削除（deletedカラムの値を1に変更）
        $article = Article::find($articleId);
        $article->deleted = 1;
        $article->save();

        // 削除が完了したらリダイレクトなどの処理を行う
        // ...

        return redirect()->route('viewAdminManage');
    }
}
