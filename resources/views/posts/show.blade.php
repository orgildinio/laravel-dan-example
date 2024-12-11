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

        <!-- Post Content -->
        <div class="prose prose-lg dark:prose-dark max-w-none">
            {!! $post->content !!}
        </div>

        <!-- Divider -->
        <div class="mt-10 border-t border-gray-300 dark:border-gray-600"></div>

        <!-- Related Posts or Comments Section (Optional) -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Related Posts</h2>
            <!-- Example content (replace with actual dynamic content) -->
            <ul class="mt-4 space-y-3">
                <li>
                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">
                        How to Improve Your Laravel Application Design
                    </a>
                </li>
                <li>
                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">
                        Introduction to Tailwind CSS for Beginners
                    </a>
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>
