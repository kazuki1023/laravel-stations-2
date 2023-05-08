<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <table>
    <tr>
      <th>タイトル</th>
      <th>画像URL</th>
      <th>制作年</th>
      <th>公開年</th>
      <th>概要</th>
      <th>登録日時</th>
      <th>更新日時</th>
      <th>上映中かどうか</th>
    </tr>
    @foreach ($movies as $movie)
      <tr>
        <td>{{ $movie->title }}</td>
        <td>{{ $movie->image_url }}</td>
        <td>{{ $movie->production_year }}</td>
        <td>{{ $movie->published_year }}</td>
        <td>{{ $movie->description }}</td>
        <td>{{ $movie->created_at }}</td>
        <td>{{ $movie->updated_at }}</td>
        @if ($movie->is_showing)
          <td>上映中</td>
        @else
          <td>上映終了</td>
        @endif
      </tr>
    <tr></tr>
  </table>
</body>
</html>