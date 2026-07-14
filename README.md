# laravel10-sandbox

## 概要

laravel10のサンドボックス。  
以下のdockerコマンドはホスト側で実行する想定で書いてある点に注意。  

## 起動方法

下記を実行すると初回はビルドされ、最後にappのみ停止するが次の「最初に実行すること」を行えば次回以降は起動したままになる。  

```
docker compose up -d
```

正常に稼働するとブラウザで http://localhost:8000/ からアクセス可能となる。  

### 最初に実行すること

下記は初回のみ必要なこと、次回以降は `docker compose up -d` だけで良い。  

```
docker compose run --rm app composer install
docker compose run --rm app php artisan migrate
docker compose start app
```

## 停止方法

```
docker compose stop
```

## コンテナ構成

- app
  - アプリケーションを動かすコンテナ
  - phpやcomposerが使える
- mysql
  - MySQLデータベース用のコンテナ
  - 接続情報は docker-compose.yml の services.mysql.environment.MYSQL_xxx を参照

## 備考

- 速度改善のためvendorフォルダはコンテナ側のボリュームとして定義しており、ホスト側には出てこない点に注意
  - IDEで参照が切れるのを防ぎたい場合は `docker compose cp app:/var/www/html/vendor .` でホスト側にコピーしてくると良い


```
docker compose exec app 

php artisan make:model Member -ms
php artisan make:model Phone -ms
php artisan make:model Post -ms

php artisan migrate:status

php artisan migrate:fresh

php artisan db:seed --class=Database\Seeders\MemberSeeder
php artisan db:seed --class=Database\Seeders\PhoneSeeder

php artisan db:seed --class=Database\Seeders\DatabaseSeeder

http://127.0.0.1:8000/members/phones
http://127.0.0.1:8000/members
```
