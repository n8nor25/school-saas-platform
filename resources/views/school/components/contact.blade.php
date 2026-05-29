<section id="contact_map_section" class="grid grid-cols-1 md:grid-cols-12 gap-6 pt-4">
    
    <!-- كارت اتصل بنا وإرسال الرسائل والملاحظات (9 أعمدة) -->
    <div class="col-span-12 lg:col-span-9 bg-white border border-gray-100 p-6 rounded-3xl shadow-xl space-y-5">
        <div class="border-r-4 border-slate-700 pr-3">
            <h3 class="text-lg font-black text-[#2A374E] tracking-wide">صندوق التواصل المباشر مع إدارة المدرسة</h3>
            <p class="text-gray-400 text-xs mt-0.5 font-bold">يسعدنا استقبال استفساراتكم واقتراحاتكم لتطوير جودة الخدمات التعليمية بالمنصة</p>
        </div>

        <form action="#" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4 font-bold text-xs">
            @csrf
            <div class="space-y-1.5">
                <label class="text-gray-600 block pr-1">اسم المرسل الكلي *</label>
                <input type="text" placeholder="اكتب اسمك الثلاثي هنا..." required class="w-full h-11 px-4 bg-slate-50 border border-gray-100 rounded-xl focus:outline-none focus:border-[#610000] focus:ring-2 focus:ring-red-100 transition-all">
            </div>
            <div class="space-y-1.5">
                <label class="text-gray-600 block pr-1">رقم الهاتف للتواصل *</label>
                <input type="tel" placeholder="اكتب رقم الجوال الجاري..." required class="w-full h-11 px-4 bg-slate-50 border border-gray-100 rounded-xl focus:outline-none focus:border-[#610000] focus:ring-2 focus:ring-red-100 transition-all font-mono">
            </div>
            <div class="sm:col-span-2 space-y-1.5">
                <label class="text-gray-600 block pr-1">موضوع ونص الرسالة أو الاستفسار *</label>
                <textarea rows="3" placeholder="اكتب كامل تفاصيل رسالتك أو شكواك هنا وسيتم الرد من إدارة الكنترول والمدرسة فوراً..." required class="w-full p-4 bg-slate-50 border border-gray-100 rounded-xl focus:outline-none focus:border-[#610000] focus:ring-2 focus:ring-red-100 transition-all leading-relaxed"></textarea>
            </div>
            <div class="sm:col-span-2 pt-1">
                <button type="submit" class="h-11 px-6 bg-[#2A374E] hover:bg-slate-800 text-white font-black text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 transform active:scale-95">
                    <i data-lucide="send" class="w-4 h-4"></i> إرسال الرسالة للـمدرسة الآن
                </button>
            </div>
        </form>
    </div>

    <!-- خريطة مسار الموقع الجغرافية التفاعلية بجوار اتصل بنا (3 أعمدة) -->
    <div class="col-span-12 lg:col-span-3 bg-white p-3 rounded-3xl border border-gray-100 shadow-xl flex flex-col h-full min-h-[300px]">
        <div class="text-[11px] font-black text-gray-700 p-2 border-b flex items-center gap-1 bg-slate-50 rounded-t-xl shrink-0">
            <i data-lucide="map-pin" class="w-4 h-4 text-red-500 animate-bounce"></i>
            <span>موقعنا الجغرافي المعتمد عبر الخريطة</span>
        </div>
        <div class="flex-1 rounded-2xl overflow-hidden bg-slate-100 border border-gray-50 relative mt-2">
            <!-- يمكنك حقن كود الـ iframe الحقيقي لخرائط جوجل لمدرستك هنا بالملي -->
            <iframe class="absolute inset-0 w-full h-full border-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3451.234567890123!2d31.12345678901234!3d30.12345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDA3JzE0LjQiTiAzMcKwMDcnMTQuNCJF!5e0!3m2!1sar!2seg!4v1234567890123" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>