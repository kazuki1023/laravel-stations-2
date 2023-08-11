@extends('layouts.Adminindex')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        項目名
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        内容
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        id
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                        {{ $movie->id }}
                    </th>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        タイトル
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                        {{ $movie->title }}
                    </th>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        画像URL
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                        <img src="{{ $movie->image_url }}" alt="">
                    </th>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        詳細
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                        {{ $movie->description }}
                    </th>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        公開年
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                        {{ $movie->published_year }}
                    </th>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        上映時間
                    </th>
                    @foreach($movie->schedules as $schedule)
                    <th scope="row"
                        class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                        {{ $schedule->start_time->format('H:i') }}~{{ $schedule->end_time->format('H:i') }}
                    </th>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection
