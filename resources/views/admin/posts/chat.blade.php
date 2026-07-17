<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面 投稿チャット</title>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", "Hiragino Sans", sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        .container {
            max-width: 980px;
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
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            background: #ffffff;
            padding: 14px;
        }

        .chat-item {
            display: flex;
            margin: 10px 0;
        }

        .bubble {
            max-width: min(86%, 700px);
            border-radius: 12px;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
            font-size: 12px;
            flex-wrap: wrap;
        }

        .name {
            font-weight: 700;
            color: #0f172a;
        }

        .time {
            color: #64748b;
        }

        .status {
            font-size: 11px;
            padding: 1px 6px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #f3f4f6;
            color: #374151;
        }

        .status.withdrawn {
            border-color: #fecaca;
            background: #fee2e2;
            color: #991b1b;
        }

        .message {
            margin: 0;
            font-size: 14px;
            line-height: 1.45;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .empty {
            margin: 0;
            padding: 20px;
            color: #64748b;
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
        <h1>管理画面 投稿チャット</h1>
        <p class="sub">退会済み会員の投稿も含めて時系列で表示しています。</p>

        <div class="chat-wrap">
            @if ($posts->isEmpty())
                <p class="empty">投稿データがありません。</p>
            @else
                @foreach ($posts as $post)
                    <div class="chat-item">
                        <div class="bubble">
                            <div class="meta">
                                <span class="name">{{ $post->member?->name ?? 'Unknown' }}</span>
                                <span class="time">{{ $post->created_at?->format('Y-m-d H:i') }}</span>
                                @if ($post->member?->withdrawn_on)
                                    <span class="status withdrawn">退会済み</span>
                                @else
                                    <span class="status">有効会員</span>
                                @endif
                            </div>
                            <p class="message">{{ $post->post_content }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="links">
            <a href="{{ route('posts.chat') }}">一般向けチャット画面へ</a>
            <a href="{{ route('members.index') }}">Member 一覧へ</a>
        </div>
    </div>
</body>
</html>
