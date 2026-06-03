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

## unit-testブランチの説明

- テスト対象の説明
  - 簡単な送料計算を行うウェブサイト
  - コントローラー app\Http\Controllers\ShippingFeeController.php
  - 計算ロジック app\Services\ShippingFeeCalculator.php
  - 簡単な仕様
    - 配送区分は「本州・四国・九州」「離島」「沖縄」があり、それぞれ配送料金は800円・1200円・1500円である
    - ただし、商品合計金額が10000円以上の場合は配送料金が0円となる
- テストコード
  - tests\Feature\ShippingPageTest.php
    - E2Eテストではなく擬似リクエストを投げるタイプ
  - tests\Unit\ShippingFeeCalculatorTest.php
    - ShippingFeeCalculatorクラスの単体テスト
- テスト用の画面は http://127.0.0.1:8000/shipping
- テストコードのひな型生成は `docker compose exec app php artisan make:test XxxTest --unit` で行う
- テストの実行は `docker compose exec app php artisan test` で行う
