# coachtechフリマ

## 環境構築

※ Docker関連のコマンドは、プロジェクト直下で実行してください。  
※ `php artisan` コマンドは、PHPコンテナ内で実行してください。

### Dockerビルド

```bash
docker compose up -d --build
```

### PHPコンテナに入る

```bash
docker compose exec php bash
```

### パッケージインストール

```bash
composer install
```

### 環境変数ファイルの作成

```bash
cp .env.example .env
```

### アプリケーションキーの作成

```bash
php artisan key:generate
```

### マイグレーション実行

```bash
php artisan migrate
```

### ストレージリンク作成

```bash
php artisan storage:link
```

### 画像保存用ディレクトリ作成

```bash
mkdir -p storage/app/public/profile_images
mkdir -p storage/app/public/item_images
```

## 使用技術

- PHP 8.x
- Laravel 8.x
- MySQL 8.x
- Docker
- Nginx

## URL

- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/

## 動作確認ブランチ

本リポジトリは `main` ブランチで動作確認できます。

開発は機能ごとにブランチを分けて進め、提出時に実装内容を `main` ブランチへマージしています。
