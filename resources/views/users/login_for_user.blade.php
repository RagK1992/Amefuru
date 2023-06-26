<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ログイン画面</title>
    <!-- CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg02">
    <!-- ヘッダー -->
    @if(session('userId'))
    @include('parts.header_user')
    @else
    @include('parts.header')
    @endif

    <div class="login">
        <h2>ログインフォーム</h2>

        <form class="login-form" method="post" action="{{ route('loginUserSubmit') }}" novalidate>
            @csrf
            <div class="form-item">
                @if ($errors->has('email'))
                <p class="error-message">{{ $errors->first('email') }}</p>
                @endif
                <input type="email" name="email" placeholder="メールアドレス" value="">
            </div>

            <div class="form-item">
                @if ($errors->has('password'))
                <p class="error-message">{{ $errors->first('password') }}</p>
                @endif
                <input type="password" name="password" placeholder="パスワード" value="">
            </div>

            <button class="btn" type="submit" name="submit">ログイン</button>
        </form>

        <div class="login-sub">
            <a href="{{route('passwordForget')}}">パスワードを忘れた方はこちら</a>
            <a href="{{route('signupView')}}">新規登録の方はこちら</a>
        </div>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>