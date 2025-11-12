# 基礎学習ターム 確認テスト\_お問い合わせフォーム

## 環境構築

### Docker ビルド

#### 1. リポジトリをクローン

```bash
git clone git@github.com:EriEndo/eriendo-kadai1.git
cd eriendo-kadai1
```

#### 2. Docker の起動

```bash
Docker Desktop を起動
docker-compose up -d --build
```

---

### Laravel 環境構築

#### 1. Laravel のセットアップ

```bash
docker-compose exec php bash
composer install
cp .env.example .env
```

上記コマンドで .env ファイルを作成したら、開いて以下のように設定を変更します：

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

#### 2. アプリケーションキーの作成

```bash
php artisan key:generate
```

#### 3. マイグレーションの実行

```bash
php artisan migrate
```

#### 4. シーディングの実行

```bash
php artisan db:seed
```

---

## 開発環境

| 項目       | 内容                   |
| ---------- | ---------------------- |
| Web アプリ | http://localhost       |
| phpMyAdmin | http://localhost:8080/ |

---

## URL 一覧

| 機能                 | URL                       |
| -------------------- | ------------------------- |
| お問い合わせフォーム | http://localhost          |
| お問い合わせ確認画面 | （POST）/confirm          |
| 送信完了画面         | （POST 後に遷移）         |
| 管理者登録           | http://localhost/register |
| 管理者ログイン       | http://localhost/login    |
| 管理者画面           | http://localhost/admin    |
| 検索結果画面         | http://localhost/search   |
| CSV エクスポート     | http://localhost/export   |

---

## 使用技術（実行環境）

| カテゴリ       | 技術                    | バージョン |
| -------------- | ----------------------- | ---------- |
| フレームワーク | Laravel                 | 8.83.8     |
| 言語           | PHP                     | 8.1.33     |
| Web サーバ     | Nginx                   | 1.21.1     |
| データベース   | MySQL                   | 8.0.26     |
| 管理ツール     | phpMyAdmin              | 最新       |
| コンテナ環境   | Docker / Docker Compose | 3.8        |

---

## ER 図

![ER図](src/public/ERD.svg)

---

## 補足

- "The stream or file could not be opned"エラーが発生した場合は、ディレクトリ/ファイルの権限を変更してください

```bash
sudo chmod -R 777 src/staroge
```

- 以下 4 点について、要件シートとは異なる形で実装しました。いずれもコーチの許可を得ております。
  - 機能要件シート:FN005 の 2 つ目「ユーザー認証動線、会員登録画面からログイン画面に遷移できる」という機能はお問い合わせフォームの入力画面には必要ないと判断しそのように実装しました。
  - 機能要件シート:US007「管理者は管理画面を確認することができる」の内、要件 ID:FN018「お問い合わせ内容一覧取得」および要件 ID:FN019「お問い合わせ内容検索」において、「お問い合わせ"内容"」が必要と記載されていますが、デザイン UI に則り、いずれも「お問い合わせ"種類"」としました。
  - 開発プロセスシート:環境構築「ダミーデータが作成可能か」において、機能要件参照とありますが、機能要件シートで「1. お問い合わせ初期データ」について書かれているポイントを見るけることができませんでした。デザイン UI を基にダミーデータを作成しています。
  - お問い合わせフォームのバリデーションルールについて、基本設計書シートに「性別」の記載がありませんが、テーブル仕様書および機能要件から読み取って入力必須としました。

---
