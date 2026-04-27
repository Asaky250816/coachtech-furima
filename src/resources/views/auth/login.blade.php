<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password">
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember">
                ログイン状態を保持する
            </label>
        </div>

        <button type="submit">ログインする</button>
    </form>

    <p>
        <a href="{{ route('register') }}">会員登録はこちら</a>
    </p>
</body>
</html>