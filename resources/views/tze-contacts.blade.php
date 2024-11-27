<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full flex justify-between items-center mb-3 mt-8 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">ТЗЭ утасны жагсаалт</h3>
                {{-- <p class="text-slate-500">Overview of the invoices.</p> --}}
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative">
                <div class="relative">
                    <input
                    class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                    placeholder="Хайх утга аа оруулна уу ..."
                    id="searchInput"
                    onkeyup="searchFunc()"
                    />
                    <button
                    class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                    type="button"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    </button>
                </div>
                </div>
            </div>
        </div>
         
        <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
          <table class="w-full text-left table-auto min-w-max" id="contactTable">
            <thead>
              <tr>
                <th class="p-4 border-b border-slate-300 bg-slate-50">
                  <p class="block text-sm font-normal leading-none text-slate-500">
                    №
                  </p>
                </th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">
                  <p class="block text-sm font-normal leading-none text-slate-500">
                    Тусгай зөвшөөрөл эзэмшигч
                  </p>
                </th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">
                  <p class="block text-sm font-normal leading-none text-slate-500">
                    Дуудлагын утас
                  </p>
                </th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">
                  <p class="block text-sm font-normal leading-none text-slate-500">
                    Цахим шуудан 
                  </p>
                </th>
                <th class="p-4 border-b border-slate-300 bg-slate-50">
                  <p class="block text-sm font-normal leading-none text-slate-500">
                    Хаяг
                  </p>
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $index => $contact)
                <tr class="hover:bg-slate-50">
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ $index + 1 }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ $contact['org_name'] ?? 'N/A' }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <p class="text-sm text-slate-500">{{ $contact['phone_number'] ?? 'N/A' }}</p>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5">
                        <a href="mailto:{{ $contact['email'] ?? '#' }}">
                            <span style="text-decoration:underline;color:#0563C1">
                                <p class="text-sm text-slate-500">{{ $contact['email'] ?? 'N/A' }}</p>
                            </span>
                        </a>
                    </td>
                    <td class="p-4 border-b border-slate-200 py-5 break-words whitespace-normal">
                        <p class="text-sm text-slate-500">{{ $contact['address'] ?? 'N/A' }}</p>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
</x-app-layout>

<script>
    function searchFunc() {
        var input, filter, table, tr, td, i, j, txtValue, isMatch;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("contactTable");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            td = tr[i].getElementsByTagName("td");
            isMatch = false;

            // Loop through all columns in the current row
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        isMatch = true;
                        break; // Exit inner loop if match found
                    }
                }
            }

            // Show or hide the row based on match
            tr[i].style.display = isMatch ? "" : "none";
        }
    }
</script>
