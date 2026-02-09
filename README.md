# アプリケーション名
FashionablyLate
お問い合わせフォームアプリケーションです。  
ユーザーがフォームから問い合わせを送信し、確認画面 → サンクスページへ進みます。  
管理者画面では、お問い合わせ一覧・検索・詳細・削除が可能です。

---


# 環境構築

## Dockerビルド
- git clone git@github.com:kokoro28k/fl-contact.git
- docker-compose up -d --build

## Laravel環境構築 
- docker-compose exec php bash
- composer install
- cp .env.example .env 環境変数を適宜変更
- php artisan key:generate APP_KEYの生成
- php artisan migrate
- php artisan db:seed

## 開発環境
- お問い合わせ画面: [http://localhost/](http://localhost/)
- 新規登録画面: [http://localhost/register](http://localhost/register)
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)


## 使用技術(実行環境)

- PHP 8.1(FPM)
- Laravel 8.x
- MySQL 8.0.26
- Docker / docker-compose
- nginx 1.21.1


##ER図

![ER図](./fl-contact-er.png)

