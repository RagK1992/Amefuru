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
        <h2>クーポン</h2>
        <form class="confirm-form" method="post" action="{{route('couponEditSubmit')}}" novalidate>
            @csrf
            <input type="hidden" name="coupon_id" value="{{ $coupon->coupon_id }}">
            <div class="coupon-section">
                <div class="coupon-company">
                    <input type="hidden" name="company_id" placeholder="企業名" value="{{ $companies[session('company_id')] }}">
                    <span class="coupon-section__p">{{ $companies[session('company_id')] }}</span>
                </div>
                <div class="coupon-area">
                    <input type="hidden" name="area_id" placeholder="地域" value="{{ $prefectures[session('area_id')] }}">
                    <span class="coupon-section__p">{{ $prefectures[session('area_id')] }}</span>
                </div>
            </div>
            <div class="coupon-section">
                <div class="coupon-name">
                    <input type="hidden" name="coupon_name" placeholder="クーポン名" value="{{ session('coupon_name') }}">
                    <span class="coupon-section__p">{{ session('coupon_name') }}</span>
                </div>
            </div>
            <div class="coupon-section">
                <div class="coupon-img">
                    <input type="hidden" name="coupon_img" placeholder="掲載画像" value="{{ session('image_path') }}">
                    <img src="{{ asset('storage/' . session('image_path')) }}" alt="クーポン画像">
                </div>
            </div>
            <div class="coupon-section">
                <div class="coupon-description">
                    <input type="hidden" name="coupon_description" placeholder="クーポン内容" value="{{ session('coupon_description') }}">
                    <span class="coupon-section__p">{{ session('coupon_description') }}</span>
                </div>
            </div>
            <div class="coupon-section">
                <div class="coupon-expiry">
                    <input type="hidden" name="expiry" placeholder="有効期限" value="{{ session('expiry') }}">
                    <span class="coupon-section__p">{{ session('expiry') }}</span>
                </div>
            </div>
            <div class="coupon-section">
                <div class="coupon-terms_and_conditions">
                    <input type="hidden" name="terms_and_conditions" placeholder="利用条件" value="{{ session('terms_and_conditions') }}">
                    <span class="coupon-section__p">{{ session('terms_and_conditions') }}</span>
                </div>
            </div>

            <div class="confirm-btn__wrapper">
                <button class="confirm-btn" type="button" onclick="history.back()">修　正</button>
                <button class="confirm-btn" type="submit" name="submit" value="edit">登　録</button>
            </div>
        </form>
    </div>
</body>