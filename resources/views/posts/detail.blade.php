<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-10">
        <!-- Centered Post Title -->
        <h1 class="mb-6 text-4xl font-bold leading-tight text-gray-800 dark:text-gray-100 text-center">
            {{ $post->title }}
        </h1>

        <!-- Post Meta Information -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-right">
            <span>Нийтлэгдсэн: {{ $post->created_at->format('Y-m-d') }}</span>
            @if($post->author)
                <span class="ml-2">by <span class="font-medium text-gray-800 dark:text-gray-300">{{ $post->author->name }}</span></span>
            @endif
        </div>

        <!-- Post Image -->
        @if($post->post_image)
            <div class="mb-6 text-center">
                <img src="{{ asset($post->post_image) }}" alt="{{ $post->title }}" class="rounded-lg shadow-md max-w-full h-auto">
            </div>
        @endif

        <!-- Post Content -->
        <div class="prose prose-lg dark:prose-dark max-w-none">
            {!! $post->content !!}
        </div>
    </div>
</x-app-layout>
