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

<body class="bg02">
    <div class="coupon">
        <h2>コラム</h2>
        <form class="confirm-form" method="post" action="{{route('articleRegisterSubmit')}}" novalidate>
            @csrf
            <div class="article-section">
                <div class="article-thumbnail__confirm">
                    <input type="hidden" name="article_thumbnail" placeholder="サムネイル" value="{{ session('image_path') }}">
                    <img src="{{ asset('storage/' . session('imagePath')) }}" alt="クーポン画像">
                </div>
            </div>
            <div class="article-section">
                <div class="article-title__confirm">
                    <input type="hidden" name="article_title" placeholder="コラムタイトル" value="{{ session('article_title') }}">
                    <span class="article-title__p">{{ session('article_title') }}</span>
                </div>
            </div>
            <div class="article-section">
                <div class="article-description__confirm">
                    <input type="hidden" name="article_description" placeholder="コラム内容" value="{{ session('article_description') }}">
                    <span class="article-section__p">{!! session('article_description') !!}</span>
                </div>
            </div>

            <div class="confirm-btn__wrapper">
                <button class="confirm-btn" type="button" onclick="history.back()">修　正</button>
                <button class="confirm-btn" type="submit" name="submit">登　録</button>
            </div>
        </form>
    </div>
</body>