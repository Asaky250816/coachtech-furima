<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
</head>
<body>
    <h1>会員登録</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label for="name">ユーザー名</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">確認用パスワード</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>

        <button type="submit">登録する</button>
    </form>

    <p>
        <a href="{{ route('login') }}">ログインはこちら</a>
    </p>
</body>
</html>