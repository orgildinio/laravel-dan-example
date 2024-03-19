<!-- resources/views/cdr/index.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Cdr Records</h1>

        <div class="bg-white shadow-md rounded my-6">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Calldate</th>
                        <th class="py-3 px-6 text-left">Clid</th>
                        <th class="py-3 px-6 text-left">Src</th>
                        <th class="py-3 px-6 text-left">Dst</th>
                        <!-- Add more table headers as needed -->
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($cdrRecords as $record)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $record->calldate }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->clid }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->src }}</td>
                            <td class="py-3 px-6 text-left">{{ $record->dst }}</td>
                            <!-- Add more table cells as needed -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
