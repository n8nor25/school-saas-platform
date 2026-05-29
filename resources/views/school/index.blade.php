<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth"> <!-- 📌 تم إضافة scroll-smooth لجعل الانتقال بين الأقسام انسيابياً وسلساً جداً -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schoolDetails['name'] }} - البوابة الإلكترونية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;850;900&display=swap');
        body { font-family: 'Cairo', sans-serif; }
        
        /* حركة شريط الإعلانات العاجلة */
        @keyframes ticker {
            0% { transform: translate3d(100%, 0, 0); }
            100% { transform: translate3d(-100%, 0, 0); }
        }
        .animate-news-ticker {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            animation: ticker 45s linear infinite;
        }
        .animate-news-ticker:hover {
            animation-play-state: paused;
        }
        
        /* تأثيرات البريق والوهج الفاخر للمكونات */
        .premium-glow {
            box-shadow: 0 10px 30px -15px rgba(97, 0, 0, 0.12);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-glow:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(97, 0, 0, 0.22);
        }
        .ad-glow { box-shadow: 0 0 15px -3px rgba(0, 150, 136, 0.2); }
        .ad-glow:hover { box-shadow: 0 0 25px -1px rgba(0, 150, 136, 0.4); }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-gray-800">
  
    
    <!-- استدعاء إستامبة الهيدر السحابية الموحدة والديناميكية للمدارس -->
     @include('school.partials.header')

    <!-- المحتوى المركزي للمنصة -->
    <main class="max-w-[1280px] mx-auto px-4 py-6 flex-1 space-y-12">
        
        <!-- قطاع الميديا التفاعلي -->
        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-12 md:col-span-6 h-[260px] md:h-[350px] bg-gray-900 rounded-2xl overflow-hidden shadow-lg relative group">
                <div id="main-slider" class="w-full h-full relative">
                    @foreach($schoolDetails['slider'] as $idx => $slide)
                        <div class="slide-frame absolute inset-0 transition-opacity duration-700 ease-in-out {{ $idx === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                            <img src="{{ $slide['image'] }}" class="w-full h-full object-cover opacity-70" alt="Slider">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-5">
                                <h3 class="text-white text-base md:text-lg font-bold leading-snug mb-1">{{ $slide['title'] }}</h3>
                                <p class="text-gray-300 text-xs line-clamp-2">{{ $slide['subtitle'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-12 md:col-span-3 bg-white rounded-2xl shadow-md border overflow-hidden flex flex-col h-[350px]">
                <div class="bg-[#2A374E] text-white px-4 py-2.5 flex items-center gap-1.5 shrink-0">
                    <i data-lucide="layers" class="w-4 h-4 text-red-400"></i>
                    <h3 class="font-bold text-xs">عناوين المنصة المتزامنة</h3>
                </div>
                <div class="flex-1 overflow-y-auto p-2 space-y-1.5 bg-slate-50/50">
                    @foreach($schoolDetails['slider'] as $idx => $slide)
                        <div onclick="syncToSlide({{ $idx }})" class="headline-trigger w-full text-right p-2.5 rounded-xl border transition-all duration-300 pointer-events-auto cursor-pointer text-xs font-bold {{ $idx === 0 ? 'bg-[#610000] text-white border-[#610000] shadow-md' : 'bg-white hover:bg-gray-100 border-gray-100 text-gray-700' }}">
                            <div class="line-clamp-2 leading-relaxed">{{ $slide['title'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            @php $isLiveBroadcastActive = $toggles['live_stream'] ?? false; @endphp
            <div class="col-span-12 md:col-span-3 flex flex-col gap-4 h-[350px]">
                <div class="bg-white rounded-2xl border shadow-md overflow-hidden flex flex-col {{ $isLiveBroadcastActive ? 'h-[170px]' : 'h-full' }} transition-all duration-300">
                    <div class="bg-[#610000] text-white px-4 py-2 flex items-center gap-1.5 shrink-0">
                        <i data-lucide="bell" class="w-4 h-4 text-red-300"></i>
                        <h3 class="font-bold text-xs">تنبيهات هامة للمدرسة</h3>
                    </div>
                    <div class="p-3 overflow-y-auto flex-1 divide-y divide-gray-100 text-[11px] font-semibold bg-slate-50/30">
                        @foreach($schoolDetails['news'] as $item)
                            @if($item['category'] === 'تنبيه')
                                <div class="py-1.5 hover:text-[#610000] cursor-pointer transition-colors leading-relaxed">⚠️ {{ $item['title'] }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                @if($isLiveBroadcastActive)
                    <div class="bg-white rounded-2xl border shadow-md overflow-hidden flex flex-col h-[164px] animate-fade-in">
                        <div class="bg-red-600 text-white px-4 py-2 flex items-center justify-between shrink-0 shadow-sm"><div class="flex items-center gap-1.5"><i data-lucide="tv" class="w-4 h-4"></i><h3 class="font-bold text-xs">بث مباشر للمسرح</h3></div></div>
                        <div class="flex-1 relative bg-gray-900 group">
                            <img src="https://images.unsplash.com/photo-1516280440614-37939bbacd6a?q=80&w=400" class="w-full h-full object-cover opacity-50" alt="Live">
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-2 text-center">
                                <a href="{{ $schoolDetails['settings']['live_stream_url'] }}" target="_blank" class="w-9 h-9 bg-red-600 hover:bg-red-700 text-white rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-110 duration-300 mb-1"><i data-lucide="play" class="w-4 h-4 fill-white ml-0.5"></i></a>
                                <span class="text-[8px] bg-red-600 text-white font-bold px-1.5 py-0.5 rounded mb-0.5">LIVE NOW</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- قسم من نحن ورسالة المدرسة -->
       <section id="welcome" class="bg-white rounded-3xl border border-gray-100 p-6 shadow-xl grid md:grid-cols-12 gap-6 items-center transition-all duration-300 hover:shadow-2xl">
    
      <div class="md:col-span-5 rounded-2xl overflow-hidden shadow-lg aspect-[4/3] border border-gray-100 relative group bg-gray-900">
        <video 
            src="{{ $schoolDetails['settings']['about_video'] ?? 'https://res.cloudinary.com/dc7ysj5yq/video/upload/v1717000000/school-website/welcome-edu.mp4' }}" 
            controls 
            preload="metadata"
            poster="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=600"
            class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
            عذراً، متصفحك لا يدعم مشغل الفيديو الذكي.
        </video>
        
        <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] font-black px-3 py-1 rounded-xl flex items-center gap-1 pointer-events-none tracking-wide">
            <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
            <span>فيديو تعريفي مدعوم سحابياً</span>
        </div>
       </div>
    
       <div class="md:col-span-7 space-y-4">
        <span class="inline-flex items-center gap-1.5 text-xs font-black text-[#610000] bg-red-50 px-4 py-1.5 rounded-full border border-red-100 shadow-sm">
            <i data-lucide="award" class="w-4 h-4"></i> رسالة ومهمة الصرح التعليمي
        </span>
        <h2 class="text-xl md:text-2xl font-black text-[#2A374E] tracking-tight">مرحباً بكم في بيئتكم التعليمية السحابية المطورة</h2>
        <p class="text-gray-600 text-sm leading-relaxed font-semibold">{{ $schoolDetails['description'] }}</p>
        
        <div class="p-4 bg-gradient-to-r from-slate-50 to-white border border-slate-100 rounded-2xl shadow-inner">
            <h4 class="font-black text-[#610000] text-xs flex items-center gap-1 mb-1.5">
                <i data-lucide="eye" class="w-4 h-4"></i> رؤيتنا الاستراتيجية التنموية
            </h4>
            <p class="text-gray-500 text-xs leading-relaxed font-bold">{{ $schoolDetails['settings']['vision'] }}</p>
        </div>
      </div>
      </section>

        <!-- قطاع المكونات الجانبية والإعلانية المطور -->
        <div class="grid grid-cols-12 gap-6 pt-2">
            <div class="col-span-12 lg:col-span-9 space-y-14">
                
                <!-- 1. استدعاء مكون الخدمات -->
                @include('school.components.services')
                
                <hr class="border-gray-200/60" />

                <!-- 2. استدعاء مكون الأخبار المحدث -->
                @include('school.components.news')

                <hr class="border-gray-200/60" />

                <!-- 3. استدعاء مكون معرض الصور المعتمد والمحمي -->
                @include('school.components.gallery')

            </div>

            <!-- المساحة الإعلانية الجانبية المستغلة -->
            <aside class="col-span-12 lg:col-span-3 space-y-5">
                <div class="ad-glow bg-white p-3 rounded-2xl border border-gray-200 shadow-lg sticky top-24 transition-all duration-300">
                    <div class="text-[10px] font-black text-gray-400 mb-2 flex items-center justify-between">
                        <span class="flex items-center gap-1"><i data-lucide="sparkles" class="w-3 h-3 text-amber-500"></i> مساحة إعلانية مضيئة</span>
                        <span class="bg-red-50 text-[#610000] px-1.5 py-0.5 rounded text-[8px] font-bold border border-red-100">AD</span>
                    </div>
                    <div class="w-full h-[320px] bg-gradient-to-br from-[#610000]/10 via-white to-slate-50 rounded-xl overflow-hidden relative flex flex-col justify-between p-4 border border-red-100/50 group">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=300" class="w-full h-full object-cover absolute inset-0 opacity-15 mix-blend-overlay group-hover:scale-105 transition-transform duration-700" alt="Ad">
                        <div class="relative z-10 space-y-1.5">
                            <span class="bg-red-600 text-white text-[9px] font-black px-2 py-0.5 rounded-md shadow-sm">حجز المجموعات</span>
                            <h4 class="text-sm font-black text-[#610000] leading-snug tracking-wide">بدء مجموعات الدعم الفائقة لشهادة الشهادة الإعدادية</h4>
                            <p class="text-gray-500 text-[11px] font-bold leading-relaxed">احجز مقعدك الآن مع كبار موجهي المحافظة بأسعار معتمدة ورمزية.</p>
                        </div>
                        <button class="w-full h-10 bg-[#610000] hover:bg-[#8a1414] text-white font-extrabold text-xs rounded-xl shadow-md flex items-center justify-center gap-1"><i data-lucide="arrow-up-right" class="w-4 h-4"></i> حجز فوري</button>
                    </div>
                </div>
            </aside>
        </div>

        <hr class="border-gray-200" />

        <!-- قطاع أرقام نجاح وإحصائيات المؤسسة -->
        <section class="bg-gradient-to-r from-[#610000] via-[#8a1414] to-[#2A374E] rounded-3xl p-6 text-white shadow-xl grid grid-cols-2 md:grid-cols-4 gap-4 text-center border border-red-950/20">
            <div class="transform hover:scale-105 transition-transform">
                <i data-lucide="users" class="w-6 h-6 mx-auto mb-1 text-red-200"></i>
                <div class="text-2xl font-black font-mono tracking-tight">{{ $schoolDetails['stats']['students'] }}</div>
                <div class="text-[10px] text-gray-300 mt-0.5 font-bold">طالب مسجل</div>
            </div>
            <div class="transform hover:scale-105 transition-transform">
                <i data-lucide="award" class="w-6 h-6 mx-auto mb-1 text-red-200"></i>
                <div class="text-2xl font-black font-mono tracking-tight">{{ $schoolDetails['stats']['teachers'] }}</div>
                <div class="text-[10px] text-gray-300 mt-0.5 font-bold">معلم متميز</div>
            </div>
            <div class="transform hover:scale-105 transition-transform">
                <i data-lucide="home" class="w-6 h-6 mx-auto mb-1 text-red-200"></i>
                <div class="text-2xl font-black font-mono tracking-tight">{{ $schoolDetails['stats']['classes'] }}</div>
                <div class="text-[10px] text-gray-300 mt-0.5 font-bold">فصل دراسي</div>
            </div>
            <div class="transform hover:scale-105 transition-transform">
                <i data-lucide="calendar" class="w-6 h-6 mx-auto mb-1 text-red-200"></i>
                <div class="text-2xl font-black font-mono tracking-tight">{{ $schoolDetails['stats']['years'] ?? 15 }}</div>
                <div class="text-[10px] text-gray-300 mt-0.5 font-bold">سنوات الخبرة والعطاء</div>
            </div>
        </section>

        <!-- قطاع طاقم المعلمين المتميزين والأكفاء -->
        <section class="space-y-4 pt-2">
            <h3 class="font-black text-sm text-[#2A374E] flex items-center gap-1.5 border-r-4 border-amber-400 pr-2.5"><i data-lucide="graduation-cap" class="text-amber-500 w-4 h-4"></i> طاقم المعلمين المتميزين والأكفاء بالمدرسة</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                @foreach($schoolDetails['teachers'] as $teacher)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm group hover:shadow-md transition-all hover:border-red-100">
                        <img src="{{ $teacher['avatar'] }}" class="w-16 h-16 rounded-full mx-auto object-cover mb-2.5 ring-2 ring-red-100/50 group-hover:ring-red-500 transition-all duration-300" alt="Teacher">
                        <h4 class="font-black text-gray-800 text-xs">{{ $teacher['name'] }}</h4>
                        <p class="text-gray-400 text-[10px] font-extrabold mt-0.5">{{ $teacher['subject'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <hr class="border-gray-200" />

        <!-- استدعاء مكون اتصل بنا وخريطة الموقع الجغرافية التفاعلية -->
        @include('school.components.contact')

    </main>

    <!-- الفوتر المعتمد السيادي للمنصة -->
    <!-- استدعاء إستامبة الفوتر السحابية الموحدة والديناميكية للمدارس -->
      @include('school.partials.footer') 

    <!-- ====== [ محرك التحكم الحركي التفاعلي لكافة مكونات البوابة ] ====== -->
    <script>
        lucide.createIcons();

        // أ. سلايدر الميديا الرئيسي
        let currentSlide = 0; const slides = document.querySelectorAll('.slide-frame'); const triggers = document.querySelectorAll('.headline-trigger');
        function syncToSlide(slideIdx) {
            if (!slides[slideIdx]) return; slides[currentSlide].classList.remove('opacity-100', 'z-10'); slides[currentSlide].classList.add('opacity-0', 'z-0');
            triggers[currentSlide].className = "headline-trigger w-full text-right p-2.5 rounded-xl border transition-all duration-300 cursor-pointer text-xs font-bold bg-white hover:bg-gray-100 border-gray-100 text-gray-700";
            currentSlide = slideIdx; slides[currentSlide].classList.remove('opacity-0', 'z-0'); slides[currentSlide].classList.add('opacity-100', 'z-10');
            triggers[currentSlide].className = "headline-trigger w-full text-right p-2.5 rounded-xl border transition-all duration-300 cursor-pointer text-xs font-bold bg-[#610000] text-white border-[#610000] shadow-md";
        }
        if (slides.length > 0) { setInterval(() => { let nextIdx = (currentSlide + 1) % slides.length; syncToSlide(nextIdx); }, 5000); }

        // ب. محرك عرض المزيد للخدمات
        let isServicesExpanded = false;
        function toggleMoreServicesGrid() {
            const hiddenCards = document.querySelectorAll('.hidden-service-card'); const btnText = document.getElementById('toggleServicesText'); const btnIcon = document.getElementById('toggleServicesIcon');
            isServicesExpanded = !isServicesExpanded;
            hiddenCards.forEach(card => isServicesExpanded ? card.classList.remove('hidden') : card.classList.add('hidden'));
            if (isServicesExpanded) { btnText.innerText = "طي وإخفاء خدمات المنصة الإضافية"; btnIcon.setAttribute('data-lucide', 'minus-circle'); } 
            else { btnText.innerText = "عرض المزيد من خدمات البوابة الإلكترونية"; btnIcon.setAttribute('data-lucide', 'plus-circle'); document.getElementById('services').scrollIntoView({ behavior: 'smooth' }); }
            lucide.createIcons();
        }

        // ت. محرك عرض المزيد للأخبار
        let isNewsExpanded = false;
        function toggleMoreNewsGrid() {
            const hiddenNews = document.querySelectorAll('.hidden-news-card'); const btnText = document.getElementById('toggleNewsText'); const btnIcon = document.getElementById('toggleNewsIcon');
            isNewsExpanded = !isNewsExpanded;
            hiddenNews.forEach(card => isNewsExpanded ? card.classList.remove('hidden') : card.classList.add('hidden'));
            if (isNewsExpanded) { btnText.innerText = "طي وإخفاء كروت الأخبار الإضافية"; btnIcon.setAttribute('data-lucide', 'minus-circle'); } 
            else { btnText.innerText = "عرض المزيد من أخبار وفعاليات المدرسة"; btnIcon.setAttribute('data-lucide', 'plus-circle'); document.getElementById('news_section').scrollIntoView({ behavior: 'smooth' }); }
            lucide.createIcons();
        }

        // ث. محرك عرض المزيد لمعرض الصور
        let isGalleryExpanded = false;
        function toggleMoreGalleryGrid() {
            const hiddenGallery = document.querySelectorAll('.hidden-gallery-card'); const btnText = document.getElementById('toggleGalleryText'); const btnIcon = document.getElementById('toggleGalleryIcon');
            isGalleryExpanded = !isGalleryExpanded;
            hiddenGallery.forEach(card => isGalleryExpanded ? card.classList.remove('hidden') : card.classList.add('hidden'));
            if (isGalleryExpanded) { btnText.innerText = "طي وإخفاء صور المعرض الإضافية"; btnIcon.setAttribute('data-lucide', 'minus-circle'); } 
            else { btnText.innerText = "عرض المزيد من لقطات المعرض المرئي"; btnIcon.setAttribute('data-lucide', 'plus-circle'); document.getElementById('gallery_section').scrollIntoView({ behavior: 'smooth' }); }
            lucide.createIcons();
        }
    </script>
</body>
</html><!-- استدعاء إستامبة الفوتر السحابية الموحدة والديناميكية للمدارس -->
