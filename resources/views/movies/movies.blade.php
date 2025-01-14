@extends('layouts.index')

@section('content')
    {{-- 削除成功のflashメッセージを表示させる --}}
    @if (session('delete_success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Success!</span> {{ session('delete_success') }}
        </div>
    @endif
    <div class="mb-4 flex justify-center ">
        {{ $movies->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        映画タイトル
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        画像URL
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        公開年
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        概要
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        登録日時
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        更新日時
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        公開中かどうか
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        編集
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50">
                        削除
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $movie->id }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                            {{ $movie->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $movie->image_url }}
                        </td>
                        <td class="px-6 py-4 dark:bg-gray-800">
                            {{ $movie->published_year }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $movie->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $movie->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $movie->updated_at }}
                        </td>
                        @if ($movie->is_showing)
                            <td class="px-6 py-4">
                                上映中
                            </td>
                        @else
                            <td class="px-6 py-4">
                                上映予定
                            </td>
                        @endif
                        <td class="px-6 py-4">
                            <a href="/admin/movies/{{ $movie->id }}/edit"
                                class="text-indigo-800 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">編集</a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="/admin/movies/{{ $movie->id }}/destroy" method="POST" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit"
                                    class="text-red-800 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
