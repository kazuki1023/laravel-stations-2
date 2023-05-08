<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <ul>
    @foreach ($practices as $practice)
        <li>id: {{$practice->id }}</li>
        <li>タイトル: {{ $practice->title }}</li>
        <li>作成日時: {{ $practice->created_at }}</li>
    @endforeach
    </ul>
</body>
</html>