<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>header</title>
    <!-- CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body class="bg02">
    <div class="login">
        <h2>管理者ログインフォーム</h2>

        <form class="login-form" method="post" action="{{ route('loginAdmin') }}" novalidate>
            @csrf
            <div class="form-item">
                @if ($errors->has('email'))
                <p class="error-message">{{ $errors->first('email') }}</p>
                @endif
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>

            <div class="form-item">
                @if ($errors->has('password'))
                <p class="error-message">{{ $errors->first('password') }}</p>
                @endif
                <input type="password" name="password" placeholder="パスワード" value="">
            </div>

            <button class="btn" type="submit" name="submit">ログイン</button>
        </form>
    </div>
</body>