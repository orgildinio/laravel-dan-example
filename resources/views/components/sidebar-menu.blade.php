<aside id="sidebar"
   class="fixed hidden z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
   aria-label="Sidebar">
   <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
      <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
         <div class="flex-1 px-3 bg-white divide-y space-y-1">
            <ul class="space-y-2 pb-2">
               <li>
                  <div class="flex items-start justify-start p-2">
                     <div class="flex items-center mr-5">
                        <div class="mr-3">
                           <div class="inline-block relative shrink-0 cursor-pointer rounded-[.95rem]">
                           <img class="w-[40px] h-[40px] shrink-0 inline-block rounded-[.95rem]" src="{{ asset('/image/user-profile-icon.svg')}}" alt="avatar image">
                           </div>
                        </div>
                        <div>
                           <p class="text-secondary-dark font-medium text-sm">{{ Auth::user()->name }}</p>
                           <p class="text-secondary-dark font-medium text-sm">{{ Auth::user()->division }}</p>
                        </div>
                     </div>
                  </div>
                  <div class="text-secondary-dark font-medium text-sm p-2">{{ Auth::user()->org?->name }}</div>
                 <div class="hidden border-b border-solid lg:block border-neutral-200"></div>
               </li>
               <li>
                  <a href="{{ route('dashboard') }}"
                     class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ Request::routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-chart-pie"></i>
                     <span class="ml-3">Хянах самбар</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 0]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/0') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-inbox"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Шинээр ирсэн</span>
                     <span
                        class="bg-blue-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $new_complaints!==0 ? $new_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 2]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/2') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-inbox"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Хүлээн авсан</span>
                     <span
                        class="bg-orange-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $received_complaints !==0 ? $received_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 3]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/3') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-inbox"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Хянаж байгаа</span>
                     <span
                        class="bg-orange-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $under_control_complaints !== 0 ? $under_control_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 6]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/6') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-inbox"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Шийдвэрлэсэн</span>
                     <span
                        class="bg-green-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $solved_complaints!==0 ? $solved_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 4]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/4') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-inbox"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Цуцлагдсан</span>
                     <span
                        class="bg-red-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $canceled_complaints!==0 ? $canceled_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('user.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('user.index') ? 'bg-gray-100' : '' }}">
                     <i class="fa-regular fa-user"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Хэрэглэгчид</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaint.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('complaint.index') ? 'bg-gray-100' : '' }}">
                     <i class="fa-solid fa-inbox"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Бүгд</span>
                     <span
                        class="bg-blue-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $all_complaints }}</span>
                  </a>
               </li>
               <li>
                  <a href="#"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                     <i class="fa-solid fa-file-lines"></i>
                     <span class="ml-3 flex-1 whitespace-nowrap">Тайлан</span>
                  </a>
               </li>
               <li>
                  <form method="POST" action="{{ route('logout') }}" x-data>
                     @csrf
                     <a href="{{ route('logout') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group ">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="ml-3 flex-1 whitespace-nowrap">{{ __('Гарах') }}</span>
                     </a>
                  </form>
               </li>
            </ul>
         </div>
      </div>
   </div>
</aside>