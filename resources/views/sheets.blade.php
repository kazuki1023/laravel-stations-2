@extends('layouts.index')

@section('content')
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead>
            <h4 class="w-full m-auto text-center px-2 text-sm">スクリーン</h4>
          </thead>
            <tbody>
                @foreach ($groupedSheets as $rowName => $rowSheets)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th class="px-6 py-4">
                            {{ $rowName }}行
                        </th>
                        @foreach ($rowSheets as $sheet)
                            <td class="px-6 py-4">
                                <a href="">
                                    {{ $sheet->row }}-{{ $sheet->column }}
                                </a>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
