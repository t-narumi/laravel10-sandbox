<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member / Role 一覧</title>
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
            min-width: 720px;
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            font-weight: 600;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .roles {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            max-width: 520px;
        }

        .role-chip {
            display: inline-block;
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: #1e3a8a;
            border-radius: 999px;
            padding: 2px 10px;
            font-size: 12px;
            line-height: 1.5;
        }

        .none {
            color: #9ca3af;
        }

        .links {
            margin-top: 14px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .links a {
            color: #2563eb;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Member / Role 一覧</h1>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>年齢</th>
                    <th>Role数</th>
                    <th>Role一覧</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
                    <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->age }}</td>
                        <td>{{ $member->roles_count }}</td>
                        <td>
                            @if ($member->roles->isEmpty())
                                <span class="none">-</span>
                            @else
                                <div class="roles">
                                    @foreach ($member->roles as $role)
                                        <span class="role-chip">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">データがありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="links">
        <a href="{{ route('members.index') }}">Member 一覧へ</a>
        <a href="{{ route('posts.chat') }}">投稿チャットへ</a>
    </div>
</body>
</html>
