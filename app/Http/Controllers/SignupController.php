<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Area;

class SignupController extends Controller {
    public function signupView() {
        $prefectures = Area::pluck('prefecture', 'area_id');
        return view('users.signup', compact('prefectures'));
    }

    public function signupConfirm(Request $request) {
        $prefectures = Area::pluck('prefecture', 'area_id');

        //値のバリデーション
        $validatedData = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d)/',
                'user_name' => 'required',
                'area_id' => 'required',
            ],
            [
                'email.required' => 'メールアドレスは必須入力です。',
                'email.email' => 'メールアドレスは正しくご入力ください。',
                'password.required' => 'パスワードは必須入力です。',
                'password.min' => 'パスワードは6文字以上で入力してください。',
                'password.regex' => 'パスワードは英字と数字を少なくとも1つ含めてください',
                'user_name.required' => 'ユーザー名は必須入力です。',
                'area_id.required' => '地域名を選択してください。',
            ]
        );

        // 入力値をセッションに保存
        session()->put('email', $validatedData['email']);
        session()->put('password', $validatedData['password']);
        session()->put('user_name', $validatedData['user_name']);
        session()->put('area_id', $validatedData['area_id']);

        // 確認画面にリダイレクト
        return view('users.confirm', compact('prefectures', 'validatedData'));
    }

    public function userRegister(Request $request) {
        $email = session('email');
        $password = session('password');
        $user_name = session('user_name');
        $area_id = session('area_id');

        // パスワードをハッシュ化
        $hashedPassword = Hash::make($password);

        // データを保存
        User::create([
            'email' => $email,
            'password' => $hashedPassword,
            'user_name' => $user_name,
            'area_id' => $area_id,
        ]);

        // ログイン画面にリダイレクト
        return Redirect::to('/login_for_user');
    }
}
