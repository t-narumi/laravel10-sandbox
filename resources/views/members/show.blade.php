<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Detail</title>
    <style>
        body {
            font-family: "Segoe UI", "Hiragino Sans", sans-serif;
            margin: 24px;
            color: #1f2937;
            background: #f9fafb;
        }

        h1 {
            margin: 0 0 16px;
            font-size: 24px;
        }

        h2 {
            margin: 24px 0 10px;
            font-size: 20px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
        }

        .row {
            display: flex;
            gap: 12px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .label {
            width: 140px;
            color: #6b7280;
            font-weight: 600;
        }

        .value {
            color: #111827;
        }

        .table-wrap {
            overflow-x: auto;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background: #f3f4f6;
            font-weight: 600;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .empty {
            color: #6b7280;
            padding: 16px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .back {
            display: inline-block;
            margin-bottom: 16px;
            color: #2563eb;
            text-decoration: none;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <a class="back" href="{{ route('members.index') }}">← 一覧に戻る</a>
    <h1>Member 詳細</h1>

    <section class="card">
        <div class="row">
            <div class="label">ID</div>
            <div class="value">{{ $member->id }}</div>
        </div>
        <div class="row">
            <div class="label">名前</div>
            <div class="value">{{ $member->name }}</div>
        </div>
        <div class="row">
            <div class="label">年齢</div>
            <div class="value">{{ $member->age }}</div>
        </div>
        <div class="row">
            <div class="label">電話番号</div>
            <div class="value">{{ $member->phone?->phone_number ?? '-' }}</div>
        </div>
        <div class="row">
            <div class="label">機種</div>
            <div class="value">{{ $member->phone?->phone_model ?? '-' }}</div>
        </div>
        <div class="row">
            <div class="label">作成日時</div>
            <div class="value">{{ $member->created_at }}</div>
        </div>
        <div class="row">
            <div class="label">更新日時</div>
            <div class="value">{{ $member->updated_at }}</div>
        </div>
    </section>

    <h2>投稿一覧</h2>

    @if ($member->posts->isEmpty())
        <p class="empty">投稿データがありません。</p>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>投稿ID</th>
                        <th>投稿内容</th>
                        <th>作成日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($member->posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->post_content }}</td>
                            <td>{{ $post->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>
</html>
