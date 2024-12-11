<x-app-layout>
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Post List -->
            <div class="space-y-6">
                @foreach ($posts as $post)
                <div class="bg-white shadow-sm rounded-lg p-4 hover:bg-gray-100 transition-all duration-200 flex">
                    <!-- Post Image -->
                    <div class="w-1/3 pr-4">
                        <a href="{{ route('postDetail', $post) }}">
                            <img src="{{ asset($post->post_image) }}" alt="{{ $post->title }}" class="w-full h-32 object-cover rounded-lg">
                        </a>
                    </div>

                    <!-- Post Content -->
                    <div class="w-2/3">
                        <div class="text-sm text-primary font-semibold mb-2">{{ $post->created_at->format('Y-m-d') }}</div>

                        <h3 class="text-xl font-semibold text-gray-800 mb-2">
                            <a href="{{ route('postDetail', $post) }}" class="hover:text-primary">{{ \Illuminate\Support\Str::limit($post->title, 40) }}</a>
                        </h3>

                        <p class="text-gray-600 text-base mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                        </p>

                        <div>
                            <a href="{{ route('postDetail', $post) }}" class="text-gray-500 hover:font-bold text-sm">Дэлгэрэнгүй</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
