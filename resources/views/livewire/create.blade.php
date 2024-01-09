<div>
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        <div class="bg-white p-8 rounded shadow-lg z-10 w-4/12">
            <h2 class="text-lg font-semibold mb-4 text-gray-500">Удирдах</h2>
            
            <div class="space-y-4">
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-full-name">
                            Үйлдэл
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select wire:model="selectedAction" name="selectedAction"
                            class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                            <option>Сонгох</option>
                            @foreach ($actions as $action)
                                <option value="{{$action}}">{{$action}}</option>
                            @endforeach
                            {{-- @foreach ($all_status as $status)
                            <option value="{{ $status->id }}">{{ $status->action }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                @if ($selectedAction == "ТЗЭ-рүү шилжүүлэх")
                <div class="md:flex md:items-center mb-2">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                            for="inline-full-name">
                            Байгууллага
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select wire:model="org_id" name="org_id"
                            class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                            <option>Сонгох</option>
                            @foreach ($orgs as $org)
                            <option value="{{ $org->id }}">{{ $org->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <br>
                <div class="mt-4">
                    <label for="content"
                        class="block text-gray-500 text-sm font-bold mb-1 md:mb-0 pr-4">Тайлбар:</label>
                    <textarea id="desc" class="w-full border rounded p-2" wire:model="desc"></textarea>
                </div>

                <button wire:click="store()"
                    class="bg-slate-800 hover:bg-slate-950 text-white font-semibold py-2 px-4 rounded">
                    Хадгалах
                </button>
                <button wire:click="closeModal"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                    Хаах
                </button>
            </div>
        </div>
    </div>
</div>
