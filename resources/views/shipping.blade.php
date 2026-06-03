<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>送料計算</title>
</head>
<body>
<h1>送料計算</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="get" action="{{ url('/shipping') }}">
    <div>
        <label>
            商品合計（円）
            <input type="number" name="subtotal" min="0" step="1" value="{{ old('subtotal', $subtotal) }}">
        </label>
    </div>

    <div>
        <label>
            配送地域
            <select name="zone">
                @foreach ($zones as $value => $label)
                    <option value="{{ $value }}" @selected(old('zone', $zone) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <button type="submit">計算</button>
</form>

@if (!is_null($shippingFee))
    <hr>
    <div>送料: {{ number_format($shippingFee) }} 円</div>
@endif

</body>
</html>
