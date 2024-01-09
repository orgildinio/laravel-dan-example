<x-app-layout>
    <div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-hero></x-hero>
            </div>
            <div class="bg-primary text-center flex items-center justify-center h-32">
                <div class="max-w-7xl mx-auto text-white p-2 text-lg sm:text-sm md:text-xl lg:text-2xl xl:text-2xl 2xl:text-3xl">
                    <!-- Content with responsive text size -->
                    "Тусгай зөвшөөрөл эзэмшигчдийн хооронд болон тусгай зөвшөөрөл эзэмшигч, хэрэглэгчийн хооронд үүссэн маргааныг харьяаллын дагуу шийдвэрлэх"
                </div>
            </div>
            <div class="bg-white">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <x-welcome />
                </div>
            </div>
            
            {{-- <x-home-static-data></x-home-static-data> --}}
            <div class="w-full">
                <x-faq></x-faq>
            </div>
        </div>
    </div>
</x-app-layout>