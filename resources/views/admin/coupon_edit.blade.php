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
    <div class="coupon-edit">
        <h2>クーポン編集フォーム</h2>

        <form class="coupon-edit__form" method="post" action="{{ route('couponEditConfirm') }}" enctype="multipart/form-data" novaridate>
            @csrf
            <input type="hidden" name="coupon_id" value="{{ $coupon['coupon_id']  }}">
            <div class="form-item">
                <label class="form-label">企業名</label>
                @if ($errors->has('company_id'))
                <p class="error-message">{{ $errors->first('company_id') }}</p>
                @endif
                <select name="company_id">
                    <option value="{{ $coupon->company->company_id }}">{{ $coupon->company->company_name }}</option>
                </select>
            </div>

            <div class="form-item">
                <label class="form-label">地域</label>
                @if ($errors->has('area_id'))
                <p class="error-message">{{ $errors->first('area_id') }}</p>
                @endif
                <select name="area_id">
                    <option value="{{ $coupon->area->area_id }}">{{ $coupon->area->prefecture }}</option>
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
                <input type="text" name="coupon_name" placeholder="クーポン名" value="{{ $coupon['coupon_name'] }}">
            </div>

            <div class="form-item">
                <label class="form-label">クーポン内容</label>
                @if ($errors->has('coupon_description'))
                <p class="error-message">{{ $errors->first('coupon_description') }}</p>
                @endif
                <input type="text" name="coupon_description" placeholder="クーポン内容" value="{{ $coupon['coupon_description'] }}">
            </div>

            <div class="form-item">
                <label class="form-label" for="expiry">有効期限</label>
                @if ($errors->has('expiry'))
                <p class="error-message">{{ $errors->first('expiry') }}</p>
                @endif
                <input type="date" name="expiry" id="expiry" value="{{ $coupon['expiry'] }}">
            </div>

            <div class="form-item">
                <label class="form-label">利用条件</label>
                @if ($errors->has('terms_and_conditions'))
                <p class="error-message">{{ $errors->first('terms_and_conditions') }}</p>
                @endif
                <input type="text" name="terms_and_conditions" placeholder="利用条件" value="{{ $coupon['terms_and_conditions'] }}">
            </div>

            <div class="form-item">
                <label class="form-label">掲載画像</label>
                @if ($errors->has('coupon_img'))
                <p class="error-message">{{ $errors->first('coupon_img') }}</p>
                @endif
                <input type="file" name="coupon_img" accept="image/*">
            </div>

            <button class="btn" type="submit" name="submit">確認</button>
        </form>
    </div>
</body>