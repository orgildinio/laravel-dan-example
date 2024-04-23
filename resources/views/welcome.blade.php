<x-app-layout>
    <div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-hero></x-hero>
            </div>

            <div class="bg-primary text-center flex items-center justify-center h-32">
                <div class="max-w-7xl mx-auto text-white p-2 text-lg sm:text-sm md:text-xl lg:text-2xl xl:text-2xl 2xl:text-3xl">
                    "Тусгай зөвшөөрөл эзэмшигчдийн хооронд болон тусгай зөвшөөрөл эзэмшигч, хэрэглэгчийн хооронд үүссэн маргааныг харьяаллын дагуу шийдвэрлэх"
                </div>
            </div>

            <div class="bg-white mb-10">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <x-welcome />
                </div>
            </div>
            
            <div class="w-full bg-red-500">
                <x-faq></x-faq>
            </div>

            @if (session('first_dan_login'))
                @livewire('update-dan-user')
            @endif

        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        // Check if it's the first Google login (using a session flag)
        var isFirstDanLogin = "{{ session('first_dan_login') }}";

        if (isFirstDanLogin) {
            // $('#registrationModal').modal('show'); // Show the modal
            console.log("First Dan Login");
        }
    });
</script>