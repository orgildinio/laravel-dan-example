<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-1">
        <div class="flex items-center justify-between mb-4">
            <div class="container max-w-7xl mx-auto mt-8">
                <div class="mb-4">
                    <h1 class="text-xl font-bold"> Санал, хүсэлт</h1>
                    {{-- <div class="flex justify-end">
                        <a href="{{ route('complaint.create') }}"
                            class="px-4 py-2 rounded-md bg-black text-sky-100 hover:bg-gray-600">Нэмэх</a>
                    </div> --}}
                </div>
                @if ($message = Session::get('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div
                            class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full">
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
                                            Овог, нэр</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Регистр</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Утас</th>
                                        {{-- <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Байгууллага</th> --}}
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Санал, хүсэлт</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Бүртгэсэн огноо</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Үлдсэн хугацаа</th>
                                        {{-- <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50"
                                            colspan="3">
                                            Үйлдэл</th> --}}
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
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->lastname}} {{$complaint->firstname}}
                                                    </div>
                                                </td>
    
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->registerNumber}}
                                                    </div>
                                                </td>
    
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
                                                    <span>{{$complaint->complaint_date}} | {{now()}}</span>
                                                </td>
                                                <td
                                                    class="p-2 text-sm leading-5 text-orange-500 whitespace-no-wrap border-b border-gray-200">
                                                    <span>{{ 48 - now()->diffInHours($complaint->complaint_date) > 0 ? 48 - now()->diffInHours($complaint->complaint_date) . " цаг үлдсэн" : "Хугацаа хэтэрсэн" }}</span>
                                                </td>
    
                                                {{-- <td
                                                    class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                                    <a href="{{route('complaint.edit', $complaint->id)}}"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                </td> --}}
                                                {{-- <td
                                                    class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                                    <a href="{{route('complaint.show', $complaint->id)}}"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </td> --}}
                                                {{-- <td
                                                    class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                                    <form action="{{ route('complaint.destroy',$complaint->id) }}"
                                                        method="Post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="w-6 h-6 text-red-600 hover:text-red-800" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg></button>
                                                    </form>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-full text-center mx-auto py-12" colspan="5">
                                            <img class="w-32 h-32 mx-auto"
                                                src="{{asset('/image/empty.svg')}}"
                                                alt="image empty states">                                             
                                            <p class="text-gray-700 font-medium text-lg text-center">Мэдээлэл байхгүй байна.</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        {!! $complaints->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

@push('scripts')

<script>
    $(document).ready(function() {
        // Add click event handler to table rows with class 'table-row'
        $('.table-row').click(function() {
            // Get the value of the 'data-id' attribute of the clicked row
            var id = $(this).data('id');

            window.location.href = '/complaint/' + id;

            // Make an AJAX request to fetch details based on the ID
            // $.ajax({
            //     url: '/complaint/' + id,
            //     type: 'GET',
            //     success: function(data) {
            //         console.log("success")
            //         // Load the 'show.blade.php' view with the fetched data
            //         // window.location=data.url;
            //         window.location.href = '/complaint/' + id;
            //         $('#detailContainer').html(data);
            //     },
            //     error: function(error) {
            //         console.log(error);
            //     }
            // });
        });
    });
</script>