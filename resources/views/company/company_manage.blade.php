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
    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>

<body class="bg02">
    <h2 class="title">掲載企業ページ</h2>
    <div class="admin-index__container">
        <div class="index-for__admin">
            <h2>クーポン一覧</h2>
            <table class="index-table">
                <tr>
                    <th>クーポン名</th>
                    <th>クーポン内容</th>
                    <th>有効期限</th>
                    <th>編集</th>
                </tr>
                @foreach ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->coupon_name }}</td>
                    <td>{{ $coupon->coupon_description }}</td>
                    <td>{{ $coupon->expiry }}</td>
                    <td class="option"><a href="{{ route('companyEdit', ['coupon_id' => $coupon->coupon_id]) }}">編集</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

</body>