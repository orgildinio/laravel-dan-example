<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        @if (count($complaints) > 0)
            @foreach ($complaints as $complaint)
                <div class="mx-auto border border-gray-200 rounded-lg text-gray-700 mb-0.5 h-30 complaint-show cursor-pointer hover:bg-gray-100"
                    data-id="">
                    <div class="flex p-3 border-l-4 border-red-500 rounded-lg">
                        <div class="space-y-1 border-r-2 pr-3">
                            <div class="text-xs leading-5 font-semibold"><span
                                    class="text-xs leading-4 font-normal text-gray-500"> №</span>
                                {{ $complaint['number'] }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500 pr">
                                    Төрөл: </span> {{ $complaint['type'] }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500">
                                    Шинээр ирсэн: </span>{{ $complaint['created_at'] }}</div>
                        </div>
                        <div class="flex-1">
                            <div class="ml-3 space-y-1 border-r-2 pr-3">
                                <div class="text-sm leading-4 font-semibold">
                                    {{ $complaint['fullname'] }}
                                    <span
                                        class="text-xs leading-4 font-normal text-gray-500">Иргэн</span>
                                </div>
                                <div class="text-sm leading-4 font-normal">
                                    {{ Str::limit($complaint['content'], 200) }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ml-3 my-5 bg-red-500 p-1 w-20">
                                <div class="uppercase text-xs leading-4 font-semibold text-center text-white">
                                    {{ $complaint['type']}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $complaints->links() !!}
        @else
            <div class="text-gray-500">
                <img class="w-32 h-32 mx-auto" src="{{ asset('/image/empty.svg') }}" alt="image empty states">
                <p class="text-gray-500 font-medium text-lg text-center">Мэдээлэл байхгүй байна.</p>
            </div>
        @endif
        <br>
    </div>
</x-admin-layout>
