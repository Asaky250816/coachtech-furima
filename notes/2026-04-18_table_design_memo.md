# テーブル設計メモ

## 設計方針

- テーブル数は 9 個以内に収める
- 基本要件を優先して実装する
- カテゴリは複数選択に対応するため、多対多で設計する
- 購入時の配送先住所は purchases テーブルに保存する
- 商品画像とプロフィール画像は storage に保存し、DB にはパスを保存する
- 購入済み判定は purchases テーブルの存在で判断する想定

---

## users に追加するカラム

- profile_image
- postal_code
- address
- building

### users 追加カラム詳細

| カラム名      | 型     | NULL | 用途                       |
| ------------- | ------ | ---- | -------------------------- |
| profile_image | string | 可   | プロフィール画像の保存パス |
| postal_code   | string | 可   | 郵便番号                   |
| address       | string | 可   | 住所                       |
| building      | string | 可   | 建物名                     |

---

## 新規テーブル一覧

- items
- categories
- category_item
- likes
- comments
- purchases

---

## テーブル詳細

### 1. items

商品情報を管理するテーブル

| カラム名    | 型                 | NULL | KEY | 用途             |
| ----------- | ------------------ | ---- | --- | ---------------- |
| id          | unsignedBigInteger | 不可 | PK  | 商品ID           |
| user_id     | unsignedBigInteger | 不可 | FK  | 出品者ユーザーID |
| name        | string             | 不可 |     | 商品名           |
| brand_name  | string             | 可   |     | ブランド名       |
| description | text               | 不可 |     | 商品説明         |
| price       | integer            | 不可 |     | 販売価格         |
| image_path  | string             | 不可 |     | 商品画像パス     |
| condition   | string             | 不可 |     | 商品状態         |
| created_at  | timestamp          | 不可 |     | 作成日時         |
| updated_at  | timestamp          | 不可 |     | 更新日時         |

#### 補足

- user_id は users.id を参照
- condition は「良好」「目立った傷や汚れなし」「やや傷や汚れあり」「状態が悪い」などを想定
- 画像は storage 保存

---

### 2. categories

カテゴリマスタを管理するテーブル

| カラム名   | 型                 | NULL | KEY | 用途       |
| ---------- | ------------------ | ---- | --- | ---------- |
| id         | unsignedBigInteger | 不可 | PK  | カテゴリID |
| name       | string             | 不可 |     | カテゴリ名 |
| created_at | timestamp          | 不可 |     | 作成日時   |
| updated_at | timestamp          | 不可 |     | 更新日時   |

#### 補足

- 出品時に選択するカテゴリ一覧
- Seeder で初期データを入れる想定

---

### 3. category_item

商品とカテゴリの中間テーブル

| カラム名    | 型                 | NULL | KEY | 用途       |
| ----------- | ------------------ | ---- | --- | ---------- |
| id          | unsignedBigInteger | 不可 | PK  | ID         |
| item_id     | unsignedBigInteger | 不可 | FK  | 商品ID     |
| category_id | unsignedBigInteger | 不可 | FK  | カテゴリID |
| created_at  | timestamp          | 不可 |     | 作成日時   |
| updated_at  | timestamp          | 不可 |     | 更新日時   |

#### 補足

- item_id は items.id を参照
- category_id は categories.id を参照
- 商品は複数カテゴリを持てる

---

### 4. likes

いいね情報を管理するテーブル

| カラム名   | 型                 | NULL | KEY | 用途                 |
| ---------- | ------------------ | ---- | --- | -------------------- |
| id         | unsignedBigInteger | 不可 | PK  | ID                   |
| user_id    | unsignedBigInteger | 不可 | FK  | いいねしたユーザーID |
| item_id    | unsignedBigInteger | 不可 | FK  | いいね対象商品ID     |
| created_at | timestamp          | 不可 |     | 作成日時             |
| updated_at | timestamp          | 不可 |     | 更新日時             |

#### 補足

- user_id は users.id を参照
- item_id は items.id を参照
- user_id と item_id の組み合わせは重複しないようにしたい

---

### 5. comments

商品コメントを管理するテーブル

| カラム名   | 型                 | NULL | KEY | 用途                   |
| ---------- | ------------------ | ---- | --- | ---------------------- |
| id         | unsignedBigInteger | 不可 | PK  | ID                     |
| user_id    | unsignedBigInteger | 不可 | FK  | コメント投稿ユーザーID |
| item_id    | unsignedBigInteger | 不可 | FK  | コメント対象商品ID     |
| content    | text               | 不可 |     | コメント内容           |
| created_at | timestamp          | 不可 |     | 作成日時               |
| updated_at | timestamp          | 不可 |     | 更新日時               |

#### 補足

- user_id は users.id を参照
- item_id は items.id を参照
- バリデーションで 255 文字以内に制御する

---

### 6. purchases

購入情報と配送先住所を管理するテーブル

| カラム名       | 型                 | NULL | KEY | 用途             |
| -------------- | ------------------ | ---- | --- | ---------------- |
| id             | unsignedBigInteger | 不可 | PK  | 購入ID           |
| user_id        | unsignedBigInteger | 不可 | FK  | 購入者ユーザーID |
| item_id        | unsignedBigInteger | 不可 | FK  | 購入商品ID       |
| payment_method | string             | 不可 |     | 支払い方法       |
| postal_code    | string             | 不可 |     | 配送先郵便番号   |
| address        | string             | 不可 |     | 配送先住所       |
| building       | string             | 可   |     | 配送先建物名     |
| created_at     | timestamp          | 不可 |     | 作成日時         |
| updated_at     | timestamp          | 不可 |     | 更新日時         |

#### 補足

- user_id は users.id を参照
- item_id は items.id を参照
- 支払い方法は「コンビニ支払い」「カード支払い」を想定
- 購入時点の配送先住所を保存する

---

## リレーションメモ

### User

- hasMany Items
- hasMany Likes
- hasMany Comments
- hasMany Purchases

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

## 現時点のテーブル構成まとめ

- users
- items
- categories
- category_item
- likes
- comments
- purchases

合計 7 テーブル

---

## 今後確認すること

- users 追加カラムの migration 方法
- likes の複合ユニーク制約を入れるか
- category_item の複合ユニーク制約を入れるか
- items.condition を文字列で持つか数値で持つか
- 購入済み判定を purchases ベースで進めるか最終確認
