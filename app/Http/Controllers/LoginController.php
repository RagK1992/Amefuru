<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller {
    public function viewLoginFormUser() {
        return view('users.login_for_user');
    }

    public function loginUser(Request $request) {
        $request->validate(
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

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            // セッションを開始する
            Session::start();
            // 認証成功
            $request->session()->put('userId', $user->user_id); // ログインユーザーのIDをセッションに保存
            return redirect('/'); // ログイン前にアクセスしようとしていたURLにリダイレクト        
        } else {
            // 認証失敗
            return redirect()->back()->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません。']);
        }
    }

    public function passwordForget() {
        return view('users.forget_password');
    }

    public function passwordResetMail(Request $request) {
        $request->validate(
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'メールアドレスは必須入力です。',
                'email.email' => 'メールアドレスは正しくご入力ください。',
            ]
        );

        // メールアドレスの存在を確認
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => '入力されたメールアドレスが存在しません。']);
        }

        $token = Password::createToken($user);

        $resetUrl = URL::to('/reset_password', ['token' => $token, 'email' => $request->email]);

        Mail::send('emails.password_reset', ['resetUrl' => $resetUrl, 'token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->from('info@example.com', 'アメフル');
            $message->to($request->email);
            $message->subject('パスワードリセットのご案内');
        });

        return redirect()->route('resetMailSent')->with(['email' => $request->email]);
    }

    public function resetMailSent() {
        return view('users.reset_mail_sent');
    }

    public function viewResetForm(Request $request, $token = null, $email = null) {
        return view('users.reset_password', compact('token', 'email'));
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => '新しいパスワードと新しいパスワードの確認が一致しません。',
        ]);

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors(['password' => ['新しいパスワードと新しいパスワードの確認が一致しません。']]);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('updatePasswordComplete')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function updatePasswordComplete() {
        return view('users.password_update');
    }
}
