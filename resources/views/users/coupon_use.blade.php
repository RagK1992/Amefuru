<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>クーポン使用画面</title>
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

    <div class="coupon">
        <h2>この画面をご提示ください</h2>
        @csrf
        <input type="hidden" name="user_id" value="{{ session('userId') }}">
        <input type="hidden" name="coupon_id" value="{{ $coupon->coupon_id }}">
        <div class="coupon-section">
            <div class="coupon-company">
                <span class="coupon-section__p">{{ $coupon->company->company_name }}</span>
            </div>
            <div class="coupon-area">
                <span class="coupon-section__p">{{ $coupon->area->prefecture }}</span>
            </div>
        </div>
        <div class="coupon-section">
            <div class="coupon-name">
                <span class="coupon-section__p">{{ $coupon['coupon_name'] }}</span>
            </div>
        </div>
        <div class="coupon-section">
            <div class="coupon-img">
                <img src="{{ asset('storage/img/' . basename($coupon->coupon_img)) }}" />
            </div>
        </div>
        <div class="coupon-section">
            <div class="coupon-description">
                <span class="coupon-section__p">
                    クーポン内容</br>
                    {{ $coupon['coupon_description'] }}
                </span>
            </div>
        </div>
        <div class="coupon-section">
            <div class="coupon-expiry">
                <span class="coupon-section__p">
                    利用期限</br>
                    {{ $coupon['expiry'] }}
                </span>
            </div>
        </div>
        <div class="coupon-section">
            <div class="coupon-terms_and_conditions">
                <span class="coupon-section__p">
                    利用条件</br>
                    {{ $coupon['terms_and_conditions'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- フッター -->
    @include('parts.footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>