<!-- resources/views/cdr/index.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Яриа бичлэг</h1>

        <div class="bg-white shadow-md rounded my-6">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Calldate</th>
                        <th class="py-3 px-6 text-left">Src</th>
                        <th class="py-3 px-6 text-left">Dst</th>
                        <th class="py-3 px-6 text-left">Duration</th>
                        <th class="py-3 px-6 text-left">Bill Sec</th>
                        <th class="py-3 px-6 text-left">Disposition</th>
                        <th class="py-3 px-6 text-left">Linked id</th>
                        <th class="py-3 px-6 text-left">Audio</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($cdrRecords as $record)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $record->calldate }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->src }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->dst }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->duration }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->billsec }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->disposition }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->linkedid }}</td>
                            <td class="py-3 px-6 text-left">
                                <audio controls>
                                    <source src="{{ asset('records/' . $record->linkedid) }}.wav" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
