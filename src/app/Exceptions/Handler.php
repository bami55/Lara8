<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * オリジナルデザインのエラー画面をレンダリングする
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e
     * @return \Illuminate\Http\Response
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        // デバッグモード時はLaravel標準エラー画面を表示
        if (config('app.debug')) {
            return parent::convertExceptionToResponse($e);
        }

        $status = $e->getStatusCode();
        // CSRFトークンミスマッチはセッションエラーとみなす
        if ($e instanceof TokenMismatchException) {
            // ステータスコードを書き換える
            $status = self::STATUS_CODE_TOKEN_MISMATCH;
        }
        return response()->view(
            "errors.common", // 共通テンプレート
            [
                // VIEWに与える変数
                'exception'   => $e,
                'message'     => $e->getMessage(),
                'status_code' => $status,
            ],
            $status, // レスポンス自体のステータスコード
            $e->getHeaders()
        );
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
}
