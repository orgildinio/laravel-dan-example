<x-app-layout>
    <div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-hero></x-hero>
            </div>
            <div class="flex items-center justify-center bg-primary h-32 w-full">
                <div class="max-w-7xl mx-auto">
                    <p class="text-white text-center italic text-3xl">"Тусгай зөвшөөрөл эзэмшигчдийн хооронд болон тусгай зөвшөөрөл эзэмшигч хэрэглэгч хооронд үүссэн маргааныг харьяаллын дагуу шийдвэрлэх"</p>
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