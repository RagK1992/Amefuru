<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>header</title>
    <!-- CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<!-- ヘッダー -->
<nav class="header-nav">
    <ul class="header-menu main-menu">
        <li><a class="menu-btn btn--yellow btn--border-dashed" href="{{route('main')}}">クーポン</a></li>
        <li><a class="menu-btn btn--yellow btn--border-dashed" href="{{route('main', ['tag' => 'articles'])}}">施設情報・コラム</a></li>
        <li><a class=" menu-btn btn--yellow btn--border-dashed" href="{{route('loginUserForm')}}">ログイン</a></li>
    </ul>
</nav>

<!-- ハンバーガーメニュー -->
<div class="hamburger-menu">
    <div class="hamburger-icon">
        <img class="mobile-menu-img" src="/img/mobile-menu.png">
    </div>
    <ul class="header-menu mobile-menu">
        <li><a class="mobile-menu-btn" href="#content-main">クーポン</a></li>
        <li><a class="mobile-menu-btn" href="#content-sub">施設情報・コラム</a></li>
        <li><a class="mobile-menu-btn" href="{{route('loginUserForm')}}">ログイン</a></li>
    </ul>
</div>
<!-- ロゴ -->
<a href="{{route('index')}}"><img class="header-logo" src="/img/logo-text-blue2.png"></a>

</html>