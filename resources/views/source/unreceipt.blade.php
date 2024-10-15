<x-admin-layout>
    <div>
        <div class="container mx-auto">
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

        <div class="py-8 bg-slate-50">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 m-5">
                    <h1 class="text-center text-2xl font-bold text-gray-900 mb-10">11-11 төврүү Өргөдөл, гомдол буцаах</h1>

                    <form id="submitForm" method="POST" action="{{ route('unreceipt', $sourceComplaint->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('GET')
                        
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Өргөдөл, гомдлын утга
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <p class="focus:outline-none p-4 bg-slate-100 shadow-inner rounded text-slate-700 text-justify mt-4">
                                    {{ $sourceComplaint->content }}</p>
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-700 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Тайлбар
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea
                                    class="bg-gray-50 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    name="desc"></textarea>
                                    @error('desc')
                                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                            </div>
                            <div class="md:w-2/3">
                                <x-button id="sbmBtn">Буцаах</x-button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
