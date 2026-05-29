<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white border p-5 rounded-2xl shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
            <i data-lucide="plus-circle" class="text-[#610000] w-4 h-4"></i>
            إضافة صف دراسي جديد وتعيين المواد
        </h3>
        <form action="?view=grades" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
            @csrf
            <input type="hidden" name="action" value="add_grade">
            <div>
                <label class="text-gray-500 block mb-1.5">اسم الصف الدراسي</label>
                <input type="text" name="name" required placeholder="مثال: الصف الأول الإعدادي" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
            </div>
            <div>
                <label class="text-gray-500 block mb-1.5">المواد الدراسية المقيدة (مفصولة بفواصل "،")</label>
                <input type="text" name="subjects" required placeholder="arabic، english، math، science" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
            </div>
            <div class="sm:col-span-2 flex justify-end">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1 shadow-sm transition-all">
                    <i data-lucide="plus" class="w-4 h-4"></i> 
                    إضافة وإدراج الصف الدراسي
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white border p-5 rounded-2xl shadow-sm space-y-4">
        <div class="flex justify-between items-center border-b pb-2">
            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
                <i data-lucide="graduation-cap" class="text-[#610000] w-4 h-4"></i>
                الهيكل التنظيمي للصفوف والمواد بالمدرسة
            </h3>
            <button onclick="location.href='?view=grades&archived={{ $showArchived ? 'false' : 'true' }}'" class="h-9 px-3 border rounded-xl flex items-center gap-1.5 {{ $showArchived ? 'bg-amber-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="archive" class="w-4 h-4"></i> 
                <span>{{ $showArchived ? 'إخفاء الأرشيف' : 'عرض السجلات المؤرشفة' }}</span>
            </button>
        </div>

        <div class="space-y-3">
            @if(!isset($filteredGrades) || count($filteredGrades) === 0)
                <div class="text-center py-6 text-gray-400">لا توجد صفوف معتمدة معروضة حالياً</div>
            @else
                @foreach($filteredGrades as $grade)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 rounded-xl border bg-white hover:bg-slate-50/50 transition-colors">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <h4 class="font-bold text-sm text-[#1a1a2e]">{{ $grade['name'] }}</h4>
                                @if($grade['archived']) 
                                    <span class="bg-amber-50 text-amber-700 px-2 py-0.5 rounded border border-amber-200 text-[10px]">مؤرشف</span> 
                                @endif
                            </div>
                            
                            <div class="flex flex-wrap gap-1.5">
                                @php 
                                    $labels = ['arabic' => 'لغة عربية', 'english' => 'لغة إنجليزية', 'math' => 'رياضيات', 'science' => 'علوم', 'socialStudies' => 'دراسات اجتماعية', 'computer' => 'حاسب آلي']; 
                                @endphp 
                                @foreach(json_decode($grade['subjects'], true) as $sub)
                                    <span class="bg-slate-100 text-gray-600 px-2.5 py-1 rounded-lg border text-[10px] font-bold">
                                        {{ isset($labels[$sub]) ? $labels[$sub] : $sub }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-1 self-end sm:self-center">
                            <button onclick="openEditGradeModal({{ json_encode($grade) }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg" title="تعديل المواد"><i data-lucide="edit" class="w-4 h-4"></i></button>
                            
                            <form action="?view=grades" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="toggle_archive_grade">
                                <input type="hidden" name="id" value="{{ $grade['id'] }}">
                                <input type="hidden" name="target_state" value="{{ $grade['archived'] ? 'false' : 'true' }}">
                                <button type="submit" class="p-2 {{ $grade['archived'] ? 'text-emerald-600 hover:bg-emerald-50' : 'text-amber-500 hover:bg-amber-50' }} rounded-lg">
                                    <i data-lucide="{{ $grade['archived'] ? 'archive-restore' : 'archive' }}" class="w-4 h-4"></i>
                                </button>
                            </form>

                            <form action="?view=grades" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الصف نهائياً؟')">
                                @csrf
                                <input type="hidden" name="action" value="delete_grade">
                                <input type="hidden" name="id" value="{{ $grade['id'] }}">
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>