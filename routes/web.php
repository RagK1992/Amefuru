<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SignupController;

// トップページ表示
Route::get('/', [UserController::class, 'index'])->name('index');
//マイページ表示
Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
// メインページの表示
Route::get('/main', [UserController::class, 'main'])->name('main');
// クーポン詳細ページの表示
Route::get('/coupon_detail', [UserController::class, 'couponDetail'])->name('couponDetail');
Route::post('/save_coupon', [UserController::class, 'saveCoupon'])->name('saveCoupon');
// クーポン利用ページの表示
Route::get('/coupon_use', [UserController::class, 'couponUse'])->name('couponUse');
// コラム詳細ページの表示
Route::get('/article_detail', [UserController::class, 'articleDetail'])->name('articleDetail');


//Signup画面表示（都道府県名表示）
Route::get('/signup', [SignupController::class, 'signupView'])->name('signupView');
//確認画面遷移
Route::post('/confirm', [SignupController::class, 'signupConfirm'])->name('confirm');
//ユーザー登録
Route::post('/register', [SignupController::class, 'userRegister'])->name('userRegister');


// ログインフォームを表示
Route::get('/login_for_user', [LoginController::class, 'viewLoginFormUser'])->name('loginUserForm');
// ログイン処理
Route::post('/login_for_user', [LoginController::class, 'loginUser'])->name('loginUserSubmit');
// パスワードリセット画面を表示
Route::get('/forget_password', [LoginController::class, 'passwordForget'])->name('passwordForget');
// パスワードリセットメール送信
Route::post('/forget_password', [LoginController::class, 'passwordResetMail'])->name('passwordResetMail');
// パスワード再設定メール送信完了画面
Route::get('/reset_mail_sent', [LoginController::class, "resetMailSent"])->name('resetMailSent');
// パスワード再設定画面を表示
Route::get('/reset_password/{token}/{email}', [LoginController::class, 'viewResetForm'])->name('password.reset');
// パスワード再設定送信
Route::post('/reset_password', [LoginController::class, 'updatePassword'])->name('password.update');
// パスワード再設定完了画面の表示
Route::get('/password_update', [LoginController::class, 'updatePasswordComplete'])->name('updatePasswordComplete');


// ログアウト処理
Route::post('/logout', [LogoutController::class, 'logoutUser'])->name('logoutUser');


// 管理者ログインフォームを表示
Route::get('/loginAdmin', [AdminController::class, 'viewLoginAdmin'])->name('viewLoginAdmin');
// 管理者ログイン処理
Route::post('/loginAdmin', [AdminController::class, 'loginAdmin'])->name('loginAdmin');
// 管理者ページを表示（クーポン一覧も）
Route::get('/admin_manage', [AdminController::class, 'viewAdminManage'])->name('viewAdminManage');
// クーポン登録画面を表示
Route::get('/coupon_register', [AdminController::class, 'couponRegister'])->name('couponRegister');
// クーポン登録確認画面
Route::post('/coupon_register_confirm', [AdminController::class, 'couponRegisterConfirm'])->name('couponRegisterConfirm');
// クーポン登録完了処理
Route::post('/coupon_register_submit', [AdminController::class, 'couponRegisterSubmit'])->name('couponRegisterSubmit');
// クーポン編集画面を表示
Route::get('/coupon_edit/{coupon_id}', [AdminController::class, 'couponEdit'])->name('couponEdit');
// クーポン編集確認画面
Route::post('/coupon_edit_confirm', [AdminController::class, 'couponEditConfirm'])->name('couponEditConfirm');
// クーポン編集完了処理
Route::post('/coupon_edit_submit', [AdminController::class, 'couponEditSubmit'])->name('couponEditSubmit');
// クーポン削除処理
Route::post('/coupon_delete', [AdminController::class, 'couponDelete'])->name('couponDelete');
// コラム登録画面を表示
Route::get('/article_register', [AdminController::class, 'articleRegister'])->name('articleRegister');
// コラム登録確認画面
Route::post('/article_register_confirm', [AdminController::class, 'articleRegisterConfirm'])->name('articleRegisterConfirm');
// コラム登録処理
Route::post('/article_register_submit', [AdminController::class, 'articleRegisterSubmit'])->name('articleRegisterSubmit');
// コラム編集画面を表示
Route::get('/article_edit/{article_id}', [AdminController::class, 'articleEdit'])->name('articleEdit');
// コラム編集確認画面
Route::post('/article_edit_confirm', [AdminController::class, 'articleEditConfirm'])->name('articleEditConfirm');
// コラム編集完了処理
Route::post('/article_edit_submit', [AdminController::class, 'articleEditSubmit'])->name('articleEditSubmit');
// コラム削除処理
Route::post('/article_delete', [AdminController::class, 'articleDelete'])->name('articleDelete');


// 管理者（掲載企業）ログインフォームを表示
Route::get('/loginCompany', [CompanyController::class, 'viewLoginCompany'])->name('viewLoginCompany');
// 管理者（掲載企業）ログイン処理
Route::post('/loginCompany', [CompanyController::class, 'loginCompany'])->name('loginCompany');
// 管理者（掲載企業）ページを表示（クーポン一覧も）
Route::get('/company_manage', [CompanyController::class, 'viewCompanyManage'])->name('viewCompanyManage');
// 管理者（掲載企業）クーポン編集画面を表示
Route::get('/company_edit/{coupon_id}', [CompanyController::class, 'companyEdit'])->name('companyEdit');
// 管理者（掲載企業）クーポン編集確認画面
Route::post('/company_edit_confirm', [CompanyController::class, 'companyEditConfirm'])->name('companyEditConfirm');
// 管理者（掲載企業）クーポン編集完了処理
Route::post('/company_edit_submit', [CompanyController::class, 'companyEditSubmit'])->name('companyEditSubmit');


Route::get('/footer', function () {
    return view('parts.footer');
});

Route::get('/header_user', function () {
    return view('parts.header_user');
});

Route::get('/header', function () {
    return view('parts.header');
});
