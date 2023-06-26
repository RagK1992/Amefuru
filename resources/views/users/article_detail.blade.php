<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>コラム詳細</title>
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

    <div class="article-detail">
        <h2>{{ $article['article_title'] }}</h2>
        <div class="article-detail__thumbnail">
            <img src="{{ asset('storage/img/' . basename($article->article_thumbnail)) }}" alt="クーポン画像">
        </div>
        <div class="article-detail__description">
            <p class="article-description__p">{!! $article['article_description'] !!}</span>
        </div>
        <a href="{{route('main')}}">一覧へ戻る</a>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <!-- JS -->
    <script src="js/scripts.js"></script>
</body>