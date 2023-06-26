<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>アカウント登録</title>
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

    <div class="signup">
        <h2>新規登録フォーム</h2>

        <form class="signup-form" method="post" action="{{ route('confirm') }}" novaridate>
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
                <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}">
            </div>

            <div class="form-item">
                @if ($errors->has('user_name'))
                <p class="error-message">{{ $errors->first('user_name') }}</p>
                @endif
                <input type="text" name="user_name" placeholder="ユーザー名" value="{{ old('user_name') }}">
            </div>

            <div class="form-item">
                @if ($errors->has('area_id'))
                <p class="error-message">{{ $errors->first('area_id') }}</p>
                @endif
                <select name="area_id">
                    <option value="{{ old('$area_id') }}">地域を選択してください</option>
                    @foreach ($prefectures as $area_id => $prefecture)
                    <option value="{{ $area_id }}">{{ $prefecture }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn" type="submit" name="submit">登　録</button>
        </form>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>