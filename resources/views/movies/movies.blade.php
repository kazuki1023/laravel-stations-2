@extends('layouts.index')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        タイトル
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
