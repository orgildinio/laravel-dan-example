<x-admin-layout>
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10" x-data="serviceAreaForm">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">
            Үйлчлэх хүрээ {{ $organization->name }}
        </h2>

        <form action="{{ route('organization.service-area.store', $organization->id) }}" method="POST">
            @csrf

            <div class="grid grid-cols-3 gap-4">
                <!-- Country Column -->
                <div>
                    <label class="block text-gray-600 text-sm font-medium mb-1">
                        Аймаг/Нийслэл <span class="text-red-500">*</span>
                    </label>
                    <select x-model="countryId" @change="fetchSoums()" name="country_id"
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                        <option value="">Сонгох</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Soum/District Column -->
                <div>
                    <label class="block text-gray-600 text-sm font-medium mb-1">
                        Сум/Дүүрэг
                        <input type="checkbox" @click="toggleAllSoums()" class="ml-2">
                        <span class="text-sm text-gray-500">Бүгдийг сонгох</span>
                    </label>
                    <select x-model="selectedSoums" @change="fetchBags()" multiple
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                        <template x-for="soum in soums" :key="soum.id">
                            <option :value="soum.id" x-text="soum.name"></option>
                        </template>
                    </select>
                    <small class="text-gray-500">Hold Ctrl (Windows) / Cmd (Mac) to select multiple.</small>
                </div>

                <!-- Bag/Khoroo Column -->
                <div>
                    <label class="block text-gray-600 text-sm font-medium mb-1">
                        Баг/Хороо
                        <input type="checkbox" @click="toggleAllBags()" class="ml-2">
                        <span class="text-sm text-gray-500">Бүгдийг сонгох</span>
                    </label>
                    <select x-model="selectedBags" multiple
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300 focus:outline-none">
                        <template x-for="bag in bags" :key="bag.id">
                            <option :value="bag.id" x-text="bag.name"></option>
                        </template>
                    </select>
                    <small class="text-gray-500">Hold Ctrl (Windows) / Cmd (Mac) to select multiple.</small>
                </div>
            </div>

            <!-- Hidden Inputs for Soum/District -->
            <template x-for="soumId in selectedSoums" :key="soumId">
                <input type="hidden" name="soum_district_id[]" :value="soumId">
            </template>

            <!-- Hidden Inputs for Bag/Khoroo -->
            <template x-for="bagId in selectedBags" :key="bagId">
                <input type="hidden" name="bag_khoroo_id[]" :value="bagId">
            </template>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition mt-4">
                Хадгалах
            </button>
        </form>
    </div>

    <!-- Alpine.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('serviceAreaForm', () => ({
                countryId: null,
                soums: [],
                bags: [],
                selectedSoums: [],
                selectedBags: [],

                // Fetch Soums based on Country selection
                fetchSoums() {
                    if (!this.countryId) {
                        this.soums = [];
                        this.bags = [];
                        return;
                    }

                    fetch(`/api/soum_districts?country_id=${this.countryId}`)
                        .then(response => response.json())
                        .then(data => {
                            this.soums = data.soums || [];
                            this.bags = [];
                            this.selectedSoums = [];
                            this.selectedBags = [];
                        })
                        .catch(() => {
                            this.soums = [];
                        });
                },

                // Fetch Bags when Soum selection changes
                fetchBags() {
                    let soumIds = this.selectedSoums.join(',');
                    if (!soumIds) {
                        this.bags = [];
                        return;
                    }

                    fetch(`/api/bag_khoroos?soum_ids=${soumIds}`)
                        .then(response => response.json())
                        .then(data => {
                            this.bags = data.bags || [];
                        })
                        .catch(() => {
                            this.bags = [];
                        });
                },

                // ✅ Toggle all Soums
                toggleAllSoums() {
                    if (this.selectedSoums.length === this.soums.length) {
                        this.selectedSoums = [];
                    } else {
                        this.selectedSoums = this.soums.map(soum => soum.id);
                    }
                    this.fetchBags(); // Update bags when soum changes
                },

                // ✅ Toggle all Bags
                toggleAllBags() {
                    if (this.selectedBags.length === this.bags.length) {
                        this.selectedBags = [];
                    } else {
                        this.selectedBags = this.bags.map(bag => bag.id);
                    }
                }
            }));
        });
    </script>
</x-admin-layout>
