<!-- ====== إستامبة الفوتر الموحدة والديناميكية لـ منصة SaaS ====== -->
    <footer id="contact" class="bg-[#2A374E] text-white mt-auto border-t-4 border-[#610000]">
        
        <!-- الشريط اللوني المضيء بأعلى الفوتر -->
        <div class="flex h-1.5">
            <div class="flex-1 bg-red-600"></div>
            <div class="flex-1 bg-white"></div>
            <div class="flex-1 bg-black"></div>
        </div>

        <div class="max-w-[1280px] mx-auto px-4 py-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-xs leading-relaxed">
            
            <!-- العمود الأول: يتغير تلقائياً حسب المدرسة الحالية -->
            <div>
                <!-- حقن اسم المدرسة ديناميكياً -->
                <h4 class="font-black text-sm text-red-400 mb-3">{{ $schoolDetails['name'] }}</h4>
                <p class="text-gray-300 mb-3 font-semibold leading-relaxed">{{ $schoolDetails['description'] }}</p>
                <!-- حقن عنوان المدرسة ديناميكياً -->
                <p class="text-gray-400 font-bold">📍 {{ $schoolDetails['address'] ?? 'الموقع الجغرافي المعتمد للمدرسة' }}</p>
            </div>

            <!-- العمود الثاني: روابط ذكية تدعم التنقل السحابي لكل مدرسة -->
            <div>
                <h4 class="font-black text-sm text-red-400 mb-3">روابط سريعة وهامة للمنصة</h4>
                <div class="grid grid-cols-2 gap-2 font-bold text-slate-300">
                    <a href="/{{ $tenant }}" class="hover:text-red-400 transition-colors">الرئيسية للموقع</a>
                    <a href="{{ route('student.life', ['tenant' => $tenant]) }}" class="hover:text-red-400 transition-colors">الحياة الطلابية</a>
                    <a href="/{{ $tenant }}/search" class="hover:text-red-400 transition-colors">نتائج الطلاب</a>
                    <a href="#welcome" class="hover:text-red-400 transition-colors">عن المدرسة</a>
                </div>
            </div>

            <!-- العمود الثالث: بصمة المطور الثابتة والمشاعة لكافة المدارس المشتركة -->
            <div class="space-y-3">
                <h4 class="font-black text-sm text-red-400 mb-2">الدعم الفني والتقني للمنصة السحابية</h4>
                <div class="p-3 bg-white/5 rounded-xl border border-white/10 flex items-center gap-3 shadow-inner">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-red-500 shadow-md shrink-0">
                        <img src="https://res.cloudinary.com/dc7ysj5yq/image/upload/v1777145223/school-website/designer/zttkev3i4cace2yzko9n.png" alt="محروس شعبان" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-gray-400 text-[9px] uppercase tracking-wider font-extrabold">تطوير وهندسة برمجيات المنصة</p>
                        <p class="text-white text-sm font-black tracking-wide">محروس شعبان</p>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- شريط الحقوق السفلي: يدمج اسم المدرسة الحالية مع بصمة الـ SaaS والمطور ثابتة -->
        <div class="bg-black/20 py-3 text-center text-gray-400 text-[11px] font-black tracking-wide">
            جميع الحقوق محفوظة © {{ date('Y') }} {{ $schoolDetails['name'] }} - مشغل بواسطة نظام SaaS للمدارس الإعدادية.
        </div>
    </footer>