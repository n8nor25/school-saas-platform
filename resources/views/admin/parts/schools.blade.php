<div class="space-y-4 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white p-5 rounded-2xl border shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
            <i data-lucide="building-2" class="w-4 h-4 text-emerald-500"></i>
            إنشاء مستأجر (Tenant) مدرسة جديدة وتوليد النطاق المعزول
        </h3>
        
        <form action="?view=schools" method="POST" class="space-y-4">
            @csrf 
            <input type="hidden" name="action" value="save_school">
            <input type="hidden" id="form-school-id" name="id" value="">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1">اسم المدرسة بالكامل</label>
                    <input type="text" id="form-school-name" name="name" required placeholder="مثال: مدرسة الأجاويد الحديثة" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none focus:border-[#610000]">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">النطاق الفرعي المعزول (Subdomain)</label>
                    <input type="text" id="form-school-subdomain" name="subdomain" required placeholder="مثال: school1" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none focus:border-[#610000] font-mono">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">حالة تفعيل اشتراك المؤسسة</label>
                    <select id="form-school-isActive" name="isActive" class="w-full h-11 px-2 border bg-gray-50 rounded-xl focus:outline-none">
                        <option value="1">نشط ومفعل بكامل الصلاحيات (Active)</option>
                        <option value="0">موقوف ومحجوب مؤقتاً (Suspended)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1">اللون الرئيسي للهوية البصرية (Primary Color)</label>
                    <div class="flex gap-2">
                        <input type="color" id="form-school-color-picker" value="#610000" oninput="document.getElementById('form-school-color-text').value = this.value" class="w-12 h-11 p-1 bg-gray-50 border rounded-xl cursor-pointer">
                        <input type="text" id="form-school-color-text" name="primaryColor" value="#610000" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none font-mono">
                    </div>
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">شعار المدرسة الرسمي (Logo)</label>
                    <input type="file" class="w-full h-11 p-1.5 border bg-gray-50 rounded-xl focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t">
                <button type="button" onclick="resetSchoolForm()" class="h-11 px-4 border rounded-xl hover:bg-gray-50">إلغاء الأمر</button>
                <button type="submit" id="form-school-submit" class="h-11 px-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold shadow-md">توليد وبناء السيرفر والمستأجر للمدرسة</button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach(($schools ?? []) as $sch)
            <div class="bg-white border rounded-2xl p-4 shadow-sm flex items-center justify-between group hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-md font-bold" style="background-color: {{ $sch['primaryColor'] ?? '#610000' }}">
                        <i data-lucide="building" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-sm leading-snug">{{ $sch['name'] }}</h4>
                        <div class="flex gap-1.5 mt-1 text-[10px] font-mono">
                            <span class="text-gray-400">SUBDOMAIN: <span class="text-blue-600 font-bold">{{ $sch['subdomain'] }}</span></span>
                            <span class="text-gray-300">|</span>
                            <span class="font-bold {{ $sch['isActive'] ? 'text-emerald-600' : 'text-red-500' }}">
                                {{ $sch['isActive'] ? '● نشط' : '● موقوف' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-0.5">
                    <button onclick="editSchoolTenant({{ json_encode($sch) }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="تعديل الهوية والترخيص"><i data-lucide="edit" class="w-4 h-4"></i></button>
                    
                    <form action="?view=schools" method="POST" class="inline" onsubmit="return confirm('تحذير برمجي حاسم: حذف المدرسة سيقوم بحذف كافة كشوف نتائجها وجداولها ومستخدميها نهائياً من النظام، هل تريد الاستمرار؟')">
                        @csrf
                        <input type="hidden" name="action" value="delete_school">
                        <input type="hidden" name="id" value="{{ $sch['id'] }}">
                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function editSchoolTenant(sch) {
        document.getElementById('form-school-id').value = sch.id;
        document.getElementById('form-school-name').value = sch.name;
        document.getElementById('form-school-subdomain').value = sch.subdomain;
        document.getElementById('form-school-isActive').value = sch.isActive ? "1" : "0";
        document.getElementById('form-school-color-picker').value = sch.primaryColor;
        document.getElementById('form-school-color-text').value = sch.primaryColor;
        document.getElementById('form-school-submit').innerText = "تحديث وتثبيت بيانات ترخيص المدرسة";
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetSchoolForm() {
        document.getElementById('form-school-id').value = "";
        document.getElementById('form-school-name').value = "";
        document.getElementById('form-school-subdomain').value = "";
        document.getElementById('form-school-submit').innerText = "توليد وبناء السيرفر والمستأجر للمدرسة";
    }
</script>