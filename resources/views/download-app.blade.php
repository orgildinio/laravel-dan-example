<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 mt-16 flex flex-col lg:flex-row items-center justify-between">
        <!-- QR Code Section -->
        <div class="relative lg:w-1/2">
            <!-- Phone Image -->
            <img src="{{ asset('images/qr-phone.jpg') }}" alt="Phone Scanning QR" class="w-3/4"> 
        </div>

        <!-- Text Section -->
        <div class="lg:w-1/2 mb-8 lg:mb-0">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Гар утасны апп татах</h1>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                Гар утсандаа тохирсон хувилбарыг татаж авахын тулд доорх QR кодоос сонгож уншуулна уу.
            </p>
            <!-- QR Codes -->
            <div class="flex gap-4">
                <div class="text-center mr-4">
                    {{ $iosQrCode }}
                    <p class="text-gray-600 mt-2 font-bold">Download for IOS</p>
                </div>
                <div class="text-center">
                    {{ $androidQrCode }}
                    <p class="text-gray-600 mt-2 font-bold">Download for Android</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
