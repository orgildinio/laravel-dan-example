<style>
   .post-image {
      height: 200px; /* Set a fixed height */
      width: 100%; /* Make the width responsive */
      object-fit: cover; /* Ensure the image fills the space while maintaining its aspect ratio */
      border-radius: 8px; /* Optional: Keep rounded corners */
   }
   .post-image:hover {
      transform: scale(1.05); /* Slightly enlarge the image */
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
   }
</style>
<section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
   <div class="container">
      <div class="flex flex-wrap justify-center -mx-4">
         <div class="w-full px-4">
            <div class="text-center mx-auto mb-[60px] lg:mb-20 max-w-[510px]">
               </span>
               <h2
                  class="
                  font-bold
                  text-3xl
                  sm:text-3xl
                  md:text-[40px]
                  text-dark
                  mb-4
                  "
                  >
                  Мэдээ, мэдээлэл
               </h2>
            </div>
         </div>
      </div>
      <div class="flex flex-wrap -mx-4">
         @foreach ($posts as $post)   
         <div class="w-full md:w-1/2 lg:w-1/3 px-4">
            <div class="max-w-[370px] mx-auto mb-10">
               <div class="rounded overflow-hidden mb-8">
                  <a href="{{ route('postDetail', $post) }}">
                     <img src="{{ asset($post->post_image) }}" alt="{{ $post->title }}" class="w-full post-image" >
                  </a>
               </div>
               <div>
                  <span
                     class="
                     bg-primary
                     rounded
                     inline-block
                     text-center
                     py-1
                     px-4
                     text-xs
                     leading-loose
                     font-semibold
                     text-white
                     mb-5
                     "
                     >
                  {{ $post->created_at->format('Y-m-d') }}
                  </span>
                  <h3>
                     <a
                        href="{{ route('postDetail', $post) }}"
                        class="
                        font-semibold
                        text-xl
                        mb-4
                        inline-block
                        text-dark
                        hover:text-primary
                        "
                        >
                        {{ \Illuminate\Support\Str::limit($post->title, 60) }}
                     </a>
                  </h3>
                  <p class="text-base text-body-color">
                     {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 80) }}
                  </p>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>