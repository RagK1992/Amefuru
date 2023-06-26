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
    <div class="article-register">
        <h2>コラム新規登録フォーム</h2>

        <form class="article-register__form" method="post" action="{{ route('articleRegisterConfirm') }}" enctype="multipart/form-data" novaridate>
            @csrf

            <div class="form-item">
                <label class="form-label">コラムタイトル</label>
                @if ($errors->has('article_title'))
                <p class="error-message">{{ $errors->first('article_title') }}</p>
                @endif
                <input type="text" name="article_title" placeholder="コラムタイトル" value="{{ session('article_name') }}">
            </div>

            <div class="article-description__form">
                <label class="form-label">コラム本文</label>
                @if ($errors->has('article_description'))
                <p class="error-message">{{ $errors->first('article_description') }}</p>
                @endif
                <textarea name="article_description" placeholder="" rows="5" cols="50">{{ session('article_description') }}</textarea>
            </div>

            <div class="form-item">
                <label class="form-label">サムネイル画像</label>
                @if ($errors->has('article_thumbnail'))
                <p class="error-message">{{ $errors->first('article_thumbnail') }}</p>
                @endif
                <input type="file" name="article_thumbnail" accept="image/*">
            </div>

            <button class="btn" type="submit" name="submit">登録</button>
        </form>
    </div>
</body>