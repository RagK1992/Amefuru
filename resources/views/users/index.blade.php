<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>トップページ</title>
    <!-- CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="page-top">
    <!-- ヘッダー -->
    <div class="header">
        @if(session('userId'))
        @include('parts.header_user')
        @else
        @include('parts.header')
        @endif
        <!-- 挿絵 -->
        <img class="header-image" src="/img/clip01.jpg" alt="">
        <!-- サブ -->
        <div class="header-subheading">
            <img src="/img/subheading2.png">
        </div>
        <div class="mobile-header-subheading">
            <img src="/img/subheading-mobile.png">
        </div>
    </div>

    <!-- サービス -->
    <section id="services">
        <div class="service-wrapper">
            <h2><span class="under-line">サービス内容</span></h2>
            <h3>日本では1年のうち、およそ3分の1が雨。</br>
                「アメフル」は雨の日を満喫するための情報を発信しています</h3>
        </div>
    </section>

    <!-- メインコンテンツ -->
    <section id="content-main">
        <!-- クーポン -->
        <div class="content-wrapper">
            <div class="content-info">
                <h2>雨の日クーポン</h2>
                <p>雨の日限定のクーポンをお届けします</p>
            </div>
            <div class="content-lineup">
                <!-- 最新の6つのデータを取得し3*2段に分ける -->
                @php
                use App\Models\Coupon;
                $couponsChunk = $coupons->chunk(3);
                @endphp

                <!-- クーポン -->
                <div class="row">
                    <h3>最新のクーポン</h3>
                    <!-- １段目の３つ -->
                    @if ($couponsChunk->count() > 0)
                    <div class="column">
                        @foreach ($couponsChunk[0] as $coupon)
                        <a class="coupon-sample" href="{{ route('couponDetail', ['coupon_id' => $coupon['coupon_id']]) }}">
                            <div class="coupon-sample__area">
                                <p class="prefecture-tag">{{ $coupon['prefecture'] }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1112.97 908.96">
                                <clipPath id="clip-path">
                                    <path class="cls-1" d="m150.38,143.12C32.71,314.19-35.63,572.13,20.38,677.12s195,109,297,167c190.5,108.32,466,71,670-46,152.3-87.35,150.77-418.11,74-600C996.38,44.12,887.88-28.38,648.38,11.12c-195.27,32.21-368-57-498,132Z" />
                                </clipPath>
                                <image xlink:href="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" clip-path="url(#clip-path)" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
                            </svg>
                            <p class="coupon-sample__name">{{ $coupon['coupon_name'] }}</p>
                        </a>
                        @endforeach
                    </div>


                    <!-- 2段目の３つ -->
                    @if ($couponsChunk->count() > 1)
                    <div class="column">
                        @foreach ($couponsChunk[1] as $coupon)
                        <a class="coupon-sample" href="{{ route('couponDetail', ['coupon_id' => $coupon['coupon_id']]) }}">
                            <div class="coupon-sample__area">
                                <p class="prefecture-tag">{{ $coupon['prefecture'] }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1112.97 908.96">
                                <clipPath id="clip-path">
                                    <path class="cls-1" d="m150.38,143.12C32.71,314.19-35.63,572.13,20.38,677.12s195,109,297,167c190.5,108.32,466,71,670-46,152.3-87.35,150.77-418.11,74-600C996.38,44.12,887.88-28.38,648.38,11.12c-195.27,32.21-368-57-498,132Z" />
                                </clipPath>
                                <image xlink:href="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" clip-path="url(#clip-path)" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
                            </svg>
                            <p class="coupon-sample__name">{{ $coupon['coupon_name'] }}</p>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- モバイル -->
            <div class="mobile-content-lineup">
                <!-- 最新の6つのデータを取得し2*2段に分ける -->
                @php
                $couponsChunk = $coupons->chunk(2);
                @endphp

                <!-- クーポン -->
                <div class="row">
                    <h3>最新のクーポン</h3>
                    <!-- １段目の３つ -->
                    @if ($couponsChunk->count() > 0)
                    <div class="column">
                        @foreach ($couponsChunk[0] as $coupon)
                        <a class="coupon-sample" href="{{ route('couponDetail', ['coupon_id' => $coupon['coupon_id']]) }}">
                            <div class="coupon-sample__area">
                                <p class="prefecture-tag">{{ $coupon['prefecture'] }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1112.97 908.96">
                                <clipPath id="clip-path02">
                                    <path class="cls-1" d="m150.38,143.12C32.71,314.19-35.63,572.13,20.38,677.12s195,109,297,167c190.5,108.32,466,71,670-46,152.3-87.35,150.77-418.11,74-600C996.38,44.12,887.88-28.38,648.38,11.12c-195.27,32.21-368-57-498,132Z" />
                                </clipPath>
                                <image xlink:href="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" clip-path="url(#clip-path02)" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
                            </svg>
                            <p class="coupon-sample__name">{{ $coupon['coupon_name'] }}</p>
                        </a>
                        @endforeach
                    </div>

                    <!-- 2段目の３つ -->
                    @if ($couponsChunk->count() > 1)
                    <div class="column">
                        @foreach ($couponsChunk[1] as $coupon)
                        <a class="coupon-sample" href="{{ route('couponDetail', ['coupon_id' => $coupon['coupon_id']]) }}">
                            <div class="coupon-sample__area">
                                <p class="prefecture-tag">{{ $coupon['prefecture'] }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1112.97 908.96">
                                <clipPath id="clip-path02">
                                    <path class="cls-1" d="m150.38,143.12C32.71,314.19-35.63,572.13,20.38,677.12s195,109,297,167c190.5,108.32,466,71,670-46,152.3-87.35,150.77-418.11,74-600C996.38,44.12,887.88-28.38,648.38,11.12c-195.27,32.21-368-57-498,132Z" />
                                </clipPath>
                                <image xlink:href="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" clip-path="url(#clip-path02)" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
                            </svg>
                            <p class="coupon-sample__name">{{ $coupon['coupon_name'] }}</p>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <a class="index-to-main" href="{{route('main')}}">クーポン一覧へ</a>
        </div>
    </section>

    <!-- サブコンテンツ1 -->
    <section id="content-sub">

        <!-- 施設情報 -->
        <div class="content-wrapper">
            <div class="content-info">
                <h2>施設情報・コラム</h2>
                <p>雨の日でも楽しめる情報をご紹介</p>
            </div>
            <div class="content-lineup">
                <!-- 最新の6つのデータを取得し3*2段に分ける -->
                @php
                $articlesChunk = $articles->chunk(3);
                @endphp

                @if ($articlesChunk->count() > 0)
                <div class="column">
                    @foreach ($articlesChunk[0] as $article)
                    <a class="coupon-sample" href="{{ route('articleDetail', ['article_id' => $article['article_id']]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1112.97 908.96">
                            <clipPath id="clip-path">
                                <path class="cls-1" d="m150.38,143.12C32.71,314.19-35.63,572.13,20.38,677.12s195,109,297,167c190.5,108.32,466,71,670-46,152.3-87.35,150.77-418.11,74-600C996.38,44.12,887.88-28.38,648.38,11.12c-195.27,32.21-368-57-498,132Z" />
                            </clipPath>
                            <image xlink:href="{{ asset('storage/img/' . basename($article->article_thumbnail)) }}" clip-path="url(#clip-path)" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
                        </svg>
                        <p class="coupon-sample__name">{{ $article['article_title'] }}</p>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- モバイル -->
            <div class="mobile-content-lineup">
                <!-- 最新の6つのデータを取得し3*2段に分ける -->
                @php
                $articlesChunk = $articles->chunk(2);
                @endphp

                @if ($articlesChunk->count() > 0)
                <div class="column">
                    @foreach ($articlesChunk[0] as $article)
                    <a class="coupon-sample" href="{{ route('articleDetail', ['article_id' => $article['article_id']]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1112.97 908.96">
                            <clipPath id="clip-path02">
                                <path class="cls-1" d="m150.38,143.12C32.71,314.19-35.63,572.13,20.38,677.12s195,109,297,167c190.5,108.32,466,71,670-46,152.3-87.35,150.77-418.11,74-600C996.38,44.12,887.88-28.38,648.38,11.12c-195.27,32.21-368-57-498,132Z" />
                            </clipPath>
                            <image xlink:href="{{ asset('storage/img/' . basename($article->article_thumbnail)) }}" clip-path="url(#clip-path02)" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
                        </svg>
                        <p class="coupon-sample__name">{{ $article['article_title'] }}</p>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
            <a class="index-to-main" href="{{route('main', ['tag' => 'articles'])}}">施設情報一覧へ</a>
        </div>
    </section>


    <!-- フッター -->
    @include('parts.footer')


</body>

<script src="{{ asset('js/scripts.js') }}"></script>

</html>