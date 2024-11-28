<x-app-layout>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
      <div class="flex" x-data="tabsAndSearch()">
          <!-- Sidebar -->
          <div class="w-1/4 p-4 bg-slate-100 rounded-md shadow-md">
              <ul class="space-y-3">
                  <li>
                      <button
                          class="w-full text-left py-2 px-4 bg-slate-200 rounded text-slate-700 hover:bg-slate-300 focus:outline-none focus:ring"
                          @click="activeTab = 'tab1'"
                          :class="{ 'bg-slate-300': activeTab === 'tab1' }"
                      >
                          Дулаан ТЗЭ жагсаалт
                      </button>
                  </li>
                  <li>
                      <button
                          class="w-full text-left py-2 px-4 bg-slate-200 rounded text-slate-700 hover:bg-slate-300 focus:outline-none focus:ring"
                          @click="activeTab = 'tab2'"
                          :class="{ 'bg-slate-300': activeTab === 'tab2' }"
                      >
                          Цахилгаан ТЗЭ жагсаалт
                      </button>
                  </li>
              </ul>
          </div>

          <!-- Main Content -->
          <div class="w-3/4 p-4 bg-white rounded-md shadow-md ml-4">
              <!-- Tab 1 -->
              <div x-show="activeTab === 'tab1'" class="tab-content">
                  <h3 class="text-lg font-semibold text-slate-800 mb-4">Дулаан ТЗЭ утасны жагсаалт</h3>
                  <div class="relative overflow-x-auto">
                      <div class="mb-4">
                          <input
                              type="text"
                              placeholder="Дулааны ТЗЭ-с хайх"
                              class="w-full p-2 border rounded-md"
                              x-model="search.tab1"
                          >
                      </div>
                      <table class="w-full text-left text-sm table-auto min-w-max">
                          <thead>
                              <tr>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">№</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Тусгай зөвшөөрөл эзэмшигч</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Дуудлагын утас</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Цахим шуудан</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Хаяг</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($contactsDulaan as $index => $dulaan)
                                  <tr class="hover:bg-slate-50" 
                                      x-show="['{{ $dulaan['org_name'] }}', '{{ $dulaan['phone_number'] }}', '{{ $dulaan['email'] }}', '{{ $dulaan['address'] }}']
                                      .some(field => field.toLowerCase().includes(search.tab1.toLowerCase()))"
                                  >
                                      <td class="p-4 border-b border-slate-200">{{ $index + 1 }}</td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $dulaan['org_name'] ?? 'N/A' }}', search.tab1)"></td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $dulaan['phone_number'] ?? 'N/A' }}', search.tab1)"></td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $dulaan['email'] ?? 'N/A' }}', search.tab1)"></td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $dulaan['address'] ?? 'N/A' }}', search.tab1)"></td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>

              <!-- Tab 2 -->
              <div x-show="activeTab === 'tab2'" class="tab-content">
                  <h3 class="text-lg font-semibold text-slate-800 mb-4">Цахилгаан ТЗЭ утасны жагсаалт</h3>
                  <div class="relative overflow-x-auto">
                      <div class="mb-4">
                          <input
                              type="text"
                              placeholder="Цахилгааны ТЗЭ-с хайх"
                              class="w-full p-2 border rounded-md"
                              x-model="search.tab2"
                          >
                      </div>
                      <table class="w-full text-left text-sm table-auto min-w-max">
                          <thead>
                              <tr>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">№</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Тусгай зөвшөөрөл эзэмшигч</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Дуудлагын утас</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Цахим шуудан</th>
                                  <th class="p-4 border-b border-slate-300 bg-slate-50">Хаяг</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($contactsTog as $index => $tog)
                                  <tr class="hover:bg-slate-50" 
                                      x-show="['{{ $tog['org_name'] }}', '{{ $tog['phone_number'] }}', '{{ $tog['email'] }}', '{{ $tog['address'] }}']
                                      .some(field => field.toLowerCase().includes(search.tab2.toLowerCase()))"
                                  >
                                      <td class="p-4 border-b border-slate-200">{{ $index + 1 }}</td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $tog['org_name'] ?? 'N/A' }}', search.tab2)"></td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $tog['phone_number'] ?? 'N/A' }}', search.tab2)"></td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $tog['email'] ?? 'N/A' }}', search.tab2)"></td>
                                      <td class="p-4 border-b border-slate-200" x-html="highlightMatch('{{ $tog['address'] ?? 'N/A' }}', search.tab2)"></td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

<script>
  function tabsAndSearch() {
      return {
          activeTab: 'tab1',
          search: { tab1: '', tab2: '' },
          highlightMatch(text, searchTerm) {
              if (!searchTerm) return text;
              const regex = new RegExp(`(${searchTerm})`, 'gi');
              return text.replace(regex, '<span class="bg-yellow-200">$1</span>');
          },
      };
  }
</script>
