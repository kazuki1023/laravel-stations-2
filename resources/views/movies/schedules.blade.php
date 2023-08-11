@extends('layouts.adminIndex')

@section('content')
    {{-- 削除成功のflashメッセージを表示させる --}}
    @if (session('delete_success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Success!</span> {{ session('delete_success') }}
        </div>
    @endif
    <div class="mb-4 flex justify-center ">
        {{ $movies->links('vendor.pagination.tailwind') }}
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        作品ID：タイトル
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        上映スケジュール
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                        新規作成
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            {{ $movie->id }} : {{ $movie->title }}
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                            @foreach ($movie->schedules as $schedule)
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 inline-block mb-2"><a
                                        href="/admin/schedules/{{ $schedule->id }}">{{ $schedule->start_time->format('Y-m-d H:i') }}~{{ $schedule->end_time->format('Y-m-d H:i') }}</a>
                                </span>
                            @endforeach
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 flex-wrap w-10">
                            <a href="./movies/{{$movie->id}}/schedules/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-thin rounded-lg text-sm px-5 py-2.5  mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 inline-block">作成</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
