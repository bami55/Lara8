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
