<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая статья</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.5;">
    <h1>Добавлена новая статья</h1>
    <p>Модератору отправлено уведомление о публикации.</p>

    <p><strong>Название:</strong> {{ $article->name }}</p>
    <p><strong>Дата:</strong> {{ $article->date?->format('d.m.Y') }}</p>
    <p><strong>Краткое описание:</strong></p>
    <p>{{ $article->short_desc }}</p>

    <p>
        <a href="{{ route('articles.show', $article) }}">
            Открыть статью на сайте
        </a>
    </p>
</body>
</html>
