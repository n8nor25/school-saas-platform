<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-3">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
            <i data-lucide="user-plus" class="text-blue-500 w-4 h-4"></i>
            إضافة وإدراج معلم جديد لكادر المدرسة التعليمي
        </h3>
        
        <form action="?view=teachers" method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
            @csrf
            <input type="hidden" name="action" value="add_teacher">
            <div>
                <label class="text-gray-600 block mb-1">اسم المعلم بالكامل</label>
                <input type="text" name="name" required placeholder="أدخل اسم الأستاذ..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
            </div>
            <div>
                <label class="text-gray-600 block mb-1">التخصص الأكاديمي والمادة</label>
                <input type="text" name="subject" required placeholder="مثال: لغة عربية، رياضيات، علوم..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
            </div>
            <div>
                <label class="text-gray-600 block mb-1">البريد الإلكتروني للمعلم</label>
                <input type="email" name="email" required placeholder="teacher@school.edu" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000] font-mono">
            </div>
            <div class="sm:col-span-3 flex justify-end">
                <button type="submit" class="h-11 px-5 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1 shadow-sm transition-all">
                    <i data-lucide="plus" class="w-4 h-4"></i> اعتماد ودمج المعلم الجديد
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($filteredTeachers as $teacher)
            <div class="bg-white rounded-2xl border shadow-sm p-5 text-center space-y-3 flex flex-col justify-between group hover:shadow-md transition-shadow">
                <div class="space-y-2">
                    <div class="relative w-16 h-16 mx-auto rounded-full overflow-hidden border-2 border-slate-100 ring-2 ring-red-50/50 shadow-inner">
                        <img src="{{ $teacher['avatar'] }}" class="w-full h-full object-cover" alt="Teacher Image">
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-[#610000] transition-colors">{{ $teacher['name'] }}</h4>
                    
                    <span class="inline-block px-3 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $teacher['subject'] }}
                    </span>
                    <p class="text-gray-400 font-mono text-[10px] pt-1 truncate" dir="ltr">{{ $teacher['email'] }}</p>
                </div>

                <div class="pt-2 border-t border-gray-50 flex items-center justify-center">
                    <form action="?view=teachers" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف المعلم نهائياً من كشوف المدرسة؟')">
                        @csrf
                        <input type="hidden" name="action" value="delete_teacher">
                        <input type="hidden" name="id" value="{{ $teacher['id'] }}">
                        <button type="submit" class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-xl flex items-center gap-1 border border-red-50 hover:border-red-200 transition-all font-bold">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> الحذف النهائي
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>