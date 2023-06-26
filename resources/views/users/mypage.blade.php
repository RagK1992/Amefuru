<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>マイページ</title>
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

    <h2 class="title">マイページ</h2>

    <div class="mypage-container">
        <h2>保存済みクーポン</h2>
        <div class="mypage-coupon">
            <!-- 保存したクーポン -->

            <div class="row">
                <div class="mypage-column">
                    @foreach ($coupons as $coupon)
                    <a class="mypage-item" href="{{ route('couponUse', ['coupon_id' => $coupon['coupon_id']]) }}">
                        <div class="mypage-coupon__area">
                            <p class="mypage-coupon__areatag">{{ $coupon->area->prefecture }}</p>
                        </div>
                        <img class="mypage-coupon__img" src="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" />
                        <p class="mypage-coupon__company">{{ $coupon->company->company_name }}</p>
                        <p class="mypage-coupon__name">{{ $coupon->coupon_name }}</p>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>