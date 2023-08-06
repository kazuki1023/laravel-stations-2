@extends('layouts.adminIndex')

@section('content')
    <form action="/admin/movies/store" method="POST" class="">
        @csrf
        <div class="mb-6 w-4/5">
            @error('title')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Danger alert!</span> {{ $message }}
                </div>
            @enderror
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">タイトル</label>
            <input type="text" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="title"  value="{{ old('title')}}">
        </div>
        <div class="mb-6 w-4/5">
            @error('image_url')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Danger alert!</span> {{ $message }}
                </div>
            @enderror
            <label for="image_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">画像URL</label>
            <input type="text" id="image_url"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="image_url"   value="{{ old('image_url')}}">
        </div>
        <div class="mb-6 w-4/5">
            @error('published_year')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Danger alert!</span> {{ $message }}
                </div>
            @enderror
            <label for="published_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">公開年</label>
            <input type="text" id="published_year"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="published_year"   value="{{ old('published_year')}}">
        </div>
        <div class="w-4/5 mb-6">
            @error('is_showing')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Danger alert!</span> {{ $message }}
                </div>
            @enderror
            <label for="is_showing" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">上映中かどうか</label>
            <select id="is_showing"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="is_showing"   value="{{ old('is_showing')}}">
                <option selected>
                    @if (old('is_showing'))
                        上映中
                    @else
                        上映予定
                    @endif
                </option>
                <option value=true>上映中</option>
                <option value=false>上映予定</option>
            </select>
        </div>
        <div class="w-4/5 mb-6">
            @error('description')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium">Danger alert!</span> {{ $message }}
                </div>
            @enderror
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">概要</label>
            <textarea id="description" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your thoughts here..." name="description"  >{{ old('description')}}</textarea>
        </div>
        <div class="mb-6 w-4/5">
            @error('genre')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Danger alert!</span> {{ $message }}
                </div>
            @enderror
            <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ジャンル</label>
            <input type="text" id="genre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="genre"  value="{{ old('genre')}}">
        </div>
        <div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                name="submit">登録</button>
        </div>
    </form>
@endsection
