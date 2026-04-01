<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stateful</title>
</head>
<body>
    <h1>{{ $message }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('stateful.store') }}">
        @csrf
        <label>
            名前
            <input type="text" name="name" value="{{ old('name', $name ?? '') }}">
        </label>
        <button type="submit">送信</button>
    </form>

    <p>
        <a href="{{ route('stateful.index') }}">もう一度アクセス（GET）</a>
    </p>
</body>
</html>
