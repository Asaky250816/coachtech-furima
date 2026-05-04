# Route / Controller メモ

## 方針
- まずは要件シートにある URL を優先する
- 認証まわりは Fortify を使う
- 商品一覧と商品詳細を先に実装しやすい形にする
- 後で実装とズレたら必ず修正する

---

## Route 一覧（たたき台）

### 認証
| URL | Method | Controller | Action | 備考 |
|---|---|---|---|---|
| /login | GET | Fortify | loginView | ログイン画面表示 |
| /login | POST | Fortify | login | ログイン処理 |
| /register | GET | Fortify | registerView | 会員登録画面表示 |
| /register | POST | Fortify | register | 会員登録処理 |
| /logout | POST | Fortify | logout | ログアウト処理 |

---

### 商品一覧・商品詳細
| URL | Method | Controller | Action | 備考 |
|---|---|---|---|---|
| / | GET | ItemController | index | 商品一覧画面 |
| /?tab=mylist | GET | ItemController | index | マイリスト表示切替 |
| /item/{item_id} | GET | ItemController | show | 商品詳細画面 |

---

### コメント・いいね
| URL | Method | Controller | Action | 備考 |
|---|---|---|---|---|
| /item/{item_id}/comments | POST | CommentController | store | コメント投稿 |
| /item/{item_id}/like | POST | LikeController | store | いいね追加 |
| /item/{item_id}/like | DELETE | LikeController | destroy | いいね解除 |

---

### 購入
| URL | Method | Controller | Action | 備考 |
|---|---|---|---|---|
| /purchase/{item_id} | GET | PurchaseController | create | 商品購入画面 |
| /purchase/{item_id} | POST | PurchaseController | store | 購入処理 |
| /purchase/address/{item_id} | GET | PurchaseController | editAddress | 送付先住所変更画面 |
| /purchase/address/{item_id} | POST | PurchaseController | updateAddress | 送付先住所更新 |

---

### 出品
| URL | Method | Controller | Action | 備考 |
|---|---|---|---|---|
| /sell | GET | SellController | create | 商品出品画面 |
| /sell | POST | SellController | store | 商品出品処理 |

---

### マイページ
| URL | Method | Controller | Action | 備考 |
|---|---|---|---|---|
| /mypage | GET | ProfileController | show | プロフィール画面 |
| /mypage?page=buy | GET | ProfileController | show | 購入商品一覧切替 |
| /mypage?page=sell | GET | ProfileController | show | 出品商品一覧切替 |
| /mypage/profile | GET | ProfileController | edit | プロフィール編集画面 |
| /mypage/profile | POST | ProfileController | update | プロフィール更新処理 |

---

## Controller 一覧（たたき台）
- ItemController
- CommentController
- LikeController
- PurchaseController
- SellController
- ProfileController

---

## 実装優先順
1. ItemController
2. ProfileController
3. SellController
4. CommentController
5. LikeController
6. PurchaseController

---

## メモ
- /login と /register は Fortify を使用
- 商品一覧とマイリストは同じ ItemController@index で切り替える想定
- /mypage?page=buy と /mypage?page=sell は同じ ProfileController@show で切り替える想定
- URL は要件シート優先