@extends('layouts.index')

@section('content')
    {{-- 削除成功のflashメッセージを表示させる --}}
    @if (session('delete_success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Success!</span> {{ session('delete_success') }}
        </div>
    @endif
    <form action="" method="get" class="">
        <div class="mb-4 flex justify-center ">
            {{ $movies->appends(request()->query())->links('vendor.pagination.tailwind')  }}
        </div>
        <p class="flex justify-center py-2 font-medium text-gray-900">検索フォーム</p>
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." name="keyword">
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
        <div class="flex my-4 justify-center">
            <div class="flex items-center mr-4">
                <p class="font-medium text-gray-900">上映状況</p>
            </div>
            <div class="flex items-center mr-4">
                <input  id="inline-checked-radio" type="radio" value=2 name="is_showing" checked
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required="required">
                <label for="inline-checked-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">全て</label>
            </div>
            <div class="flex items-center mr-4">
                <input id="inline-radio" type="radio" value=0 name="is_showing" 
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">公開予定</label>
            </div>
            <div class="flex items-center mr-4">
                <input id="inline-2-radio" type="radio" value=1 name="is_showing" 
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">公開中</label>
            </div>
        </div>
    </form>
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
