#アプリケーション名
FashionablyLate
お問い合わせフォームアプリケーションです。  
ユーザーがフォームから問い合わせを送信し、確認画面 → サンクスページへ進みます。  
管理者画面では、お問い合わせ一覧・検索・詳細・削除が可能です。

---


##環境構築

Dockerビルド
-git clone ここに自分のGitHubのルート
-docker-compose -d --build

Laravel環境構築 
-docker-compose exec php bash
-composer install
-cp .env.example .env 環境変数を適宜変更
-php artisan key:generate APP_KEYの生成

開発環境


##使用技術(実行環境)

- PHP 8.x / Laravel 8.x
- MySQL 8.x
- Docker / docker-compose
- Blade
- CSS（sanitize.css / common.css / 各ページ専用CSS）

---

##ER図

##URL

