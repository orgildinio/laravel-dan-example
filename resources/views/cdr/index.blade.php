<!-- resources/views/cdr/index.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-2 py-4">
        <h1 class="text-2xl font-bold mb-4">Яриа бичлэг</h1>

        <div class="bg-white shadow-md rounded my-2">
            @if (count($cdrRecords) > 0)
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="p-3 text-left">Огноо</th>
                        <th class="p-3 text-left">Src</th>
                        <th class="p-3 text-left">Dst</th>
                        <th class="p-3 text-left">Duration</th>
                        <th class="p-3 text-left">Bill Sec</th>
                        <th class="p-3 text-left">Төлөв</th>
                        {{-- <th class="py-3 px-6 text-left">Linked id</th> --}}
                        <th class="p-3 text-left">Audio</th>
                    </tr>
                </thead>
                
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($cdrRecords as $record)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="p-3 text-left">{{ $record->calldate }}</td>
                            <td class="p-3 text-left">{{ $record->src }}</td>
                            <td class="p-3 text-left">{{ $record->dst }}</td>
                            <td class="p-3 text-left">{{ $record->duration }}</td>
                            <td class="p-3 text-left">{{ $record->billsec }}</td>
                            <td class="p-3 text-left">{{ $record->disposition }}</td>
                            {{-- <td class="py-3 px-6 text-left">{{ $record->linkedid }}</td> --}}
                            <td class="p-3 text-left">
                                <audio controls>
                                    <source src="{{ asset('records/' . $record->record_name) }}.wav" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-2">
                {!! $cdrRecords->links() !!}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
