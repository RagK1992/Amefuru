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
    <h2 class="title">管理者ページ</h2>
    <div class="admin-index__container">
        <div class="index-for__admin">
            <h2>クーポン一覧</h2>
            <table class="index-table">
                <tr>
                    <th>企業名</th>
                    <th>クーポン名</th>
                    <th>有効期限</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                @foreach ($coupons as $coupon)
                <tr>
                    <td>
                        @php
                        $company = App\Models\Company::find($coupon->company_id);
                        @endphp
                        {{ $company->company_name }}
                    </td>
                    <td>{{ $coupon->coupon_name }}</td>
                    <td>{{ $coupon->expiry}}</td>
                    <td class="option">
                        <a href="{{ route('couponEdit', ['coupon_id' => $coupon['coupon_id']]) }}">編集</a>
                    </td>
                    <td>
                        <form action="{{ route('couponDelete') }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            <input type="hidden" name="coupon_id" value="{{ $coupon->coupon_id }}">
                            <button class="option-delete" type="submit">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <a class="btn" href="{{route('couponRegister')}}">クーポン 新規登録</a>

        <div class="index-for__admin">
            <h2>コラム一覧</h2>
            <table class="index-table">
                <tr>
                    <th>コラムNo.</th>
                    <th>コラムタイトル</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->article_id }}</td>
                    <td>{{ $article->article_title }}</td>
                    <td class="option"><a href=" {{ route('articleEdit', ['article_id' => $article['article_id']]) }}">編集</a></td>
                    <td>
                        <form action="" method="POST">
                            <button class="option-delete" type="submit" onclick="">削除</button>
                            <input type="hidden" name="delete" value="">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <a class="btn" href="{{route('articleRegister')}}">コラム 新規登録</a>
    </div>

</body>