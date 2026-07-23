<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール設定</title>
</head>
<body>
    <h1>プロフィール設定</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label for="profile_image">プロフィール画像</label>
            <input type="file" id="profile_image" name="profile_image">
        </div>

        <div>
            <label for="name">ユーザー名</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', auth()->user()->name) }}"
            >

            @error('name')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="postal_code">郵便番号</label>
            <input
                type="text"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', optional(auth()->user()->profile)->postal_code) }}"
            >

            @error('postal_code')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="address">住所</label>
            <input
                type="text"
                id="address"
                name="address"
                value="{{ old('address', optional(auth()->user()->profile)->address) }}"
            >

            @error('address')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="building">建物名</label>
            <input
                type="text"
                id="building"
                name="building"
                value="{{ old('building', optional(auth()->user()->profile)->building) }}"
            >
        </div>

        <button type="submit">更新する</button>
    </form>
</body>
</html>
