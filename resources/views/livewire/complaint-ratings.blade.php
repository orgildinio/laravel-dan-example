<div class="">
    {{-- {{$comments}} --}}
    @if (count($comments) == 0)    
    <section class="w-full p-6">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col items-center md:flex-row">

                <div class="w-full mt-4">
                    <div class="relative z-10 h-auto p-4 py-10 overflow-hidden bg-white px-7">
                        @auth
                            <div class="w-full space-y-5">
                                <p class="font-medium text-primary uppercase text-center">
                                    Өргөдөл, гомдлын шийдвэрлэлтэд үнэлгээ өгөх
                                </p>
                            </div>
                            @if (session()->has('message'))
                                <p class="text-xl text-gray-600 md:pr-16">
                                    {{ session('message') }}
                                </p>
                            @endif
                            @if($hideForm != true)
                                <form wire:submit.prevent="rate()">
                                    <div class="block px-1 py-2 mx-auto">
                                        <div class="flex space-x-1 rating">
                                            <label for="star1">
                                                <input class="hidden" wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 1 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </label>
                                            <label for="star2">
                                                <input class="hidden" wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 2 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </label>
                                            <label for="star3">
                                                <input class="hidden" wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 3 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </label>
                                            <label for="star4">
                                                <input class="hidden" wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 4 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </label>
                                            <label for="star5">
                                                <input class="hidden" wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 5 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            </label>
                                        </div>
                                        <div class="my-5">
                                            @error('comment')
                                                <p class="mt-1 text-red-500">{{ $message }}</p>
                                            @enderror
                                            <textarea wire:model.lazy="comment" name="description" class="block w-full px-4 py-3 border border-gray-300 bg-slate-100 shadow-inner rounded-lg focus:border-blue-500 focus:outline-none" placeholder="Comment.."></textarea>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="px-3 py-2 font-medium text-white bg-primary rounded-lg">Илгээх</button>
                                        @auth
                                            @if($currentId)
                                                <button type="submit" class="px-3 py-2 mt-4 font-medium text-white bg-red-400 rounded-lg" wire:click.prevent="delete({{ $currentId }})" class="text-sm cursor-pointer">Устгах</button>
                                            @endif
                                        @endauth
                                    </div>
                                </form>
                            @endif
                        @else
                            <div>
                                <div class="mb-8 text-center text-gray-600">
                                    You need to login in order to be able to rate the product!
                                </div>
                                <a href="/register"
                                    class="block px-5 py-2 mx-auto font-medium text-center text-gray-600 bg-white border rounded-lg shadow-sm focus:outline-none hover:bg-gray-100" 
                                >Register</a>
                            </div>
                        @endauth
                    </div>
                </div>
    
            </div>
        </div>
    </section>
    @else
    <section class="relative block p-4 overflow-hidden text-left">
        <div class="w-full mx-auto text-left">
            <h2 class="text-gray-700 uppercase font-bold mb-4">Үнэлгээ</h2>
            <div class="text-indigo-900">
                @foreach ($comments as $comment)
                    <div class="italic">
                        <div class="mb-16 leading-6 text-left">
                            <div class="box-border text-left text-gray-700" style="quotes: auto;">
                                {{  $comment->user?->name }} ({{$comment->created_at->diffForHumans()}})
                            </div>
                            <div class="box-border mb-8 text-lg font-semibold text-gray-500 uppercase">
                                <div class="flex space-x-1 rating">
                                    <label for="star1">
                                        <input class="hidden" wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                                        <svg class="cursor-pointer block w-8 h-8 @if($rating >= 1 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    </label>
                                    <label for="star2">
                                        <input class="hidden" wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                        <svg class="cursor-pointer block w-8 h-8 @if($rating >= 2 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    </label>
                                    <label for="star3">
                                        <input class="hidden" wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                                        <svg class="cursor-pointer block w-8 h-8 @if($rating >= 3 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    </label>
                                    <label for="star4">
                                        <input class="hidden" wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                                        <svg class="cursor-pointer block w-8 h-8 @if($rating >= 4 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    </label>
                                    <label for="star5">
                                        <input class="hidden" wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                                        <svg class="cursor-pointer block w-8 h-8 @if($rating >= 5 ) text-yellow-300 @else text-grey @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="box-border text-md font-medium text-gray-500 bg-gray-100 p-2 rounded-lg">
                                {{ $comment->comment }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
    </section>
    @endif
</div>
