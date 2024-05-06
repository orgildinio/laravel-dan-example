<x-admin-layout>

    @if (Auth::user()->org_id == 99)
        <div x-data="{ activeTab: 1 }">
            <div class="sm:hidden">
                <select x-model="activeTab" id="tabs"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="1">Эрчим хүчний зохицуулах хороо</option>
                    <option value="2">Тусгай зөвшөөрөл эзэмшигчид</option>
                    <option value="3">Эрчим хүчний салбарын хэмжээнд</option>
                </select>
            </div>
            <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex">
                <li class="w-full focus-within:z-10">
                    <a href="#"
                        class="inline-block w-full p-4 border-r border-gray-200  rounded-s-lg hover:text-gray-900 hover:bg-gray-50"
                        @click="activeTab = 1" :class="activeTab === 1 ? 'bg-gray-100 text-gray-900' : 'bg-white text-gray-500'">Эрчим
                        хүчний зохицуулах хороо</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="#"
                        class="inline-block w-full p-4 border-r border-gray-200 hover:text-gray-900 hover:bg-gray-50" @click="activeTab = 2" :class="activeTab === 2 ? 'bg-gray-100 text-gray-900' : 'bg-white text-gray-500'">Тусгай
                        зөвшөөрөл эзэмшигчид</a>
                </li>
                <li class="w-full focus-within:z-10">
                    <a href="#"
                        class="inline-block w-full p-4 border-s-0 border-gray-200 rounded-e-lg hover:text-gray-900 hover:bg-gray-50" @click="activeTab = 3" :class="activeTab === 3 ? 'bg-gray-100 text-gray-900' : 'bg-white text-gray-500'">Эрчим
                        хүчний салбарын хэмжээнд</a>
                </li>
            </ul>
            <div x-show="activeTab == 1">
                <x-dashboard-ehzh></x-dashboard-ehzh>
            </div>
            <div x-show="activeTab == 2">
                <x-dashboard-tze></x-dashboard-tze>
            </div>
            <div x-show="activeTab == 3">
                <x-dashboard-ehs></x-dashboard-ehs>
            </div>
        </div>
    @else
        <div>
            <x-dashboard-tze-show></x-dashboard-tze-show>
        </div>
    @endif

</x-admin-layout>

@push('scripts')
