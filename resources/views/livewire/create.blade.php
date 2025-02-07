<div>
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        <div class="bg-white p-8 rounded shadow-lg z-10 w-4/12">
            <h2 class="text-lg font-semibold mb-4 text-gray-500">Удирдах</h2>
            <div class="space-y-4">
                @if (!$isEditMode)
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
                                    <option value="{{ $action }}">{{ $action }}</option>
                                @endforeach
                                {{-- @foreach ($all_status as $status)
                            <option value="{{ $status->id }}">{{ $status->action }}</option>
                            @endforeach --}}
                            </select>
                        </div>
                    </div>
                @endif

                @if ($selectedAction == 'ТЗЭ-рүү шилжүүлэх')
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
                @if ($selectedAction == 'Шилжүүлэх')
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Хэрэглэгч
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <select wire:model="selected_user_id" name="selected_user_id"
                                class="bg-gray-200 appearance-none border-1 border-gray-200 rounded w-full py-2 px-4 text-gray-700 text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                                <option>Сонгох</option>
                                @foreach ($employees as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->division }}
                                    </option>
                                @endforeach
                            </select>
                            @error('selected_user_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif
                @if ($selectedAction == 'Сунгах')
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Сунгах огноо
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            {{-- <input type="text" id="datepicker" wire:model="selected_date" class="bg-gray-200 appearance-none  rounded w-full py-2 px-10 text-gray-700 text-sm leading-tight border-1 border-gray-200" placeholder="Сонгох"> --}}
                            <div x-data x-init="flatpickr($refs.input, {
                                onChange: function(selectedDates, dateStr, instance) {
                                    @this.set('selected_date', dateStr);
                                }
                            })">
                                <input type="text" x-ref="input" wire:model="selected_date"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full">
                            </div>
                        </div>
                    </div>
                @endif

                @if ($selectedAction == 'Шийдвэрлэх' && $complaint_type_id == 1)
                    <div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Хэрэглэгч төлөх дүн
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input type="number" wire:model="amount_pay" class="w-full border rounded p-2">
                            </div>
                        </div>
                        <div class="md:flex md:items-center mb-2">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                    for="inline-full-name">
                                    Хэрэглэгчид буцаах дүн
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input type="number" wire:model="amount_recieve" class="w-full border rounded p-2">
                            </div>
                        </div>
                    </div>
                @endif
                @if (!$isEditMode)
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 text-sm font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-full-name">
                                Файл хавсаргах
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            {{-- <input wire:model="file"
                            class=""
                            id="inline-full-name" type="file" name="file">
                        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror --}}


                            <!-- Multi-file input -->
                            <input type="file" wire:model="files" multiple>

                            <!-- Display error if validation fails -->
                            @error('files.*')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror

                            <!-- Show selected files -->
                            <div class="mt-3">
                                @if ($files)
                                    <ul>
                                        @foreach ($files as $file)
                                            <li>{{ $file->getClientOriginalName() }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <br>
                <div class="mt-4">
                    <label for="content"
                        class="block text-gray-500 text-sm font-bold mb-1 md:mb-0 pr-4">Тайлбар:</label>
                    <textarea id="step_desc" class="w-full border rounded p-2" wire:model="desc"></textarea>
                    @error('desc')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <button type="button" wire:click.prevent="store()"
                    class="bg-slate-800 hover:bg-slate-950 text-white font-semibold py-2 px-4 rounded">
                    Хадгалах
                </button> --}}

                <button type="button" wire:click.prevent="{{ $isEditMode ? 'update' : 'store' }}"
                    class="bg-slate-800 hover:bg-slate-950 text-white font-semibold py-2 px-4 rounded">
                    {{ $isEditMode ? 'Шинэчлэх' : 'Хадгалах' }}
                </button>

                <button type="button" wire:click="closeModal()"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                    Хаах
                </button>
            </div>
        </div>
    </div>
</div>

<script type="module">
    console.log("livewire datepicker...");

    document.addEventListener('input', function(event) {
        if (event.target.tagName.toLowerCase() === 'textarea') {
            event.target.style.height = 'auto';
            event.target.style.height = (event.target.scrollHeight) + 'px';
        }
    }, false);

    document.addEventListener('livewire:update', function() {
        document.querySelectorAll('textarea').forEach(function(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
        });
    });
</script>
