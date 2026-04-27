# ER図

```mermaid
erDiagram
    USERS ||--o{ ITEMS : sells
    USERS ||--o{ LIKES : likes
    USERS ||--o{ COMMENTS : writes
    USERS ||--o{ PURCHASES : buys

    ITEMS ||--o{ LIKES : liked_by
    ITEMS ||--o{ COMMENTS : has
    ITEMS ||--o| PURCHASES : purchased
    ITEMS ||--o{ CATEGORY_ITEM : categorized_as

    CATEGORIES ||--o{ CATEGORY_ITEM : includes

    USERS {
        bigint id PK
        varchar name
        varchar email UK
        timestamp email_verified_at
        varchar password
        varchar remember_token
        varchar profile_image
        varchar postal_code
        varchar address
        varchar building
        timestamp created_at
        timestamp updated_at
    }

    ITEMS {
        bigint id PK
        bigint user_id FK
        varchar name
        varchar brand_name
        text description
        int price
        varchar image_path
        varchar condition
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES {
        bigint id PK
        varchar name
        timestamp created_at
        timestamp updated_at
    }

    CATEGORY_ITEM {
        bigint id PK
        bigint item_id FK
        bigint category_id FK
        timestamp created_at
        timestamp updated_at
    }

    LIKES {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        timestamp created_at
        timestamp updated_at
    }

    COMMENTS {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        text content
        timestamp created_at
        timestamp updated_at
    }

    PURCHASES {
        bigint id PK
        bigint user_id FK
        bigint item_id FK
        varchar payment_method
        varchar postal_code
        varchar address
        varchar building
        timestamp created_at
        timestamp updated_at
    }
```

## 制約メモ

- `users.email` はユニーク
- `likes` は `user_id + item_id` の複合ユニーク
- `category_item` は `item_id + category_id` の複合ユニーク
- `purchases.item_id` はユニーク（1商品につき購入レコードは1件）
- FK はすべて `cascadeOnDelete`

---

## ER図（レイアウト調整版）

以下は、関係の見通しを優先した配置版です。

```mermaid
flowchart LR
    subgraph U[ユーザー領域]
        USERS[(USERS)]
    end

    subgraph C[カテゴリ領域]
        CATEGORIES[(CATEGORIES)]
        CATEGORY_ITEM[(CATEGORY_ITEM)]
    end

    subgraph I[商品領域]
        ITEMS[(ITEMS)]
    end

    subgraph A[アクション領域]
        LIKES[(LIKES)]
        COMMENTS[(COMMENTS)]
        PURCHASES[(PURCHASES)]
    end

    USERS -->|1:N| ITEMS
    USERS -->|1:N| LIKES
    USERS -->|1:N| COMMENTS
    USERS -->|1:N| PURCHASES

    ITEMS -->|1:N| LIKES
    ITEMS -->|1:N| COMMENTS
    ITEMS -->|1:0..1| PURCHASES

    ITEMS -->|1:N| CATEGORY_ITEM
    CATEGORIES -->|1:N| CATEGORY_ITEM

    LIKES -. UK user_id+item_id .- LIKES
    CATEGORY_ITEM -. UK item_id+category_id .- CATEGORY_ITEM
    PURCHASES -. UK item_id .- PURCHASES
```

---

## ER図（印刷版: A4縦向け）

以下は、印刷時に縦方向で追いやすい配置版です。

```mermaid
flowchart TB
    subgraph TOP[マスタ]
        USERS[(USERS)]
        CATEGORIES[(CATEGORIES)]
    end

    subgraph MID[主テーブル]
        ITEMS[(ITEMS)]
        CATEGORY_ITEM[(CATEGORY_ITEM)]
    end

    subgraph BTM[履歴・イベント]
        LIKES[(LIKES)]
        COMMENTS[(COMMENTS)]
        PURCHASES[(PURCHASES)]
    end

    USERS -->|1:N| ITEMS
    CATEGORIES -->|1:N| CATEGORY_ITEM
    ITEMS -->|1:N| CATEGORY_ITEM

    USERS -->|1:N| LIKES
    USERS -->|1:N| COMMENTS
    USERS -->|1:N| PURCHASES

    ITEMS -->|1:N| LIKES
    ITEMS -->|1:N| COMMENTS
    ITEMS -->|1:0..1| PURCHASES

    LIKES -. UK user_id+item_id .- LIKES
    CATEGORY_ITEM -. UK item_id+category_id .- CATEGORY_ITEM
    PURCHASES -. UK item_id .- PURCHASES
```
