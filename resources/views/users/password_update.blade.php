<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード更新完了</title>
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

    <div class="password-updated">
        <h2>パスワード更新完了</h2>

        <div class="password-updated__form">
            <p>パスワードが正常に更新されました。</p>
            <p>新しいパスワードを使用してログインしてください。</p>
            <a href="{{ route('loginUserForm') }}">ログイン画面に戻る</a>
        </div>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>