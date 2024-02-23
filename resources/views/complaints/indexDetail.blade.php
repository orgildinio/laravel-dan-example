<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        <div class="mb-4">
            <h1 class="text-xl font-bold"> Санал, хүсэлт</h1>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
            <div class="w-full md:w-2/3">
                <form method="GET" autocomplete="off" class="flex items-center">
                    @csrf
                    <div class="mr-3">
                        <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2" placeholder="Хайх" name="search_text" value="{{$search_text}}">
                    </div>
                    <div class="mr-3">
                        <input type="text" id="daterange" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2" placeholder="" name="daterange" value="{{$daterange}}">
                    </div>
                    <button type="submit" class="flex items-center justify-center text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                        Хайх
                    </button>
                </form>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                
                <button type="button" id="export-btn" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    Export
                </button>
            </div>
        </div>
        <div class="overflow-x-auto border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full table-fixed" id="complaint-report">
                <thead>
                    <tr>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            ID</th>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Төрөл</th>
                        {{-- <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Суваг</th> --}}
                        {{-- <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Төлөв</th> --}}
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Төрөл цах/дул</th>
                        <th
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Овог, нэр / ААН</th>
                        {{-- <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Регистр</th> --}}
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Утас</th>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Санал, хүсэлт</th>
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            @switch($status_id)
                                @case('0')
                                    Бүртгэсэн огноо
                                    @break

                                @case('1')
                                    Шилжүүлсэн огноо
                                    @break

                                @case('2')
                                    <p>Хүлээн авсан огноо</p>
                                    @break

                                @case('3')
                                    <p>Хянасан огноо</p>
                                    @break

                                @case('4')
                                    <p>Цуцалсан огноо</p>
                                    @break

                                @case('6')
                                    <p>Шийдвэрлэсэн огноо</p>
                                    @break

                                @default
                                    <p>Бүртгэсэн огноо</p>
                            @endswitch
                        </th>
                        <th
                        class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Холбогдох ТЗЭ</th>
                        @if ($status_id == 1)
                        <th class="p-2 w-[150px] text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Шийдвэрлэлтийн төлөв
                        </th>
                        @endif
                        @if ($status_id != 6)
                        <th
                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Үлдсэн хугацаа</th>
                        @endif
                        <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50"
                            colspan="3">
                            Үйлдэл</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @if (count($complaints) > 0)
                        @foreach ($complaints as $complaint)
                        
                            <tr class="table-row hover:bg-gray-100 cursor-pointer" data-id="{{ $complaint->id }}">
                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        {{++$i}}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->category->name}}
                                    </div>
                                </td>

                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->channel->name}}
                                    </div>
                                </td> --}}

                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->status->name}}
                                    </div>
                                </td> --}}
                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->energyType?->name}}
                                    </div>
                                </td>

                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->complaint_maker_type_id == 1 ? $complaint->lastname . ' ' . $complaint->firstname : $complaint->complaint_maker_org_name}}
                                    </div>
                                </td>

                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->registerNumber}}
                                    </div>
                                </td> --}}

                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->phone}}
                                    </div>
                                </td>

                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->organization->name}}
                                    </div>
                                </td> --}}

                                <td class="p-2 whitespace-no-wrap border-b border-gray-200 text-sm">
                                    <p>{{$complaint->complaint}}</p>
                                </td>

                                <td
                                    class="p-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    <span>{{$complaint->updated_at}}</span>
                                </td>
                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->secondOrg?->name}}
                                    </div>
                                </td>
                                @if ($status_id == 1)
                                <td class="p-2 whitespace-no-wrap border-b border-gray-200 text-sm">
                                    @if ($complaint->second_status_id !== null)
                                    @switch($complaint->second_status_id)
                                        @case('0')
                                            <div class="bg-gray-50 p-1 text-center rounded text-xs">Шинээр ирсэн</div>
                                            @break

                                        @case('2')
                                            <div class="bg-orange-100 text-orange-900 p-1 text-center rounded text-xs">Хүлээн авсан</div>
                                            @break

                                        @case('3')
                                            <div class="bg-blue-100 text-blue-900 p-1 text-center rounded text-xs">Хянаж байгаа</div>
                                            @break

                                        @case('4')
                                            <div class="bg-gray-100 text-gray-900 p-1 text-center rounded text-xs">Цуцалсан</div>
                                            @break

                                        @case('6')
                                            <div class="bg-green-100 text-green-900 p-1 text-center rounded text-xs">Шийдвэрлэсэн</div>
                                            @break

                                        @default
                                            <div>Шинээр ирсэн</div>

                                    @endswitch
                                    @endif
                                </td>
                                
                                @endif

                                @if ($status_id != 6)
                                <td
                                    class="p-2 text-xs leading-5 whitespace-no-wrap border-b border-gray-200">
                                    @if (($complaint->expire_date) > now() )
                                        <span>{{ now()->diffInHours($complaint->expire_date) }} цаг үлдсэн</span>
                                    @else
                                        {{-- <img src="{{ asset('/image/fire-svgrepo-com.svg')}}" class="fa-beat w-[24px] h-[24px] shrink-0 inline-block" alt="dashboard"> --}}
                                        <span class="text-red-500 text-xs">Хугацаа хэтэрсэн</span>
                                    @endif
                                </td>
                                @endif

                                <td
                                    class="p-2 text-xs leading-5 whitespace-no-wrap border-b border-gray-200">
                                    <a href="{{route('complaint.edit', $complaint->id)}}"
                                        class="text-gray-600 hover:text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </td>
                                {{-- <td
                                    class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                    <a href="{{route('complaint.show', $complaint->id)}}"
                                        class="text-gray-600 hover:text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td> --}}
                                <td
                                    class="p-2 text-xs leading-5 whitespace-no-wrap border-b border-gray-200">
                                    <form action="{{ route('complaint.destroy',$complaint->id) }}"
                                        method="Post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-gray-600 hover:text-gray-800" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="w-full text-center mx-auto py-12" colspan="9">
                            <img class="w-32 h-32 mx-auto"
                                src="{{asset('/image/empty.svg')}}"
                                alt="image empty states">                                             
                            <p class="text-gray-500 font-medium text-lg text-center">Мэдээлэл байхгүй байна.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <br>
        {!! $complaints->links() !!}
    </div>
</x-admin-layout>

@push('scripts')

<script>
    $(document).ready(function() {
        // Add click event handler to table rows with class 'table-row'
        $('.table-row').click(function() {
            // Get the value of the 'data-id' attribute of the clicked row
            var id = $(this).data('id');

            $.ajax({
                url: '/updateComplaintStatus/' + id,
                method: 'PUT',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function (error) {
                    console.error(error.responseText);
                }
            });

            window.location.href = '/complaint/' + id;

        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#daterange", {
            mode: "range",
            showMonths: 2,
            dateFormat: "Y-m-d",
        });
    });


    document.getElementById('export-btn').addEventListener('click', function () {
        // Get the HTML table element
        var table = document.getElementById('complaint-report');

        // Convert the HTML table to a worksheet
        var ws = XLSX.utils.table_to_sheet(table);

        // Create a workbook and add the worksheet to it
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        XLSX.writeFile(wb, "Reports.xlsx", { compression: true });

    });
</script>