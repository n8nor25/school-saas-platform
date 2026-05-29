<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
            <i data-lucide="user-plus" class="text-blue-500 w-4 h-4"></i>
            إنشاء حساب مستخدم جديد وتعيين الصلاحيات الهيكلية للمنصة
        </h3>
        
        <form action="?view=users" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="action" value="add_user">
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1.5">الاسم الكامل للموظف/المشرف</label>
                    <input type="text" name="username" required placeholder="مثال: أ. محمد أحمد علي..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1.5">البريد الإلكتروني (اسم المستخدم للولوج)</label>
                    <input type="email" name="email" required placeholder="name@school.com" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none font-mono" dir="ltr">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1.5">الرتبة ومستوى الصلاحية الكلية</label>
                    <select name="role" class="w-full h-11 px-2 bg-gray-50 border rounded-xl text-xs focus:outline-none">
                        <option value="school_admin">مشرف فرع المدرسة (Admin)</option>
                        <option value="control_officer">مسؤول كنترول (مدخل نتائج)</option>
                        <option value="content_manager">مدير محتوى وموقع (أخبار وسلايدر)</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1 shadow-sm transition-all">
                    <i data-lucide="shield-check" class="w-4 h-4"></i> 
                    توليد الحساب وتثبيت الصلاحية
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border shadow-sm p-4 space-y-3">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5 border-b pb-2">
            <i data-lucide="users" class="text-[#610000] w-4 h-4"></i>
            طاقم الإدارة ومستخدمي لوحة تحكم المدرسة الحالية
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-right divide-y divide-gray-100 font-semibold">
                <thead class="bg-gray-50 text-gray-700 font-bold">
                    <tr>
                        <th class="p-3">اسم الموظف</th>
                        <th class="p-3">مستوى الصلاحية</th>
                        <th class="p-3">تاريخ الإنشاء</th>
                        <th class="p-3 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-600">
                    @foreach(($users ?? []) as $u)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-[#610000] flex items-center justify-center font-bold border"><i data-lucide="user" class="w-4 h-4"></i></div>
                                    <div>
                                        <span class="font-bold text-gray-900 block">{{ $u['username'] }}</span>
                                        <span class="text-gray-400 text-[10px] block font-mono">ID: {{ $u['id'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 rounded-xl text-[10px] font-bold border {{ $u['role'] === 'super_admin' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-blue-50 text-blue-700 border-blue-200' }}">
                                    @if($u['role'] === 'super_admin') مدير النظام المركزي @elseif($u['role'] === 'school_admin') مشرف المدرسة @else موظف الكنترول @endif
                                </span>
                            </td>
                            <td class="p-3 font-mono text-gray-400 text-[11px]">{{ date('Y-m-d') }}</td>
                            <td class="p-3 flex justify-center gap-1">
                                <button type="button" onclick="alert('تعديل صلاحيات الحساب ({{ $u['username'] }}) ديناميكياً متوفر بحقن الـ الـ Dialog!')" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                                <button type="button" onclick="confirm('هل أنت متأكد من سحب صلاحية الولوج وإلغاء هذا المستخدم نهائياً؟')" class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i data-lucide="user-x" class="w-4 h-4"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>