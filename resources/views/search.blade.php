<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>検索</h2>
    <form action="/search" method="get">
        <input type="text" name="q">
        <button>Search</button>
    </form>
    <h3>検索キーワード</h3>
    <p>{{ $keyword }}</p>
</body>
</html>