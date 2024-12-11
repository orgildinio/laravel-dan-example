<x-app-layout>
    <div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-hero></x-hero>
            </div>

            <div class="bg-primary text-center flex items-center justify-center h-32">
                <div
                    class="max-w-7xl mx-auto text-white p-2 text-lg sm:text-sm md:text-xl lg:text-2xl xl:text-2xl 2xl:text-3xl">
                    "Тусгай зөвшөөрөл эзэмшигчдийн хооронд болон тусгай зөвшөөрөл эзэмшигч, хэрэглэгчийн хооронд үүссэн
                    маргааныг харьяаллын дагуу шийдвэрлэх"
                </div>
            </div>

            <div class="bg-white mb-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <x-welcome />
                </div>
            </div>
            <div class="bg-gray-50 mb-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <x-post-home-page></x-post-home-page>
                </div>
            </div>


            <div class="w-full my-16">
                <x-faq></x-faq>
            </div>

            <!-- Notification Popup -->
            <div x-data="{ open: true }" x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl mx-4 text-center relative">
                    <!-- Close Icon in the Top Right Corner -->
                    <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                        <!-- SVG icon for the "X" close button -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
            
                    <h2 class="text-2xl font-semibold mb-4">Санал асуулга</h2>
                    <p class="text-gray-700 mb-6">
                        Эрчим хүчээр хангагч байгууллагын үйл ажиллагаа, бүтээгдэхүүн, үйлчилгээний чанар, хүртээмжийн өнөөгийн байдал, хэрэглэгчийн хэрэгцээ, шаардлагыг тодорхойлох, хангагч байгууллагын үйлчилгээг сайжруулах зорилгоор энэхүү сэтгэл ханамжийн судалгааг авч байна.
                    </p>
            
                    <!-- Styled Links -->
                    <div class="text-left mb-6">
                        <p class="text-lg font-semibold text-gray-800 mb-2">Дулаан хангамж</p>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSc48605p-O1Ap6XUwDK3ojTXYHdL9blY46t-7SsHp5uxQzJug/viewform?vc=0&c=0&w=1&flr=0"
                            class="text-blue-600 underline hover:text-blue-800 transition">
                            Дулаан хангамжтай холбоотой санал, асуулга (google.com)
                        </a>
                    </div>
            
                    <div class="text-left">
                        <p class="text-lg font-semibold text-gray-800 mb-2">Цахилгаан хангамж</p>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSexAhe3lA9Gzbs71dd05yEfrFJ7lguZ__lHkLGDi2iaYg6PDg/viewform?vc=0&c=0&w=1&flr=0"
                            class="text-blue-600 underline hover:text-blue-800 transition">
                            Цахилгаан хангамжтай холбоотой санал, асуулга (google.com)
                        </a>
                    </div>
            
                    <!-- Close Button -->
                    <button @click="open = false" class="bg-primary text-white px-4 py-2 rounded mt-6 hover:bg-primaryHover transition">
                        Хаах
                    </button>
                </div>
            </div>
            




            @if (session('first_dan_login'))
                @livewire('update-dan-user')
            @endif

        </div>
    </div>
</x-app-layout>

<script type="module">
    $(document).ready(function() {
        // Check if it's the first Google login (using a session flag)
        var isFirstDanLogin = "{{ session('first_dan_login') }}";

        if (isFirstDanLogin) {
            // $('#registrationModal').modal('show'); // Show the modal
            console.log("First Dan Login: ", isFirstDanLogin);
        }
    });
</script>
