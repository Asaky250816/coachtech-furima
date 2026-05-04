# テーブル設計メモ

## 設計方針
- テーブル数は 9 個以内に収める
- 基本要件を優先して実装する
- カテゴリは複数選択に対応するため、多対多で設計する
- 購入時の配送先住所は purchases テーブルに保存する
- 商品画像とプロフィール画像は storage に保存し、DB にはパスを保存する
- 購入済み判定は purchases テーブルの存在で判断する想定
- 認証情報とプロフィール情報は分離する
- ただし `users.name` は Laravel / Fortify との整合を考えて残す
- プロフィール固有情報は `profiles` テーブルで管理する

---

## テーブル一覧
- users
- profiles
- items
- categories
- category_item
- likes
- comments
- purchases

合計 8 テーブル

---

## users テーブル
認証とユーザー基本情報を管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | ユーザーID |
| name | string | 不可 |  | ユーザー名 |
| email | string | 不可 | UK | メールアドレス |
| email_verified_at | timestamp | 可 |  | メール認証日時 |
| password | string | 不可 |  | パスワード |
| remember_token | string | 可 |  | ログイン保持トークン |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- Laravel 標準の users テーブルをベースにする
- `email` はユニーク制約あり
- `name` は会員登録時に必要なため users に残す

---

## profiles テーブル
プロフィール情報を管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | プロフィールID |
| user_id | unsignedBigInteger | 不可 | FK | 対応するユーザーID |
| profile_image | string | 可 |  | プロフィール画像パス |
| postal_code | string | 可 |  | 郵便番号 |
| address | string | 可 |  | 住所 |
| building | string | 可 |  | 建物名 |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- `user_id` は `users.id` を参照
- ユーザーごとにプロフィールは 1 件の想定
- `user_id` にユニーク制約を付ける想定
- 画像は storage 保存

---

## items テーブル
商品情報を管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | 商品ID |
| user_id | unsignedBigInteger | 不可 | FK | 出品者ユーザーID |
| name | string | 不可 |  | 商品名 |
| brand_name | string | 可 |  | ブランド名 |
| description | text | 不可 |  | 商品説明 |
| price | integer | 不可 |  | 販売価格 |
| image_path | string | 不可 |  | 商品画像パス |
| condition | string | 不可 |  | 商品状態 |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- `user_id` は `users.id` を参照
- `condition` は「良好」「目立った傷や汚れなし」「やや傷や汚れあり」「状態が悪い」などを想定
- 画像は storage 保存

---

## categories テーブル
カテゴリマスタを管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | カテゴリID |
| name | string | 不可 |  | カテゴリ名 |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- 出品時に選択するカテゴリ一覧
- Seeder で初期データを入れる想定

---

## category_item テーブル
商品とカテゴリの中間テーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | ID |
| item_id | unsignedBigInteger | 不可 | FK | 商品ID |
| category_id | unsignedBigInteger | 不可 | FK | カテゴリID |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- `item_id` は `items.id` を参照
- `category_id` は `categories.id` を参照
- 商品は複数カテゴリを持てる
- `item_id` と `category_id` の組み合わせは複合ユニーク制約を付ける想定

---

## likes テーブル
いいね情報を管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | ID |
| user_id | unsignedBigInteger | 不可 | FK | いいねしたユーザーID |
| item_id | unsignedBigInteger | 不可 | FK | いいね対象商品ID |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- `user_id` は `users.id` を参照
- `item_id` は `items.id` を参照
- `user_id` と `item_id` の組み合わせは複合ユニーク制約を付ける想定

---

## comments テーブル
商品コメントを管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | ID |
| user_id | unsignedBigInteger | 不可 | FK | コメント投稿ユーザーID |
| item_id | unsignedBigInteger | 不可 | FK | コメント対象商品ID |
| content | text | 不可 |  | コメント内容 |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- `user_id` は `users.id` を参照
- `item_id` は `items.id` を参照
- バリデーションで 255 文字以内に制御する

---

## purchases テーブル
購入情報と配送先住所を管理するテーブル

| カラム名 | 型 | NULL | KEY | 用途 |
|---|---|---|---|---|
| id | unsignedBigInteger | 不可 | PK | 購入ID |
| user_id | unsignedBigInteger | 不可 | FK | 購入者ユーザーID |
| item_id | unsignedBigInteger | 不可 | FK | 購入商品ID |
| payment_method | string | 不可 |  | 支払い方法 |
| postal_code | string | 不可 |  | 配送先郵便番号 |
| address | string | 不可 |  | 配送先住所 |
| building | string | 可 |  | 配送先建物名 |
| created_at | timestamp | 不可 |  | 作成日時 |
| updated_at | timestamp | 不可 |  | 更新日時 |

### 補足
- `user_id` は `users.id` を参照
- `item_id` は `items.id` を参照
- 支払い方法は「コンビニ支払い」「カード支払い」を想定
- 購入時点の配送先住所を保存する
- `item_id` はユニーク制約を付ける想定

---

## リレーションメモ

### User
- hasOne Profile
- hasMany Items
- hasMany Likes
- hasMany Comments
- hasMany Purchases

### Profile
- belongsTo User

### Item
- belongsTo User
- belongsToMany Categories
- hasMany Likes
- hasMany Comments
- hasOne Purchase

### Category
- belongsToMany Items

### Like
- belongsTo User
- belongsTo Item

### Comment
- belongsTo User
- belongsTo Item

### Purchase
- belongsTo User
- belongsTo Item

---

## 現時点の構成まとめ
- users
- profiles
- items
- categories
- category_item
- likes
- comments
- purchases

合計 8 テーブル

---

## 今後確認すること
- profiles.user_id にユニーク制約を付ける
- User モデルに profile() を追加する
- Profile モデルを新規作成する
- users テーブルからプロフィール項目を削除する migration を作る
- ER図を profiles 追加版に修正する
- 要件シートのテーブル仕様書を修正する