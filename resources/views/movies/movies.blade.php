@extends('layouts.index')

@section('content')
<table>
  <tr>
    <th>タイトル</th>
    <th>画像URL</th>
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
      <td>{{ $movie->published_year }}</td>
      <td>{{ $movie->description }}</td>
      <td>{{ $movie->created_at }}</td>
      <td>{{ $movie->updated_at }}</td>
      @if ($movie->is_showing)
        <td>上映中</td>
      @else
        <td>上映予定</td>
      @endif
    </tr>
  @endforeach
</table>
@endsection