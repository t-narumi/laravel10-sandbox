<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿チャットタイムライン</title>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", "Hiragino Sans", sans-serif;
            background: linear-gradient(180deg, #ecfeff 0%, #f8fafc 100%);
            color: #0f172a;
        }

        .container {
            max-width: 920px;
            margin: 0 auto;
            padding: 20px 14px 40px;
        }

        h1 {
            margin: 0 0 4px;
            font-size: 24px;
        }

        .sub {
            margin: 0 0 18px;
            color: #475569;
            font-size: 14px;
        }

        .chat-wrap {
            border: 1px solid #dbeafe;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.88);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            padding: 14px;
        }

        .empty {
            margin: 0;
            padding: 20px;
            color: #64748b;
        }

        .chat-item {
            display: flex;
            margin: 10px 0;
        }

        .chat-item.right {
            justify-content: flex-end;
        }

        .bubble {
            max-width: min(78%, 640px);
            border-radius: 14px;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .chat-item.right .bubble {
            background: #dcfce7;
            border-color: #bbf7d0;
        }

        .meta {
            display: flex;
            gap: 8px;
            align-items: baseline;
            margin-bottom: 4px;
            font-size: 12px;
        }

        .name {
            font-weight: 700;
            color: #0369a1;
        }

        .time {
            color: #64748b;
        }

        .message {
            margin: 0;
            font-size: 14px;
            line-height: 1.45;
            white-space: pre-wrap;
            word-break: break-word;
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
            font-size: 14px;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>全会員 投稿チャット</h1>
        <p class="sub">全投稿を時系列で表示しています。</p>

        <div class="chat-wrap">
            @if ($posts->isEmpty())
                <p class="empty">投稿データがありません。</p>
            @else
                @foreach ($posts as $post)
                    <div class="chat-item {{ $post->member_id % 2 === 0 ? 'right' : '' }}">
                        <div class="bubble">
                            <div class="meta">
                                <span class="name">{{ $post->member?->name ?? 'Unknown' }}</span>
                                <span class="time">{{ $post->created_at?->format('Y-m-d H:i') }}</span>
                            </div>
                            <p class="message">{{ $post->post_content }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="links">
            <a href="{{ route('members.index') }}">Member 一覧へ</a>
            <a href="{{ route('members.phones.index') }}">Member / Phone 一覧へ</a>
        </div>
    </div>
</body>
</html>
