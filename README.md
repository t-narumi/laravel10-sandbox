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

## queueブランチの説明

このブランチではlaravelのキュー動作のサンプルを実装している。  

- app/Jobs/SampleJob.php
  - キューに投入するジョブのサンプルコード
  - handleメソッド内で10秒スリープしているが、実際にはここに時間のかかる処理を実装する想定
  - このファイルは `docker compose exec app php artisan make:job SampleJob` でひな形を作成した
- app/Console/Commands/DispatchSampleJob.php
  - コマンドラインからキューにジョブを投入するためのサンプルコード
  - 引数で渡した文字列をSampleJobのコンストラクタに渡している
  - このファイルは `docker compose exec app php artisan make:command DispatchSampleJob` でひな形を作成した

### 最初に実行すること

既にコンテナを作成済みの場合はビルドし直す。  
**ビルドし直さないと環境変数の QUEUE_CONNECTION がデフォルトのままになり意図した動作をしない点に注意**

```
docker compose stop
docker compose up -d --build
```

次にマイグレーションを実行する。  

```
docker compose exec app php artisan migrate
```

### キューの動作を試す

下記のコマンドでキューにジョブを投入する。  

```
docker compose exec app php artisan app:dispatch-sample-job
```

この状態でDBに接続し、jobsテーブルの内容を確認すると、キューにジョブが投入されていることがわかる。  
次に下記のコマンドでキューワーカーを起動する。  

```
docker compose exec app php artisan queue:work
```

キューワーカーがジョブを処理し、処理が完了するとjobsテーブルから該当のジョブが削除される。  
storage/logs/laravel.log を見ると、SampleJobのhandleメソッド内で10秒スリープしていることがわかる。  
複数のワーカーを起動したいなら新しいターミナルを開いて同じコマンドを実行すれば良い。  

コンテナ内で動いているプロセスを確認するには下記のコマンドを実行する。

```
docker compose top app
```
