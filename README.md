# Lara8

## Docker環境構築

### 初回

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
