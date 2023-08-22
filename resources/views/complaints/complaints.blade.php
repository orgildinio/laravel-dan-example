<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Санал хүсэлт') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div aria-label="group of cards" tabindex="0" class="focus:outline-none w-full">
                @foreach ($complaints as $complaint)
                <div class="lg:flex items-center justify-center w-full mt-7">
                    <div tabindex="0" aria-label="card 1"
                        class="focus:outline-none lg:w-full lg:mr-7 lg:mb-0 mb-7 bg-white  p-6 shadow rounded">
                        <div class="flex items-center border-b border-gray-200  pb-6">

                            <livewire:channel-icon :category="$complaint->category->name"
                                :channel="$complaint->channel->name" />

                            <div class="flex items-start justify-between w-full">
                                <div class="pl-3 w-full">
                                    <p tabindex="0"
                                        class="focus:outline-none text-xl font-medium leading-5 text-gray-800 ">
                                        {{$complaint->category->name}} - №{{$complaint->id}}</p>
                                    <p tabindex="0"
                                        class="focus:outline-none text-sm leading-normal pt-2 text-gray-500">
                                        {{$complaint->created_at}}</p>
                                </div>
                                <div role="img" aria-label="bookmark">
                                    <svg class="focus:outline-none text-gray-800" width="28" height="28"
                                        viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.5001 4.66667H17.5001C18.1189 4.66667 18.7124 4.9125 19.15 5.35009C19.5876 5.78767 19.8334 6.38117 19.8334 7V23.3333L14.0001 19.8333L8.16675 23.3333V7C8.16675 6.38117 8.41258 5.78767 8.85017 5.35009C9.28775 4.9125 9.88124 4.66667 10.5001 4.66667Z"
                                            stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="px-2">
                            <h6 class="text-sm font-bold text-gray pt-4">Гомдол мэдүүлсэн:
                                {{mb_substr($complaint->lastname, 0, 1)}}.{{$complaint->firstname}}</h6>
                            <p tabindex="0"
                                class="focus:outline-none text-sm leading-5 py-4 text-gray-600 text-justify">
                                {{$complaint->complaint}}</p>
                            <div tabindex="0" class="focus:outline-none flex">
                                <div class="py-2 px-4 text-xs leading-3 text-orange-700 rounded-full bg-orange-100">
                                    {{$complaint->status ? $complaint->status->name : 'Хүлээж авсан'}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>