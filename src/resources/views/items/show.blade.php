<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>
</head>
<body>
    <h1>商品詳細画面</h1>

    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" width="300">

    @if ($item->purchase)
        <p>Sold</p>
    @endif

    <h2>{{ $item->name }}</h2>
    <p>ブランド名：{{ $item->brand_name ?? 'なし' }}</p>
    <p>価格：¥{{ number_format($item->price) }}</p>
    <p>商品説明：{{ $item->description }}</p>
    <p>商品の状態：{{ $item->condition }}</p>

    <p><a href="/">商品一覧へ戻る</a></p>
</body>
</html>
