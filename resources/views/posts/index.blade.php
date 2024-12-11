<x-admin-layout>
    <div class="flex flex-col bg-white p-8">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="mb-4">
                    <a href="{{ route('posts.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Нэмэх</a>
                </div>
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Гарчиг</th>
                                <th scope="col" class="px-6 py-4">Зураг</th>
                                <th scope="col" class="px-6 py-4">Удирдах</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                        {{ $post->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $post->title }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($post->post_image)
                                            <img src="{{ asset($post->post_image) }}" alt="{{ $post->title }}" width="100" height="100">
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <button class="bg-blue-500 text-white py-1 px-2 rounded">
                                            <a href="{{ route('posts.edit' , $post) }}" class="text-white"><i class="fas fa-edit"></i>Засах</a>
                                        </button>
                                        <button class="bg-yellow-500 text-white py-1 px-2 rounded">
                                            <a href="{{ route('postDetail' , $post) }}" class="text-white"><i class="fas fa-eye"></i>Харах</a>
                                        </button>
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="post" class="inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="bg-red-500 text-white py-1 px-2 rounded" type="submit"><i class="fas fa-trash"></i> Устгах</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
