# Lara8

## Docker環境構築

### 初回

**※Laravel未インストールの場合（すでにsrcにインストール済ならこの作業は不要）**

```
# sampleprojectディレクトリを作成し、5.1系のインストールをする場合
composer create-project "laravel/laravel=5.1.*" sampleproject

# カレントディレクトリにディレクトリを作らずにインストールしたい場合は "." と記述する
composer create-project "laravel/laravel=5.1.*" .
```

Laravelの初期設定を行う

```
docker-compose exec web composer install
cp src/.env.example src/.env
docker-compose exec web php artisan key:generate
```

## artisanコマンド

### Controller

```
// Userコントローラー作成
docker-compose exec web php artisan make:controller Users
```

## DomPDF

### composerにパッケージを追加

```
composer require barryvdh/laravel-dompdf
```

メモリ不足のエラーが発生した場合


phpのメモリ上限値確認
```
php -r "echo ini_get('memory_limit').PHP_EOL;"
```


php.iniに追記
```
memory_limit = -1
```
[参考](https://www.suzu6.net/posts/203-memory-limit-error-at-composer-update/)

### config/app.phpに追加

```
// Service Providers
'providers' => [
  ...

  Barryvdh\DomPDF\ServiceProvider::class,
],

// Aliasesにも追加しておくと PDF::XXX で呼び出せて便利
'aliases' => [
  ...

  'PDF' => Barryvdh\DomPDF\Facade::class,
],
```

### Controller作成
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
	//
	public function download() {
		$data = [];
		$pdf = PDF::loadView('pdf.sample', $data);
		return $pdf->download('sample.pdf');
	}
}
```

### route定義
```php
Route::get('/pdf', 'PdfController@download');
```

### view作成

`.../views/pdf/sample.blade.php`
```php
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Sample</h1>
</body>
</html>
```

### 印刷ページを横向き

setPaperで指定
```php
$pdf = PDF::loadView('pdf.sample', $data)->setPaper('A4', 'landscape');
```
