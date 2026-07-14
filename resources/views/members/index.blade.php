<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
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

        a {
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .empty {
            color: #6b7280;
            padding: 16px;
        }
    </style>
</head>
<body>
    <h1>Member 一覧</h1>

    @if ($members->isEmpty())
        <p class="empty">データがありません。</p>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>年齢</th>
                        <th>投稿数</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->age }}</td>
                            <td>{{ $member->posts_count }}</td>
                            <td><a href="{{ route('members.show', $member) }}">詳細を見る</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>
</html>
