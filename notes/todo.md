2026-04-18

## 完了

- Docker環境構築完了
- Laravel 8 導入完了
- .env のDB設定完了
- 初期migration完了
- localhost / phpMyAdmin 表示確認完了

## 次にやること

- 追加テーブルの設計整理
- ER図の下書き
- items / categories / likes / comments / purchases の migration 作成準備

2026-04-20

## 完了

- Docker環境構築完了
- Laravel 8 導入完了
- .env のDB設定完了
- 初期migration完了
- localhost / phpMyAdmin 表示確認完了
- WBS更新完了
- テーブル設計メモ作成完了

## 今日やること

- users に追加するカラムを最終確認する
- 新規テーブル 6個の内容を最終確認する
- migration 作成コマンドを実行する

## 完了

- users追加カラム migration 完了
- items / categories / category_item / likes / comments / purchases migration 完了

2026-04-21

## 今日やること

- Model 作成
- User モデルの relation 追加
- Item モデルの relation 追加
- Category モデルの relation 追加
- Like / Comment / Purchase モデルの relation 追加
- できたら git 保存

## 先にやる順番

1. php コンテナに入る
2. src に移動する
3. Model を作る
4. relation を書く
5. 軽く見直す
6. git add / commit / push

## 今日やるコマンド

- docker compose exec php bash
- cd /var/www/src
- php artisan make:model Item
- php artisan make:model Category
- php artisan make:model Like
- php artisan make:model Comment
- php artisan make:model Purchase

## 完了

- Docker 起動確認
- Item / Category / Like / Comment / Purchase モデル作成完了
- User モデルの relation 設定完了
- Item モデルの relation 設定完了
- Category モデルの relation 設定完了
