<x-admin-layout>
    <div class="w-full h-screen flex items-center justify-center py-8">
        <div class="w-full bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-6">
                <img src="{{ asset('images/what-is-voip.jpeg') }}" alt="SIP Setup" class="w-full h-auto rounded-lg">
            </div>
            <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">IP утасны дугаарыг суурин утасны
                төхөөрөмжид холбож, тохируулах заавар</h1>

            <p class="text-lg text-gray-700 mb-4">
                Хэрэв та суурин утасны аппарат ашиглахаар шийдсэн бол тухайн төхөөрөмж нь SIP протокол дэмждэг эсэхийг
                тодруулаарай. Хэрэв SIP протокол дэмждэггүй бол ашиглах боломжгүй болохыг анхаараарай.
            </p>

            <p class="text-lg text-gray-700 mb-4">
                IP дугаарыг суурин утсанд холбож тохируулга хийх аргачлалыг харуулав. Ихэнх төхөөрөмжүүдэд доор дурдсан
                тохиргооны ерөнхий алхмууд ижил байдаг ба зарим нэг төхөөрөмжид ялгаатай байж болохыг анхаарна уу.
            </p>

            <h2 class="text-2xl font-semibold text-gray-800 mt-6 mb-4">SIP протокол дэмждэг суурин утасны ерөнхий
                тохиргоо</h2>

            <ol class="list-decimal pl-6 space-y-4 text-lg text-gray-700">
                <li>
                    <span class="font-semibold">Утасны аппаратыг бэлтгэх:</span>
                    <ul class="list-inside list-disc">
                        <li>Утсыг асаана.</li>
                    </ul>
                </li>

                <li>
                    <span class="font-semibold">Сүлжээнд холбох:</span>
                    <ul class="list-inside list-disc">
                        <li>Утсыг интернэтийн сүлжээнд (LAN - Ethernet) холбоно.</li>
                        <li>Хэрэв утасгүй сүлжээ буюу Wi-Fi -д холбож байгаа бол сүлжээний нэр (SSID) болон нууц үгээ
                            оруулна.</li>
                    </ul>
                </li>

                <li>
                    <span class="font-semibold">SIP тохиргоо руу орох:</span>
                    <ul class="list-inside list-disc">
                        <li>Утасны Menu хэсгийн "Settings" буюу "Тохиргоо" хэсэг рүү ороод "SIP Accounts" эсвэл "Account
                            Settings" гэсэн хэсгийг олно.</li>
                    </ul>
                </li>

                <li>
                    <span class="font-semibold">SIP хэрэглэгч нэмэх:</span>
                    <ul class="list-inside list-disc">
                        <li><strong>Display Name:</strong> (Таны нэр) - Нэр оруулна. (Заавал шаардахгүй.)</li>
                        <li><strong>User Name:</strong> (Хэрэглэгчийн нэр) - SIP login хэрэглэгчийн нэрийг (“ДҮТ”
                            ТӨХХК-иас олгосон).</li>
                        <li><strong>Password:</strong> (Нууц үг) - SIP нууц үгийг оруулна (“ДҮТ” ТӨХХК-иас олгосон).
                        </li>
                        <li><strong>SIP сервер:</strong> (SIP серверийн хаяг) - Таны SIP үйлчилгээ үзүүлэгчийн серверийн
                            хаягийг оруулна. (“ДҮТ” ТӨХХК-иас олгосон).</li>
                        <li><strong>SIP Proxy:</strong> (Proxy сервер) – (Хоосон үлдээнэ.)</li>
                        <li><strong>Transport Type:</strong> - UDP гэсэн төрлийг сонгоно.</li>
                        <li><strong>Хадгалах:</strong> Тохиргоог хадгалах "Save" гэсэн товчийг дарна.</li>
                    </ul>
                </li>

                <li>
                    <span class="font-semibold">Тест холболт:</span>
                    <ul class="list-inside list-disc">
                        <li>Суурин утсаараа дуудлага хийж, орох гарах дуудлагыг шалгана.</li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>
</x-admin-layout>
