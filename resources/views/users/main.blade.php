<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>掲載情報一覧</title>
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

    <h2 class="title">掲載中の雨の日情報</h2>

    <div class="main-container">
        <div class="tab-container" id="tab-container">
            <div class="tab current-tab" data-tab="coupons">クーポン</div>
            <div class="tab" data-tab="articles">コラム</div>
            <div class="area-serch">
                <form class="area-serch__form" action="{{ route('main') }}" method="GET" id="filter-form">
                    <label class="area-selectbox">
                        <select class="area-serch__select" name="area">
                            <option value="">すべてのエリア</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->prefecture }}" {{ request()->input('area') == $area->prefecture ? 'selected' : '' }}>{{ $area->prefecture }}</option>
                            @endforeach
                        </select>
                    </label>
                    <button class="area-serch__btn" type="submit">エリアで絞り込む</button>
                </form>
            </div>
        </div>

        <div id="tab-content">
            <div class="tabcontent tab-active" id="coupons-tabcontent">
                <!-- クーポンタブコンテンツの表示 -->
                <div class="tab-coupon">

                    <div class="row">
                        <!-- １段目の3つ -->
                        <div class="main-column">
                            @foreach ($coupons as $coupon)
                            <a class="main-coupon" href="{{ route('couponDetail', ['coupon_id' => $coupon['coupon_id']]) }}">
                                <div class="main-coupon__area">
                                    <p class="main-coupon__areatag">{{ $coupon['prefecture'] }}</p>
                                </div>
                                <img class="main-coupon__img" src="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" />
                                <p class="main-coupon__company">{{ $coupon['company_name'] }}</p>
                                <p class="main-coupon__name">{{ $coupon['coupon_name'] }}</p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- couponsテーブルからデータを取得して表示するコードを追加 -->
            </div>

            <div class=" tabcontent" id="articles-tabcontent">
                <!-- クーポンタブコンテンツの表示 -->
                <div class="tab-coupon">
                    <div class="row">
                        <div class="main-column">
                            @foreach ($articles as $article)
                            <a class="main-coupon" href="{{ route('articleDetail', ['article_id' => $article['article_id']]) }}">
                                <img class="main-coupon__img" src="{{ asset('storage/img/' . basename($article->article_thumbnail)) }}" />
                                <p class="main-coupon__company">{{ $article['article_title'] }}</p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- articlesテーブルからデータを取得して表示するコードを追加 -->
                </div>
            </div>
        </div>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>