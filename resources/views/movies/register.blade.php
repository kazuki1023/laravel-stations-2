@extends('layouts.index')

@section('content')
  <form action="/" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">タイトル</label>
      <input type="text" name="title" id="title">
    </div>
    <div class="form-group">
      <label for="image_url">画像URL</label>
      <input type="text" name="image_url" id="image_url">
    </div>
    <div class="form-group">
      <label for="published_year">公開年</label>
      <input type="text" name="published_year" id="published_year">
    </div>
    <div class="form-group">
      <label for="description">概要</label>
      <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
      <label for="is_showing">上映中かどうか</label>
      <input type="checkbox" name="is_showing" id="is_showing">
    </div>
    <input type="submit" value="登録">
  </form>
@endsection