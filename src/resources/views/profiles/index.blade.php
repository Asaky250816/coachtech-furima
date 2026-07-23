<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
</head>
<body>
    <h1>マイページ</h1>

    <h2>出品した商品</h2>

    @if ($items->isEmpty())
        <p>出品した商品はありません</p>
    @else
        <div>
            @foreach ($items as $item)
                <div>
                    <a href="{{ route('items.show', $item) }}">
                        <img src="{{ $item->image_path }}" alt="{{ $item->name }}" width="200">
                    </a>

                    @if ($item->purchase)
                        <p>Sold</p>
                    @endif

                    <p>
                        <a href="{{ route('items.show', $item) }}">
                            {{ $item->name }}
                        </a>
                    </p>
                </div>
            @endforeach
        </div>
    @endif

    <h2>購入した商品</h2>

    @if ($purchases->isEmpty())
        <p>購入した商品はありません</p>
    @else
        <div>
            @foreach ($purchases as $purchase)
                <div>
                    <a href="{{ route('items.show', $purchase->item) }}">
                        <img
                            src="{{ $purchase->item->image_path }}"
                            alt="{{ $purchase->item->name }}"
                            width="200"
                        >
                    </a>

                    <p>Sold</p>

                    <p>
                        <a href="{{ route('items.show', $purchase->item) }}">
                            {{ $purchase->item->name }}
                        </a>
                    </p>
                </div>
            @endforeach
        </div>
    @endif

    <p><a href="/">商品一覧へ戻る</a></p>
</body>
</html>
