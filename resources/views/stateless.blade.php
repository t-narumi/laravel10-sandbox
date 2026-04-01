<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stateless</title>
</head>
<body>
    <h1>{{ $message }}</h1>

    @if (!empty($error))
        <p style="color: red;">{{ $error }}</p>
    @endif

    <form method="POST" action="{{ route('stateless.store') }}">
        <label>
            名前
            <input type="text" name="name" value="">
        </label>
        <button type="submit">送信</button>
    </form>

    <p>
        <a href="{{ route('stateless.index') }}">もう一度アクセス（GET）</a>
    </p>
</body>
</html>
