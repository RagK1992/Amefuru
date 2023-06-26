<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>確認画面</title>
    <!-- CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg02">
    <!-- ヘッダー -->
    @if(session('user_id'))
    @include('parts.header_user')
    @else
    @include('parts.header')
    @endif

    <div class="confirm">
        <h2>確認画面</h2>

        <form id="register-form" class="confirm-form" method="post" action="{{ route('userRegister') }}" novaridate>
            @csrf
            <div class="confirm-item">
                <label>メールアドレス</label>
                <input type="hidden" name="email" placeholder="メールアドレス" value="{{ session('email')  }}">
                <span>{{ session('email')  }}</span>
            </div>

            <div class="confirm-item">
                <label>パスワード</label>
                <input type="hidden" name="password" placeholder="パスワード" value="{{ session('password') }}">
                <span>{{ session('password') }}</span>
            </div>

            <div class="confirm-item">
                <label>ユーザー名</label>
                <input type="hidden" name="user_name" placeholder="ユーザー名" value="{{ session('user_name') }}">
                <span>{{ session('user_name') }}</span>
            </div>

            <div class="confirm-item">
                <label>地域</label>
                <input type="hidden" name="area_id" placeholder="地域" value="{{ session('area_id') }}">
                <span>{{ $prefectures[session('area_id')] }}</span>
            </div>

            <div class="confirm-btn__wrapper">
                <button class="confirm-btn" type="button" onclick="history.back()">戻　る</button>
                <button class="confirm-btn" type="button" onclick="registerConfirm()">登　録</button>
            </div>
        </form>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>