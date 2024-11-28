<aside id="sidebar"
   class="fixed z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col transition-width duration-75"
   aria-label="Sidebar" :class="{'w-64': sidebarOpen, 'w-0': !sidebarOpen}">
   <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
      <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
         <div class="flex-1 px-3 bg-white divide-y space-y-1">
            <ul class="space-y-2 pb-2">
               <li x-data="{ subMenuOpen: false }">
                  <button x-on:click="subMenuOpen = !subMenuOpen" type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 {{ (Request::routeIs('dashboardEhzh') || Request::routeIs('dashboardTze') || Request::routeIs('dashboardEhs')) ? 'bg-gray-100 text-primary font-medium' : '' }}">
                        <img src="{{ asset('/image/dashboard-layout.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="dashboard">
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Хянах самбар</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                  </button>
                  <ul x-show="subMenuOpen" class="py-2 space-y-2 ml-4">
                     @if (Auth::user()->role->name == 'ehzh')   
                     <li>
                        <a href="{{ route('dashboardEhzh') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-6 group hover:bg-gray-100 {{ Request::routeIs('dashboardEhzh') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                           ЭХЗХ
                        </a>
                     </li>
                     <li>
                        <a href="{{ route('dashboardTze') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-6 group hover:bg-gray-100 {{ Request::routeIs('dashboardTze') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                           ТЗЭ</a>
                     </li>
                     <li>
                        <a href="{{ route('dashboardEhs') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-6 group hover:bg-gray-100 {{ Request::routeIs('dashboardEhs') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                           ЭХС</a>
                     </li>
                     @else
                     <li>
                        <a href="{{ route('dashboardTzeShow') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-6 group hover:bg-gray-100 {{ Request::routeIs('dashboardTzeShow') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                           ТЗЭ</a>
                     </li>
                     @endif
                  </ul>
               </li>
               @if (Auth::user()->role->name == 'ehzh')   
               <li>
                  <a href="{{ route('sourceComplaint.index') }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('sourceComplaint.index') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/source-control.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="new">
                     <span class="ml-3 flex-1 whitespace-nowrap">1111-н хүсэлт</span>
                     @if ($source_complaints > 0)
                     <span
                     class="bg-gray-100 text-primary shadow border ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $source_complaints }}</span>
                     @endif
                  </a>
               </li>
               @endif

               @if (Auth::user()->role->name == 'tze' || Auth::user()->role->name == 'ehzh')
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 0]) }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/0') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/inbox-in.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="new">
                     <span class="ml-3 flex-1 whitespace-nowrap">Шинээр ирсэн</span>
                     @if ($new_complaints > 0)
                     <span
                     class="bg-gray-100 text-primary border shadow ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $new_complaints }}</span>
                     @endif
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 2]) }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/2') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/rule-draft.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="recieved">
                      
                     <span class="ml-3 flex-1 whitespace-nowrap">Хүлээн авсан</span>
                     @if ($received_complaints > 0)
                     <span
                        class="bg-gray-100 text-primary border shadow ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $received_complaints }}</span>
                     @endif
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 3]) }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/3') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/rule-test.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="recieved">
                     <span class="ml-3 flex-1 whitespace-nowrap">Хянаж байгаа</span>
                     @if ($under_control_complaints > 0)
                     <span
                        class="bg-gray-100 text-primary border shadow ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $under_control_complaints }}</span>
                     @endif
                  </a>
               </li>
               @if (Auth::user()->role->name == 'ehzh')
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 1]) }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/1') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/document-export.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="sent">
                     <span class="ml-3 flex-1 whitespace-nowrap">Шилжүүлсэн</span>
                     @if ($sent_complaints > 0)
                     <span
                        class="bg-gray-100 text-primary border shadow ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $sent_complaints }}</span>
                     @endif
                  </a>
               </li>
               @endif
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 6]) }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/6') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/approve-invoice.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="report">
                     <span class="ml-3 flex-1 whitespace-nowrap">Шийдвэрлэсэн</span>
                     @if ($solved_complaints > 0)
                     <span
                        class="bg-gray-100 border shadow text-primary ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $solved_complaints }}</span>
                     @endif
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 4]) }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/4') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/rule-cancelled.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="cancelled">
                     <span class="ml-3 flex-1 whitespace-nowrap">Цуцлагдсан</span>
                     @if ($canceled_complaints > 0)
                     <span
                        class="bg-gray-100 text-primary border shadow ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{ $canceled_complaints }}</span>
                     @endif
                  </a>
               </li>
               @endif
               
               <li>
                  <a href="{{ route('complaint.index') }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('complaint.index') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/documents-symbol.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="report">
                     <span class="ml-3 flex-1 whitespace-nowrap">Тайлан</span>
                  </a>
               </li>
               
            </ul>

            {{-- Тохиргоо --}}
            @auth
            <ul class="pt-4 mt-4 space-y-2 border-t border-gray-200">
               @if (Auth::user()->role?->name == 'admin' || Auth::user()->role?->name == 'ehzh')
               <li>
                  <a href="{{ route('user.index') }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('user.index') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/group-security.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="users">
                     <span class="ml-3 flex-1 whitespace-nowrap">Хэрэглэгчид</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('organization.index') }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('organization.index') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/organization-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="organization">
                     <span class="ml-3 flex-1 whitespace-nowrap">Байгууллага</span>
                  </a>
               </li>
               @endif
               <li>
                  <a href="{{ route('cdr.index') }}"
                     class="text-base text-gray-900 rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('cdr.index') ? 'bg-gray-100 text-primary font-medium' : '' }}">
                     <img src="{{ asset('/image/turntable-music-note.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="users">
                     <span class="ml-3 flex-1 whitespace-nowrap">Яриа бичлэг</span>
                  </a>
               </li>
            </ul>
            @endauth
            
         </div>
      </div>
   </div>
</aside>