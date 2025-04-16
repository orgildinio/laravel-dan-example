<x-admin-layout>
    <div class="w-full mx-auto px-4 py-6" x-data="{ tab: 'info' }">
        <h2 class="text-2xl font-semibold mb-4">{{ $organization->name }}</h2>

        <!-- Tab Buttons -->
        <div class="flex space-x-4 border-b mb-4">
            <button @click="tab = 'info'"
                :class="tab === 'info' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
                class="py-2 px-4 font-medium focus:outline-none">
                Мэдээлэл
            </button>
            <button @click="tab = 'orgNumbers'"
                :class="tab === 'orgNumbers' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
                class="py-2 px-4 font-medium focus:outline-none">
                Тусгай дугаар
            </button>
            <button @click="tab = 'serviceAreas'"
                :class="tab === 'serviceAreas' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-600'"
                class="py-2 px-4 font-medium focus:outline-none">
                Үйлчлэх хүрээ
            </button>
        </div>

        <!-- Tab Content -->
        <div>
            <!-- Info Tab -->
            <div x-show="tab === 'info'" x-transition>
                <div class="bg-white shadow rounded-xl p-6 space-y-4 text-gray-800 border">
                    <div>
                        <p class="text-lg font-semibold">Нэр:</p>
                        <p class="ml-2 text-gray-700">{{ $organization->name }}</p>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Энергийн төрөл:</p>
                        <p class="ml-2 text-gray-700">
                            {{ $organization->plant_id == 1 ? 'Цахилгаан' : 'Дулаан' }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-4 flex gap-4">
                        <a href="{{ route('organization.edit', $organization->id) }}"
                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition duration-200">
                            ✏️ Засах
                        </a>

                        <form action="{{ route('organization.destroy', $organization->id) }}" method="POST"
                            onsubmit="return confirm('Та устгахдаа итгэлтэй байна уу?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-md transition duration-200">
                                🗑️ Устгах
                            </button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Organization Numbers -->
            <div x-show="tab === 'orgNumbers'" x-transition class="mt-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Байгууллагын утасны дугаар</h3>
                    <a href="{{ route('orgNumber.create', ['organization_id' => $organization->id]) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow-sm">
                        + Нэмэх
                    </a>
                </div>
                <div x-data="{
                    showModal: false,
                    forwardNumber: '',
                    selectedNumberId: null,
                    toastMessage: '',
                    showToast: false,
                    showSuccess(message) {
                        this.toastMessage = message;
                        this.showToast = true;
                        setTimeout(() => this.showToast = false, 3000);
                    },
                    saveForwardedNumber() {
                        axios.post('/org-number/forward', {
                            id: this.selectedNumberId,
                            forwarded_number: this.forwardNumber
                        }).then(response => {
                            this.showSuccess(response.data.message);
                            this.showModal = false;
                            this.forwardNumber = '';
                            this.selectedNumberId = null;
                            setTimeout(() => window.location.reload(), 3000);
                        }).catch(error => {
                            console.error('Алдаа гарлаа:', error);
                        });
                    }
                }">
                    @if ($organization->orgNumbers->count())
                        <ul class="space-y-3">
                            @foreach ($organization->orgNumbers as $number)
                                <li
                                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                    <div class="mb-2 sm:mb-0">
                                        <p class="text-base text-gray-800 font-medium">
                                            {{ $number->phone_number ?? 'No number' }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Шилжүүлсэн:
                                            <span class="font-semibold">{{ $number->forwarded_number ?? '—' }}</span>
                                        </p>
                                    </div>

                                    <div class="flex gap-2">
                                        {{-- Хэрвээ шилжүүлсэн дугаар байхгүй бол "Дуудлага шилжүүлэх" товч харуулах --}}
                                        @if (!$number->forwarded_number)
                                            <button @click="showModal = true; selectedNumberId = {{ $number->id }}"
                                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                                Дуудлага шилжүүлэх
                                            </button>
                                        @endif

                                        {{-- Хэрвээ шилжүүлсэн дугаар байгаа бол "Цуцлах" товч харуулах --}}
                                        @if ($number->forwarded_number)
                                            <form method="POST"
                                                action="{{ route('orgNumber.clearForwarded', $number->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                                    Цуцлах
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div
                            class="text-gray-500 bg-gray-50 border border-dashed border-gray-300 p-4 rounded-md text-center">
                            Утасны дугаар бүртгэгдээгүй байна.
                        </div>
                    @endif

                    <!-- Modal -->
                    <div x-show="showModal"
                        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-transition>
                        <div class="bg-white p-6 rounded-md shadow-lg w-full max-w-md">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800">Гар утасны дугаар оруулна уу</h2>
                            <input type="text" x-model="forwardNumber" placeholder="Шилжүүлэх утасны дугаар"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4 focus:outline-none focus:ring focus:ring-blue-300">

                            <div class="flex justify-end space-x-2">
                                <button @click="showModal = false"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                    Болих
                                </button>
                                <button @click="saveForwardedNumber(); showModal = false"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                    Шилжүүлэх
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Toast Notification -->
                    <div x-show="showToast" x-transition
                        class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-md shadow-md z-50">
                        <span x-text="toastMessage"></span>
                    </div>
                    @if (session('success'))
                        <script>
                            document.addEventListener('alpine:init', () => {
                                Alpine.store('notification', {
                                    message: @json(session('success')),
                                    visible: true
                                })
                            });
                        </script>
                    @endif
                </div>
            </div>


            <!-- Service Areas -->
            <div x-show="tab === 'serviceAreas'" x-transition>
                <a href="{{ route('organization.service-area.create', $organization->id) }}"
                    class="px-4 py-2 mb-4 rounded-md bg-blue-500 text-white hover:bg-blue-600 transition duration-200">Нэмэх</a>
                @if ($organization->serviceAreas->count())
                    <table class="w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600">
                                <th class="border p-3">#</th>
                                <th class="border p-3">Аймаг</th>
                                <th class="border p-3">Сум/Дүүрэг</th>
                                <th class="border p-3">Баг/Хороо</th>
                                <th class="border p-3">Үйлдэл</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organization->serviceAreas as $index => $serviceArea)
                                <tr class="border">
                                    <td class="border p-3 text-center">{{ $index + 1 }}</td>
                                    <td class="border p-3">{{ $serviceArea->country->name ?? '-' }}</td>
                                    <td class="border p-3">{{ $serviceArea->soumDistrict->name ?? '-' }}</td>
                                    <td class="border p-3">{{ $serviceArea->bagKhoroo->name ?? '-' }}</td>
                                    <td class="border p-3 text-center">
                                        <form action="{{ route('organizationServiceArea.destroy', $serviceArea->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
