# Lara8

## Docker環境構築

### 初回

Laravelの初期設定を行う

```
docker-compose exec web composer install --no-scripts
cp src/.env.example src/.env
docker-compose exec web php artisan key:generate
```

## artisanコマンド

### コマンド一覧表示

```
docker-compose exec web php artisan
```

### Controller

```
// Userコントローラー作成
docker-compose exec web php artisan make:controller Users
```

### Model

```
// Customerモデル作成
docker-compose exec web php artisan make:model Customer
```

### ユーザーログイン認証

1. authを作る
```
docker-compose exec web php artisan make:auth
```
> ユーザー登録、ログイン機能が追加される。
> route, controller, model, viewなどが追加・更新される。

2. migrationファイルのユーザーテーブルのカラムを編集する
```
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
```
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
```
// app/User.php
protected $fillable = [
    'name', 'email', 'password', 'company_code'   // <- company_codeを追加
];
```

5. controllerにフィールドを追加する
```
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
