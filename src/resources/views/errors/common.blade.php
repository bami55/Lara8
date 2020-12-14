<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>エラー</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @if ($status_code == 403)
                    <p class="text-info lead">アクセス権が存在しません。</p>
                    @elseif ($status_code == 404)
                    <p class="text-info lead">存在しないページです。</p>
                    @elseif ($status_code == 408)
                    <p class="text-info lead">処理がタイムアウトしました。</p>
                    <p class="text-info lead">再度、処理を実行して下さい。</p>
                    @elseif ($status_code == 500)
                    <p class="text-danger lead">システムエラーが発生しました。</p>
                    <p class="text-danger lead">システム管理者へご連絡をお願いします。</p>
                    @elseif ($status_code == 503)
                    <p class="text-info lead">ただいま、メンテナンス中です。</p>
                    @elseif ($status_code == 901)
                    <p class="text-info lead">セッションの有効期限が切れています。</p>
                    <p class="text-info lead">ログインし直してください。</p>
                    @else
                    <p class="text-danger lead">不正なエラーが発生しました({{ $status_code }})</p>
                    <p class="text-danger lead">システム管理者へご連絡をお願いします。</p>
                    @endif
                </div>
                <div  class="header-title title">
                    @if ($status_code != 503)
                    <br><a href="{{ url('/') }}">ログイン画面へ戻る</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
