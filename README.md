# Lara8

## Docker環境構築

### 初回

Laravelの初期設定を行う

```shell
docker-compose exec web composer install --no-scripts
cp src/.env.example src/.env
docker-compose exec web php artisan key:generate
```

## artisanコマンド

### コマンド一覧表示

```shell
docker-compose exec web php artisan
```

### Controller

```shell
// Userコントローラー作成
docker-compose exec web php artisan make:controller Users
```

### Model

```shell
// Customerモデル作成
docker-compose exec web php artisan make:model Customer
```

### ユーザーログイン認証

1. authを作る
```shell
docker-compose exec web php artisan make:auth
```
> ユーザー登録、ログイン機能が追加される。
> route, controller, model, viewなどが追加・更新される。

2. migrationファイルのユーザーテーブルのカラムを編集する
```php
// database/migrations/2014_10_12_000000_create_users_table.php
// company_codeを追加した。
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password', 60);
        $table->integer('company_code');  // <-追加
        $table->rememberToken();
        $table->timestamps();
    });
}
```

3. viewに追加したカラムの入力フィールドを追加する
```php
// resources/views/auth/register.blade.php

...

<div class="form-group{{ $errors->has('company_code') ? ' has-error' : '' }}">
    <label for="company_code" class="col-md-4 control-label">Company Code</label>

    <div class="col-md-6">
        <input id="company_code" type="text" class="form-control" name="company_code" value="{{ old('company_code') }}">

        @if ($errors->has('company_code'))
            <span class="help-block">
                <strong>{{ $errors->first('company_code') }}</strong>
            </span>
        @endif
    </div>
</div>

...

```

4. modelにフィールドを追加する
```php
// app/User.php
protected $fillable = [
    'name', 'email', 'password', 'company_code'   // <- company_codeを追加
];
```

5. controllerにフィールドを追加する
```php
// app/Http/Controllers/Auth/AuthController.php
protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'company_code' => $data['company_code'],  // <- 追加
    ]);
}
```

> routeで Route::auth(), Route::get('/home', 'HomeController@index') を
> Routeグループ middleware 'web' の中に入れておかないとエラーが発生した。

### ログインが必要なページ

MiddlewareのAuthを使用する

Routesでやる方法
```php
// middleware('auth')をつける
Route::get('access', function() {
    echo 'You have access!';
})->middleware('auth');
```

Controllerでやる方法
```php
// コンストラクタにmiddleware('auth')をつける
public function __construct()
{
    $this->middleware('auth');
}
```

### ミドルウェアを追加

1. artisanで追加
```shell
php artisan make:middleware AdminMiddleware
```

2. Kernel.phpに定義追加
```php
protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'isAdmin' => \App\Http\Middleware\AdminMiddleware::class,   // <- 追加
];
```

3. Routesなどで設定
```php
Route::get('access', function() {
    echo 'You have access!';
})->middleware('isAdmin');
```

### マイグレーション

#### カラムを追加する方法
1. usersにadminカラムを追加するので、マイグレーションファイルを用意する
```shell
docker-compose exec web php artisan make:migration add_admin_to_users_table --table=users 
```

2. マイグレーションファイルにカラムの追加を記述する
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->tinyInteger('admin');
    });
}

// 戻すときはカラムを削除する
public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('admin');
    });
}
```

3. マイグレーション実行
```shell
docker-compose exec web php artisan migrate
```
