<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>パスワードリセット</title>
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

    <div class="password-reset">
        <h2>パスワード再設定</h2>

        <form class="login-form" method="post" action="{{ route('passwordResetMail') }}" novalidate>

            @csrf
            <label class="form-exp">
                パスワードを再設定するアカウントのアドレスを入力してください
            </label>
            @if ($errors->has('email'))
            <p class="error-message">{{ $errors->first('email') }}</p>
            @endif
            <div class="form-item">
                <input type="email" name="email" placeholder="メールアドレス" value="">
            </div>

            <button class="btn" type="submit" name="submit">送信</button>
        </form>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>