<div class="max-w-xl mx-auto text-xs font-semibold space-y-6 animate-fade-in">
    
    <form action="?view=settings" method="POST" class="bg-white p-5 rounded-2xl border shadow-sm space-y-5">
        @csrf
        <input type="hidden" name="action" value="save_settings">
        
        <h3 class="text-sm font-bold text-[#1a1a2e] border-b pb-2 flex items-center gap-2">
            <i data-lucide="settings" class="w-4 h-4 text-[#610000]"></i>
            إعدادات المدرسة والهوية البصرية الملكية
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-gray-600 block mb-1">رقم هاتف التواصل المعتمد</label>
                <input type="text" name="phone" value="0123456789" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none focus:border-[#610000]">
            </div>
            <div>
                <label class="text-gray-600 block mb-1">البريد الإلكتروني الرسمي</label>
                <input type="email" name="email" value="info@school.edu" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none focus:border-[#610000] font-mono">
            </div>
        </div>

        <div>
            <label class="text-gray-600 block mb-1">العنوان الجغرافي للمدرسة</label>
            <input type="text" name="address" value="الشارع الرئيسي، جمهورية مصر العربية" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none focus:border-[#610000]">
        </div>

        <div class="p-4 bg-slate-50 border rounded-xl space-y-3">
            <h4 class="font-bold text-gray-700 text-xs flex items-center gap-1"><i data-lucide="palette" class="w-4 h-4 text-[#610000]"></i> تخصيص ألوان المنصة الإلكترونية</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-500 block mb-1">اللون الرئيسي الملكي (Primary)</label>
                    <div class="flex gap-2">
                        <input type="color" value="#610000" oninput="document.getElementById('color-primary-text').value = this.value" class="w-12 h-11 p-1 bg-white border rounded-xl cursor-pointer">
                        <input type="text" id="color-primary-text" name="primaryColor" value="#610000" class="w-full h-11 px-3 border bg-white rounded-xl focus:outline-none font-mono">
                    </div>
                </div>
                <div>
                    <label class="text-gray-500 block mb-1">اللون الثانوي للمنصة (Secondary)</label>
                    <div class="flex gap-2">
                        <input type="color" value="#009688" oninput="document.getElementById('color-secondary-text').value = this.value" class="w-12 h-11 p-1 bg-white border rounded-xl cursor-pointer">
                        <input type="text" id="color-secondary-text" name="secondaryColor" value="#009688" class="w-full h-11 px-3 border bg-white rounded-xl focus:outline-none font-mono">
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 border rounded-xl bg-red-50/40 border-red-100/70 space-y-3">
            <div class="flex items-center justify-between">
                <div>
                    <label class="font-bold text-gray-800 text-xs block">مفتاح إشارة البث المباشر (Live Stream)</label>
                    <p class="text-gray-400 text-[10px] mt-0.5">تفعيل أو تعطيل ظهور كارت نبض البث على واجهة المدرسة الرئيسية.</p>
                </div>
                <input type="checkbox" name="showLiveStream" {{ ($toggles['showLiveStream'] ?? false) ? 'checked' : '' }} class="w-4 h-4 accent-red-600 cursor-pointer">
            </div>
            <div>
                <label class="text-gray-600 block mb-1 text-[11px]">رابط البث المباشر المستهدف (YouTube / Facebook)</label>
                <input type="text" name="liveStreamUrl" value="https://youtube.com" placeholder="https://..." class="w-full h-10 px-3 border bg-white rounded-xl focus:outline-none font-mono" dir="ltr">
            </div>
        </div>

        <button type="submit" class="w-full h-11 bg-gradient-to-r from-[#610000] to-[#8B0000] hover:from-[#8B0000] hover:to-[#a00000] text-white rounded-xl font-bold shadow-md transition-all flex items-center justify-center gap-1.5">
            <i data-lucide="save" class="w-4 h-4"></i> 
            حفظ وإقرار كافة الإعدادات والبيانات الحالية
        </button>
    </form>
</div>