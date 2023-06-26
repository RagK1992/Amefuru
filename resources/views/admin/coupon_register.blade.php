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
    <div class="coupon-register">
        <h2>クーポン新規登録フォーム</h2>

        <form class="coupon-register__form" method="post" action="{{ route('couponRegisterConfirm') }}" enctype="multipart/form-data" novaridate>
            @csrf
            <div class="form-item">
                <select name="company_id">
                    <option value="{{ session('company_id') }}">企業名を選択してください</option>
                    @foreach ($companies as $id => $companyName)
                    <option value=" {{ $id }}">{{ $companyName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-item">
                <select name="area_id">
                    <option value="{{ session('area_id') }}">地域を選択してください</option>
                    @foreach ($prefectures as $area_id => $prefecture)
                    <option value="{{ $area_id }}">{{ $prefecture }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-item">
                <label class="form-label">クーポン名</label>
                @if ($errors->has('coupon_name'))
                <p class="error-message">{{ $errors->first('coupon_name') }}</p>
                @endif
                <input type="text" name="coupon_name" placeholder="クーポン名" value="{{ session('coupon_name') }}">
            </div>

            <div class="form-item">
                <label class="form-label">クーポン内容</label>
                @if ($errors->has('coupon_description'))
                <p class="error-message">{{ $errors->first('coupon_description') }}</p>
                @endif
                <input type="text" name="coupon_description" placeholder="クーポン内容" value="{{ session('coupon_description') }}">
            </div>

            <div class="form-item">
                <label class="form-label" for="expiry">有効期限</label>
                @if ($errors->has('expiry'))
                <p class="error-message">{{ $errors->first('expiry') }}</p>
                @endif
                <input type="date" name="expiry" id="expiry" value="{{ session('expiry') }}">
            </div>

            <div class="form-item">
                <label class="form-label">利用条件</label>
                @if ($errors->has('terms_and_conditions'))
                <p class="error-message">{{ $errors->first('terms_and_conditions') }}</p>
                @endif
                <input type="text" name="terms_and_conditions" placeholder="利用条件" value="{{ session('terms_and_conditions') }}">
            </div>

            <div class="form-item">
                <label class="form-label">掲載画像</label>
                @if ($errors->has('coupon_img'))
                <p class="error-message">{{ $errors->first('coupon_img') }}</p>
                @endif
                <input type="file" name="coupon_img" accept="image/*">
            </div>

            <button class="btn" type="submit" name="submit">登録</button>
        </form>
    </div>
</body>