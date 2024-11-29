
  <section class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-8 rounded-lg shadow-lg " x-data="{ activeTab: 'tab1' }">
    <div class="text-center mb-8">
      <h2 class="text-2xl font-bold sm:text-3xl">Түгээмэл асуулт, хариулт</h2>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200">
      <div class="flex justify-center space-x-4">
        <button 
          class="py-2 px-4 font-medium text-gray-600 border-b-2 focus:outline-none"
          :class="activeTab === 'tab1' ? 'border-primary text-primary' : 'border-transparent'"
          @click="activeTab = 'tab1'"
        >
          Цахилгаан
        </button>
        <button 
          class="py-2 px-4 font-medium text-gray-600 border-b-2 focus:outline-none"
          :class="activeTab === 'tab2' ? 'border-primary text-primary' : 'border-transparent'"
          @click="activeTab = 'tab2'"
        >
          Дулаан
        </button>
      </div>
    </div>

    <!-- Tab Content -->
    <div class="mt-6">
      <!-- Tab 1 Content -->
      <div x-show="activeTab === 'tab1'" x-transition>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Шөнийн тарифын хөнгөлөлтөд яаж хамрагдах вэ?</summary>
            <div class="mt-2 text-gray-600"><p class="py-3 text-base leading-relaxed text-body-color text-justify">
               Цахилгаан эрчим хүчний шөнийн тарифын хөнгөлөлт нь Монгол Улсын Засгийн Газрын 2020 оны 115 дугаар
               тогтоолоор Агаарын бохирдлыг бууруулах зорилгоор нийслэлийн болон аймгийн төв, зарим сум, суурин
               газрын “Гэр хорооллын өрхөд цахилгаан эрчим хүчний тарифын хөнгөлөлт үзүүлэх журам”-аар
               зохицуулагдаж байгаа бөгөөд <span class="font-bold">журмын 3.5-д заасны дагуу “Хэрэглэгч нь тарифын
                  хөнгөлөлт эдлэхээс өмнө хэрэглэсэн цахилгаан эрчим хүчний өр төлбөргүй байна.”</span></p>
            <p class="py-3 text-base leading-relaxed text-body-color text-justify">Үүнтэй уялдан Эрчим хүчний
               зохицуулах хорооны тогтоолоор жил бүр шөнийн цагт хэрэглэсэн цахилгааны тариф болон сэргээгдэх
               эрчим хүчийг дэмжих тарифт хөнгөлөлт үзүүлж байна.
            </p></б>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Цахилгаан хэрэглэгчдээс суурь хураамж яагаад авдаг вэ?</summary>
            <div class="mt-2 text-gray-600">
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
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Чадлын төлбөрийг хаана тооцохгүй вэ?</summary>
            <div class="mt-2 text-gray-600">
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
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Цахилгаан эрчим хүчний хангамж, хэрэглээ, төлбөр тооцоотой холбоотой асуудлаар хаана хандах вэ?</summary>
            <div class="mt-2 text-gray-600">
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
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Төлбөр тооцооны талаарх маргааныг хэрхэн шийдвэрлдэх вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хэрэглэгч нь төлбөр тооцооны талаар маргаантай асуудлаар санал, хүсэлтээ дараа сарын 10-ны дотор
                  албан бичгээр хангагч байгууллагад хандаж шийдвэрлүүлнэ.
               </p>
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хэрэв хангагч байгууллагын шийдвэрийг хэрэглэгч зөвшөөрөхгүй бол гомдлоо Эрчим хүчний зохицуулах
                  хороо, шүүхэд гаргаж шийдвэрлүүлнэ.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Хүнээс байр, орон сууц худалдан авахад цахилгаан эрчим хүчний өр төлбөрийг хэн хариуцах вэ?</summary>
            <div class="mt-2 text-gray-600">
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
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Шинэ баригдсан орон сууцны ашиглалт, борлуулалтыг хүлээлгэн өгөх гэсэн юм?</summary>
            <div class="mt-2 text-gray-600">
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
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
         <details>
           <summary class="cursor-pointer font-semibold text-gray-700">Төлбөр төлөөгүй шалтгаанаар цахилгаан эрчим хүчээр түдгэлзүүлэх нь үндэслэлтэй юу?</summary>
           <div class="mt-2 text-gray-600">
            <ol class="list-decimal pl-8 text-justify">
               <li>Эрчим хүчний тухай хуулийн 32 дугаар зүйлийн 32.2-т “Эрчим хүчээр хангагчийн эрх бүхий ажилтан дараахь тохиолдолд хэрэглэгчийн эрчим хүчний хэрэглээг зөрчлийг арилгах хүртэл хугацаагаар түдгэлзүүлнэ”</li>
               <p class="text-center p-4">32.2.1-д “Эрчим хүч хэрэглэсний төлбөрөө хугацаанд нь төлөөгүй” </p>
               <li>Эрчим хүчний тухай хуулийн 28 дугаар зүйл 28.1-д “Эрчим хүчээр хангагч, хэрэглэгчийн харилцааг Иргэний хууль, энэ хууль, аж ахуйн харилцааны дүрэм, эрчим хүчээр хангагч, хэрэглэгчийн хооронд байгуулсан гэрээгээр зохицуулна” </li>
               <li>Цахилгаан эрчим хүч хэрэглэх дүрмийн 4 дүгээр зүйлийн 4.1-д “Хангагч нь иргэн, хуулийн этгээдтэй Эрчим хүчний тухай хуулийн 28 дугаар зүйлд заасны дагуу цахилгаан эрчим хүчээр хангах гэрээ (цаашид “гэрээ” гэх) байгуулснаар иргэн, хуулийн этгээд нь цахилгаан эрчим хүч хэрэглэх эрхээр хангагдана”</li>
               <li>Аж ахуйн харилцааны дүрмийн 5 дугаар зүйлийн 5.1.2 “Хэрэглэсэн цахилгаан эрчим хүчний төлбөрийн нэхэмжлэл банкинд очсоноос хойш алданги тооцож эхлэх болон цахилгаан эрчим хүчээр түдгэлзүүлж эхлэх хоногуудыг тус тус хэрэглэгчтэй байгуулж буй гэрээгээр зохицуулна” зэрэг хууль дүрмийн үндэслэлүүдээр цахилгаан эрчим хүчээр түдгэлзүүлнэ.</li>
            </ol>
           </div>
         </details>
       </div>
        <div class="faq-item border-b border-gray-200 py-4">
         <details>
           <summary class="cursor-pointer font-semibold text-gray-700">Сэргээгдэх эрчим хүчийг дэмжих төлбөрийг яагаад хэрэглэгчдээс авдаг вэ?</summary>
           <div class="mt-2 text-gray-600">
            <p class="py-3 text-base leading-relaxed text-body-color text-justify">
               Сэргээгдэх эрчим хүчний тухай хуулийн 4.1.9."дэмжих тариф" гэж сэргээгдэх эрчим хүчийг дэмжих зорилгоор эрчим хүчний үнэд шингээсэн тарифыг хэлнэ гэж заасан. <span class="font-bold">Сэргээгдэх эрчим хүчийг ашиглан цахилгаан, дулааны эрчим хүчийг үйлдвэрлэж хэрэглэгчдэд түгээдэг түгээлтийн зардлыг тооцож авдаг.</span>
            </p>
           </div>
         </details>
       </div>
        <div class="faq-item border-b border-gray-200 py-4">
         <details>
           <summary class="cursor-pointer font-semibold text-gray-700">Айл өрхийнн цахилгааны дотор монтажны гэмтлийг хаана хандаж засварлуулах вэ?</summary>
           <div class="mt-2 text-gray-600">
            <p class="py-3 text-base leading-relaxed text-body-color text-justify">
               Эрчим хүчний тухай хуульд хэрэглэгч нь өөрийн эзэмшлийн тоног төхөөрөмжийн засвар үйлчилгээг бүрэн хариуцна гэж заасан байдаг тул төлбөрт үйлчилгээгээр цахилгаан, дулаанаар хангагч байгууллага болон бусад хуулийн этгээдээр засварлуулна.
            </p>
           </div>
         </details>
       </div>
        <div class="faq-item border-b border-gray-200 py-4">
         <details>
           <summary class="cursor-pointer font-semibold text-gray-700">Хувийн дэд станцтай хэрэглэгч нарын шугам тоноглолоос холбогдоход ханаас зөвшөөрөл авах вэ?</summary>
           <div class="mt-2 text-gray-600">
            <p class="py-3 text-base leading-relaxed text-body-color text-justify">
               Хувийн шугам, дэд станцтай хэрэглэгч нараас цахилгаан эрчим хүчээр хангагдах гэж байгаа бол <span class="font-bold">тухайн шугамын өмчлөгч, эзэмшигчээс зөвшөөрөл авч хангагч байгууллагаас техникийн нөхцөл авах, хангагчтай гэрээ байгуулж ажиллахыг зөвлөж байна.</span>
            </p>
           </div>
         </details>
       </div>
      </div>

      <!-- Tab 2 Content -->
      <div x-show="activeTab === 'tab2'" x-transition>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Айл өрхийн халаалтын төлбөрийг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 5 дугаар зүйл  5.3.5."Айл өрхийн халаалтын төлбөрийг дулааны тоолуураар тооцох боломжгүй тохиолдолд Монгол Улсын MNS 6058:2009 стандарт /Орон сууцны барилгын доторх сууцны талбай тооцох аргачлал/-д заасан сууцны болон сууцны бус зориулалттай талбайн нийлбэрээр ахуйн хэрэглэгчийн тарифын ангиллын дагуу тооцох ба халаах хэрэгсэлгүй тагт, лоож, верандын талбайд халаалтын төлбөр тооцохгүй. 
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Хэрэгцээний халуун ус халаасан дулааны төлбөр гэж юу вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хэрэгцээний халуун ус халаасан дулааны төлбөр нь 1м3 усыг халаахад шаардагдах дулааны энергийг тооцон төлбөрийг хэлнэ.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Хэрэгцээний халуун усны чанарын шаардлага хэдэн хэм байх ёстой вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  5 градустай хүйтэн усыг Дулааны цахилгаан станцаас үйлдвэрлэгдэж буй 70-135°C-ын температуртай сүлжээний усаар 50°С-аас багагүй хэм хүртэл халааж хэрэглэгчдэд түгээхийг хэлнэ.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Хэрэгцээний халуун ус халаасан дулааны төлбөрийг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хэрэгцээний халуун ус халаасан дулааны төлбөрийг халуун усны тоолуурын заалтыг үндэслэн Эрчим хүчний зохицуулах хорооны батлагдсан тарифийн ангиллын дагуу тооцох ба хэмжүүргүй тохиолдолд (халаалтын улирал, халаалтын бус улиралд) хүний тоо буюу ам бүлийн тооноос хамааруулан задгайгаар тооцдог. 
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Дулааны эрчим хүчний үйлчилгээний тарифийг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Ахуйн хэрэглэгчдийн дулааны эрчим хүчний үйлчилгээний тарифийг халаалтын төлбөр тооцох талбайн хэмжээнээс хамааруулан 40 м2 хүртэл, 41м2-80м2, 81м2-дээш гэсэн 3 тооцдог.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Подвалын халаалтын төлбөрийг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 5 дугаар зүйл 5.3.10-д Орон сууцны барилгын подвалд халаах хэрэгсэл /регистр, усан агаар халаагч/ суурилагдсан тохиолдолд аж ахуйн үйл ажиллагаа явуулж байгаа бол эзэлхүүнээр тооцно.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Орон сууцны барилгын халаалттай авто зогсоолын зориулалттай зоорийн давхрын халаалтын төлбөрийг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 5 дугаар зүйл 5.3.11 "Барилгын подвалд халаах хэрэгсэл /регистр, усан агаар халаагч хэвийн ажиллаж байгаа/ суурилагдсан авто зогсоолын зориулалтаар ашиглаж байгаа бол дулааны эрчим хүчний төлбөрийг талбайн хэмжигдэхүүнээр тооцох ба халаалтын төлбөр тооцох талбайн хэмжээг халаах хэрэгсэл бүхий зоорийн давхрын нийт талбайн 50%-иар тооцно"
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Нийтийн эзэмшлийн халаалтын төлбөрийг хэрхэн тооцох вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 5 дугаар зүйл 5.3.7.Орон сууцны барилгын орцны халаалтын төлбөрийг халаах хэрэгсэл бүхий давхрын талбайн хэмжигдэхүүн (метр квадрат)-ээр тооцох ба сууц өмчлөгч нь дундын өмчлөлийн орцны халаалтын төлбөрийг Иргэний хуулийн 147 дугаар зүйлийн 147.2 дахь заалтыг үндэслэн дулаан түгээх, дулаанаар зохицуулалттай хангах тусгай зөвшөөрөл эзэмшигчид хангах гэрээний дагуу төлж болно.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Халаалтын төлбөрөөс хасалт хэрхэн хийдэг вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 2 дугаар зүйл 2.8 "Дулааны тасалдлаас учирсан аливаа хохирлыг нөхөн төлөх талаар дулаанаар хангах гэрээнд тодорхой тусгасан байна" , 5 дугаар зүйл 5.3.15 "Дулааны тоног төхөөрөмж, шугам, сүлжээ эвдэрч гэмтсэнээс байрны халаалтыг хаасан тохиолдолд хаасан хоногт /цагт/ ногдох халаалтын төлбөрийг тухайн сарын хэрэглэгчийн халаалтын төлбөрөөс хасаж тооцох бөгөөд уг төлбөрийг буруутай этгээд хариуцна" дахь зүйл заалт тус бүрээр хэрэглэгчийн дулааны эрчим хүчнээс хасалт хийнэ.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Гэрээ хэзээ хийгдэх вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 2 дугаар зүйл 2.6 "Хангагч, хэрэглэгч нь дулаанаар хангах гэрээг жил бүрийн халаалтын улирал эхлэх хугацаанд буюу Эрчим хүчний асуудал эрхэлсэн төрийн захиргааны төв байгууллагын тогтоосон хугацаанд байгуулж мөн тогтоосон халаалтын улирал дуусахад гэрээг дүгнэж, тооцоо нийлэн акт үйлдэнэ" -д үндэслэн гэрээ хийж, тооцоо нийлнэ
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Орон сууцны өрөөний дотор агаарын температурыг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Орон сууц, олон нийтийн барилга. Өрөөний бичил уур амьсгалын үзүүлэлт MNS5825:2007 стандартын дагуу дотор агаарын температурыг тооцох ба Орон сууцны барилгын өрөөний тасалгааны температур 18(20°С) байна.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Төлбөрийн алдангийг хэзээнээс тооцож эхэлдэг вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Аж ахуйн харилцааны дүрмийн 3 дугаар зүйл 3.8-д Хэрэглэсэн дулааны эрчим хүчний төлбөрийн нэхэмжлэл банканд очсоноос хойш алданги тооцож эхлэх болон дулааны эрчим хүчээр түдгэлзүүлж эхлэх хоногуудыг тус тус хэрэглэгчтэй байгуулж буй гэрээгээр зохицуулна.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Төлбөрийн алдангийг хэрхэн тооцдог вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  31.3.Эрчим хүчээр хангагч нь гэрээнд заасан хугацаанд эрчим хүчний төлбөрөө төлөөгүй буюу зохих ёсоор төлөөгүй хэрэглэгчид хугацаа хожимдуулсан хоног тутамд төлөгдөөгүй төлбөрийн үнийн дүнгийн 0.5 хүртэл хувьтай тэнцэх алданги ногдуулна.
                  31.4.Энэ хуулийн 31.2, 31.3-т заасан торгууль, алдангийн хэмжээ нийлүүлээгүй буюу дутуу нийлүүлсэн эрчим хүчний үнийн дүнгийн буюу төлөөгүй төлбөрийн 50 хувиас хэтэрч болохгүй.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Хэрэглэгчийг дулааны эрчим хүчээр хязагаарлах, түдгэлзүүлэх талаар ямар хугацаанд мэдэгдсэн байх ёстой вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хангагч нь хэрэглэгчийн дулаан хангамжийг түр хугацаагаар түдгэлзүүлэх шаардлагатай бол түдгэлзүүлэхээс 24-өөс доошгүй цагийн өмнө хэрэглэгчид мэдэгдэнэ. Мөн төлбөрийн үлдэгдэлтэй холбоотой дулаан хангамжийг түдгэлзүүлэх талаар хэрэглэгчдэд 72 цагийн өмнө урьдчилан мэдэгдэнэ. 
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Дулааны эрчим чанарын доголдолтой холбоотой асуудлаар эхлээд хаана хандах вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хэрэглэгч та дулааны эрчим хүчний хэрэглээ, төлбөр тооцоо болон бусад асуудлаар дулааны эрчим хүчээр хангах гэрээний дагуу эхлээд хангагч байгууллагад хандана. Хангагч буюу тусгай зөвшөөрөл эзэмшигчийн зүгээс асуудлыг бүрэн шийдвэрлээгүй эсвэл үндэслэлгүй шийдвэр гаргасан гэж үзвэл та Эрчим хүчний зохицуулах хороонд цахим, гар утасны апп-аар хандаж асуудлаа шийдвэрлүүлэх боломжтой. 
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Төлбөр тооцооны маргааныг хэрхэн шийдвэрлэх вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Хэрэглэгч нь төлбөр тооцоотой холбоотой маргааны асуудлаар санал, хүсэлт, өргөдөл, гомдлоо хангагчаас мэдэгдэл хүлээн авснаас хойш 7 хоногийн дотор хангагч байгуулагад хандаж шийдвэрлүүлнэ. Хангагч байгууллагын шийдвэрийг үл зөвшөөрвөл Эрчим хүчний зохицуулах хороо, шүүх хяналтын байгууллагад хандаж шийдвэрлүүлнэ. 
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Төлбөр төлөөгүй үндэслэлээр дулааны эрчим хүч хязгаарлах үндэслэлтэй юу?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Эрчим хүчний тухай хуулийн 32 дугаар зүйлийн 32.2.1-т "эрчим хүч хэрэглэсэн төлбөрөө хугацаанд нь төлөөгүй" зөрчлийг арилгах хүртэл хугацаагаар түдгэлзүүлнэ.
               </p>
            </div>
          </details>
        </div>
        <div class="faq-item border-b border-gray-200 py-4">
          <details>
            <summary class="cursor-pointer font-semibold text-gray-700">Давхар хоорондын шугамын гэмтлийг хаана хандаж засварлуулах вэ?</summary>
            <div class="mt-2 text-gray-600">
               <p class="py-3 text-base leading-relaxed text-body-color text-justify">
                  Иргэний тухай хуулийн 147 дугаар зүйл 147.6-т "Орон сууц өмчлөгчдийн холбоо нь дундын өмчлөлийн зүйлийн засвар үйлчилгээг гэрээний үндсэн дээр мэргэжлийн байгууллагаар гүйцэтгүүлэх бөгөөд гэрээний үүрэгтэй холбоотой бусдад учруулсан гэм хорыг холбооны дүрэм, сууц өмчлөгчтэй байгуулсан гэрээнд өөрөөр заагаагүй бол энэ хуулийн 147.2, 147.3-т тус тус заасны дагуу Сууц өмчлөгчдийн холбоо нь гэрээний үндсэн дээр мэргэжлийн байгууллагаар засвар үйлчилгээг гүйцэтгүүлэх үүрэгтэй. 
               </p>
            </div>
          </details>
        </div>
      </div>
    </div>
  </section>
