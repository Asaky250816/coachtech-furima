<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>
<body>
    <h1>商品一覧画面</h1>

    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    @endauth

    @guest
        <p><a href="{{ route('login') }}">ログインはこちら</a></p>
    @endguest

    <h2>商品一覧</h2>

    <form action="/" method="GET">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名で検索">
        <button type="submit">検索</button>
    </form>

    @if ($items->isEmpty())
        <p>商品データがありません</p>
    @else
        <div>
            @foreach ($items as $item)
                <div>
                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" width="200">

                    @if ($item->purchase)
                        <p>Sold</p>
                    @endif

                    <p>{{ $item->name }}</p>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>