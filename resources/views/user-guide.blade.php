<style>
    .pdf-container {
        width: 100%;
        height: 100vh;
        border: none;
    }
</style>
<x-app-layout>
    <div>
        <div>
            <div class="bg-white mb-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="container">
                        <iframe src="{{ asset('image/USERguide20240621.pdf') }}" class="pdf-container"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>