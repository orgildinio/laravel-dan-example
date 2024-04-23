<!-- ====== FAQ Section Start -->
<section x-data="
   {
   openFaq1: false, 
   openFaq2: false, 
   openFaq3: false, 
   openFaq4: false, 
   openFaq5: false, 
   openFaq6: false,
   openFaq7: false,
   openFaq8: false,
   openFaq9: false,
   openFaq10: false,
   openFaq11: false
   }
   " class="relative z-10 overflow-hidden bg-white pt-20 pb-12 lg:pt-[120px] lg:pb-[90px] border-t border-inherit">
   <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap -mx-4">
         <div class="w-full px-4">
            <div class="mx-auto mb-[60px] max-w-[520px] text-center lg:mb-20">
               <h2 class="text-dark mb-4 text-xl font-bold sm:text-[40px]/[48px]">
                  Түгээмэл асуулт, хариулт
               </h2>
            </div>
         </div>
      </div>
      <div class="flex flex-wrap -mx-4">
         <div class="w-full px-4 lg:w-1/2">
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq1 = !openFaq1">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq1 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Шөнийн тарифын хөнгөлөлтөд яаж хамрагдах вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq1" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Цахилгаан эрчим хүчний шөнийн тарифын хөнгөлөлт нь Монгол Улсын Засгийн Газрын 2020 оны 115 дугаар
                     тогтоолоор Агаарын бохирдлыг бууруулах зорилгоор нийслэлийн болон аймгийн төв, зарим сум, суурин
                     газрын “Гэр хорооллын өрхөд цахилгаан эрчим хүчний тарифын хөнгөлөлт үзүүлэх журам”-аар
                     зохицуулагдаж байгаа бөгөөд <span class="font-bold">журмын 3.5-д заасны дагуу “Хэрэглэгч нь тарифын
                        хөнгөлөлт эдлэхээс өмнө хэрэглэсэн цахилгаан эрчим хүчний өр төлбөргүй байна.”</span></p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">Үүнтэй уялдан Эрчим хүчний
                     зохицуулах хорооны тогтоолоор жил бүр шөнийн цагт хэрэглэсэн цахилгааны тариф болон сэргээгдэх
                     эрчим хүчийг дэмжих тарифт хөнгөлөлт үзүүлж байна.
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq2 = !openFaq2">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq2 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Цахилгаан хэрэглэгчдээс суурь хураамж яагаад авдаг вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq2" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Цахилгааны хэрэглэгчдийн сарын суурь төлбөрийг 2019 оны 07-р сарын 01-ний өдрөөс эхлэн 2000
                     төгрөгөөр тогтоон мөрдүүлж байна. Дэлхийн улс орнуудын эрчим хүчний салбарт хэрэглэгчийн олон
                     төрлийн тариф мөрдөгддөг бөгөөд хэрэглэгчийн сарын суурь төлбөр, чадлын тариф, энергийн тариф гэсэн
                     үндсэн 3 хэсгээс бүрдэж байна.
                  </p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Цахилгаан эрчим хүчийг тасралтгүй үйлдвэрлэж, дамжуулан түгээж, хэрэглэгчдийг ямар ч үед /хоногийн
                     24 цагийн турш/ цахилгаан хэрэглэхэд бэлэн байлгадаг учраас зардалд үндэслэсэн суурь хураамжийг
                     хэрэглэгчдээс авдаг. Мөн үйлдвэрлэгч буюу дулааны цахилгаан станцууд нь цахилгаан дамжуулах
                     сүлжээнд цахилгааныг энергийн тарифаар болон бэлэн байлгасан чадлыг чадлын тарифаар борлуулдаг.
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq3 = !openFaq3">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq3 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Чадлын төлбөрийг хаана тооцохгүй вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq3" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     “Цахилгаан эрчим хүч хэрэглэх дүрэм”-ийн дагуу трансформаторын хоосон явалтын алдагдал тооцогддог
                     хэрэглэгчийн хувьд чадлын алдагдалд чадлын төлбөр тооцохгүй.</p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Хэрэглэгчийн чадлын итгэлцүүр cos(j)-ээс хамааруулж төлбөр тооцох журмын дагуу тооцож буй
                     цахилгааны нэмэлт хэрэглээнд чадлын төлбөр ногдуулахгүй.</p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Сууц өмчлөгчдийн холбооны нийтийн зориулалттай байрны орцны гэрэлтүүлэг, цахилгаан шат, гараж,
                     подвалийн хэрэглээнд чадлын төлбөр ногдуулахгүй. СӨХ нь өөрийн эзэмшлийн шугам сүлжээнээс бусад аж
                     ахуйн нэгж байгууллагыг холбосон нөхцөлд тэдгээр аж ахуйн нэгж байгууллагуудын цахилгаан хэрэглээнд
                     чадлын төлбөрийг холбогдох журмын дагуу тооцно.
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq4 = !openFaq4">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq4 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Цахилгаан эрчим хүчний хангамж, хэрэглээ, төлбөр тооцоотой холбоотой асуудлаар хаана хандах вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq4" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Хэрэглэгч та эрчим хүчний хангамж, хэрэглээ, төлбөр тооцоо болон бусад асуудлаар эрчим хүчээр
                     хангах гэрээ байгуулан ажиллаж байгаа хангагч байгууллагад хандана.
                  </p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Хангагч байгууллагын зүгээс асуудлыг шийдээгүй эсвэл үндэслэлгүй шийдвэр гаргасан гэж үзвэл та
                     Эрчим хүчний зохицуулах хороонд хандаж асуудлаа шийдүүлэх боломжтой.
                  </p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Тоолуур болон тооцооны хэмжих хэрэгсэлтэй холбоотой асуудлаар Стандартчилал хэмжил зүйн газарт
                     болон хэмжил зүйн улсын байцаагчид хандана.
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq5 = !openFaq5">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq5 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Төлбөр тооцооны талаарх маргааныг хэрхэн шийдвэрлдэх вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq5" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Хэрэглэгч нь төлбөр тооцооны талаар маргаантай асуудлаар санал, хүсэлтээ дараа сарын 10-ны дотор
                     албан бичгээр хангагч байгууллагад хандаж шийдвэрлүүлнэ.
                  </p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Хэрэв хангагч байгууллагын шийдвэрийг хэрэглэгч зөвшөөрөхгүй бол гомдлоо Эрчим хүчний зохицуулах
                     хороо, шүүхэд гаргаж шийдвэрлүүлнэ.
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq6 = !openFaq6">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq6 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Хүнээс байр, орон сууц худалдан авахад цахилгаан эрчим хүчний өр төлбөрийг хэн хариуцах вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq6" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     "Цахилгаан эрчим хүч хэрэглэх дүрэм"-ийн 43-т заасны дагуу байр, орон сууц, хашаа, газар өмчлөгч
                     эзэмшигч иргэн, аж ахуйн нэгж, байгууллага нүүн шилжихдээ хэрэглэсэн цахилгаан эрчим хүчний тооцоог
                     хийж дуусган хангагчаас тодорхойлолтыг авсан байна. Энэ тодорхойлолтыг тухайн байр, орон сууц,
                     хашаа, газрыг шинээр өмчлөгч эзэмшигч иргэн, аж ахуйн нэгж, байгууллага шаардаж авна.
                  </p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify font-bold">
                     Хэрэв уг тодорхойлолтыг аваагүй тохиолдолд шинээр өмчлөгч эрчим хүчний өр төлбөрийг хариуцдаг.
                  </p>
               </div>
            </div>
         </div>
         <div class="w-full px-4 lg:w-1/2"> 
            
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq7 = !openFaq7">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq7 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Шинэ баригдсан орон сууцны ашиглалт, борлуулалтыг хүлээлгэн өгөх гэсэн юм?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq7" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Эрчим хүчний тухай хуулийн 30 дугаар зүйлийн 30.1.13-т заасны дагуу нийтийн эзэмшлийн орон сууцны
                     барилга барих тохиолдолд барьсан эрчим хүчний дэд станц, шугам, тоноглолыг тусгай зөвшөөрөл
                     эзэмшигчид шилжүүлэх үүрэгтэй.
                  </p>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Та бүрдүүлэх материалаа тэмдэглээд аваарай.
                  </p>
                  <ol class="list-decimal pl-8 text-justify">
                     <li>Борлуулалт хүлээлгэн өгөх аж ахуйн нэгж, иргэний хүсэлт албан бичиг</li>
                     <li>Дэд станц болон барилгын 0.4 кВ-ийн кабель шугам болон бусад цахилгаан тоноглолын ашиглалтыг
                        УБЦТС ТӨХК-ийн үндсэн хөрөнгөд шилжүүлэхээр материалаа бүрдүүлж өгсөн бол холбогдох шийдвэр
                        гарах хүртэл хугацаанд цахилгаан тоноглолын ашиглалтыг хариуцах тухай иргэн, аж ахуйн нэгж
                        байгууллагын албан бичиг. /Иргэн хариуцах бол бичгийг иргэний үнэмлэхний хуулбарын хамт/ </li>
                     <li>Нийтийн эзэмшлийн орц, шат, талбай, гараж, подвалын цахилгаан эрчим хүчний тооцоог хариуцах аж
                        ахуйн нэгжийн албан бичиг</li>
                     <li>Ялтсан бойлерын цахилгаан эрчим хүчний тооцоог хариуцах иргэн, аж ахуйн нэгжийн албан бичиг
                     </li>
                     <li>Эзэмшигчийн иргэний үнэмлэх </li>
                     <li>Техникийн нөхцөлийн хуулбар</li>
                     <li>Барилга байгууламжийг ашиглалтад оруулах улсын комиссын актын хуулбар</li>
                     <li>Бүх айл өрхийн үл хөдлөх хөрөнгийн гэрчилгээ </li>
                     <li>Тоолуурын гэрчилгээ</li>
                  </ol>
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">Хот байгуулалтын тухай хуулийн
                     8-р зүйлийн 8.1.1, 8.1.2 заалтын дагуу "хот, тосгоны хэсэгчилсэн ерөнхий төлөвлөгөөг боловсруулж,
                     шаардлагатай хөрөнгийн эх үүсвэрийг орон нутгийн төсөвт тусган шийдвэрлүүлэх" гэж заасны дагуу орон
                     нутгийн засаг захиргаанд хүсэлтээ гаргана.</p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq8 = !openFaq8">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq8 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Төлбөр төлөөгүй шалтгаанаар цахилгаан эрчим хүчээр түдгэлзүүлэх нь үндэслэлтэй юу?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq8" class="faq-content pl-[62px]">
                  <ol class="list-decimal pl-8 text-justify">
                     <li>Эрчим хүчний тухай хуулийн 32 дугаар зүйлийн 32.2-т “Эрчим хүчээр хангагчийн эрх бүхий ажилтан дараахь тохиолдолд хэрэглэгчийн эрчим хүчний хэрэглээг зөрчлийг арилгах хүртэл хугацаагаар түдгэлзүүлнэ”</li>
                     <p class="text-center p-4">32.2.1-д “Эрчим хүч хэрэглэсний төлбөрөө хугацаанд нь төлөөгүй” </p>
                     <li>Эрчим хүчний тухай хуулийн 28 дугаар зүйл 28.1-д “Эрчим хүчээр хангагч, хэрэглэгчийн харилцааг Иргэний хууль, энэ хууль, аж ахуйн харилцааны дүрэм, эрчим хүчээр хангагч, хэрэглэгчийн хооронд байгуулсан гэрээгээр зохицуулна” </li>
                     <li>Цахилгаан эрчим хүч хэрэглэх дүрмийн 4 дүгээр зүйлийн 4.1-д “Хангагч нь иргэн, хуулийн этгээдтэй Эрчим хүчний тухай хуулийн 28 дугаар зүйлд заасны дагуу цахилгаан эрчим хүчээр хангах гэрээ (цаашид “гэрээ” гэх) байгуулснаар иргэн, хуулийн этгээд нь цахилгаан эрчим хүч хэрэглэх эрхээр хангагдана”</li>
                     <li>Аж ахуйн харилцааны дүрмийн 5 дугаар зүйлийн 5.1.2 “Хэрэглэсэн цахилгаан эрчим хүчний төлбөрийн нэхэмжлэл банкинд очсоноос хойш алданги тооцож эхлэх болон цахилгаан эрчим хүчээр түдгэлзүүлж эхлэх хоногуудыг тус тус хэрэглэгчтэй байгуулж буй гэрээгээр зохицуулна” зэрэг хууль дүрмийн үндэслэлүүдээр цахилгаан эрчим хүчээр түдгэлзүүлнэ.</li>
                  </ol>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq9 = !openFaq9">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq9 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Сэргээгдэх эрчим хүчийг дэмжих төлбөрийг яагаад хэрэглэгчдээс авдаг вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq9" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Сэргээгдэх эрчим хүчний тухай хуулийн 4.1.9."дэмжих тариф" гэж сэргээгдэх эрчим хүчийг дэмжих зорилгоор эрчим хүчний үнэд шингээсэн тарифыг хэлнэ гэж заасан. <span class="font-bold">Сэргээгдэх эрчим хүчийг ашиглан цахилгаан, дулааны эрчим хүчийг үйлдвэрлэж хэрэглэгчдэд түгээдэг түгээлтийн зардлыг тооцож авдаг.</span>
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq10 = !openFaq10">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq10 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Айл өрхийнн цахилгааны дотор монтажны гэмтлийг хаана хандаж засварлуулах вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq10" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Эрчим хүчний тухай хуульд хэрэглэгч нь өөрийн эзэмшлийн тоног төхөөрөмжийн засвар үйлчилгээг бүрэн хариуцна гэж заасан байдаг тул төлбөрт үйлчилгээгээр цахилгаан, дулаанаар хангагч байгууллага болон бусад хуулийн этгээдээр засварлуулна.
                  </p>
               </div>
            </div>
            <div
               class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8">
               <button class="flex w-full text-left faq-btn" @click="openFaq11 = !openFaq11">
                  <div
                     class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg">
                     <svg :class="openFaq11 && 'rotate-180'" width="22" height="22" viewBox="0 0 22 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                           d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                           fill="currentColor" />
                     </svg>
                  </div>
                  <div class="w-full">
                     <h4 class="mt-1 text-lg font-semibold text-dark">
                        Хувийн дэд станцтай хэрэглэгч нарын шугам тоноглолоос холбогдоход ханаас зөвшөөрөл авах вэ?
                     </h4>
                  </div>
               </button>
               <div x-show="openFaq11" class="faq-content pl-[62px]">
                  <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                     Хувийн шугам, дэд станцтай хэрэглэгч нараас цахилгаан эрчим хүчээр хангагдах гэж байгаа бол <span class="font-bold">тухайн шугамын өмчлөгч, эзэмшигчээс зөвшөөрөл авч хангагч байгууллагаас техникийн нөхцөл авах, хангагчтай гэрээ байгуулж ажиллахыг зөвлөж байна.</span>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="absolute bottom-0 right-0 z-[-1]">
      <svg width="1440" height="886" viewBox="0 0 1440 886" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path opacity="0.5"
            d="M193.307 -273.321L1480.87 1014.24L1121.85 1373.26C1121.85 1373.26 731.745 983.231 478.513 729.927C225.976 477.317 -165.714 85.6993 -165.714 85.6993L193.307 -273.321Z"
            fill="url(#paint0_linear)" />
         <defs>
            <linearGradient id="paint0_linear" x1="1308.65" y1="1142.58" x2="602.827" y2="-418.681"
               gradientUnits="userSpaceOnUse">
               <stop stop-color="#3056D3" stop-opacity="0.36" />
               <stop offset="1" stop-color="#F5F2FD" stop-opacity="0" />
               <stop offset="1" stop-color="#F5F2FD" stop-opacity="0.096144" />
            </linearGradient>
         </defs>
      </svg>
   </div>
</section>
<!-- ====== FAQ Section End -->