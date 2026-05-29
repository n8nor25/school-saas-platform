<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
            <i data-lucide="plus-circle" class="text-purple-500 w-4 h-4"></i>
            إضافة لافتة (سلايدر ترحيبي) جديد للواجهة الرئيسية للموقع
        </h3>
        
        <form action="?view=sliders" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="action" value="save_slider">
            <input type="hidden" name="id" value="">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1">العنوان الرئيسي العريض</label>
                    <input type="text" name="title" required placeholder="مثال: أهلاً بكم في منصتنا التعليمية المطورة..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">الوصف الفرعي المصاحب</label>
                    <input type="text" name="subtitle" required placeholder="الوصف والمضمون المصاحب للعنوان..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-3 bg-purple-50/40 border border-purple-100 rounded-xl space-y-1.5">
                    <label class="text-purple-800 block font-bold">الخيار الأول: رفع صورة من جهازك</label>
                    <p class="text-gray-400 text-[10px] font-medium mb-1">تُرفع تلقائياً على سحابة Cloudinary (أبعاد عريضة ممتازة 1200x400).</p>
                    <input type="file" name="uploaded_file" accept="image/*" class="w-full h-10 p-1 bg-white border rounded-lg text-xs focus:outline-none">
                </div>
                
                <div class="p-3 bg-blue-50/40 border border-blue-100 rounded-xl space-y-1.5">
                    <label class="text-blue-800 block font-bold">الخيار الثاني: الصق رابط الصورة مباشر يدوياً</label>
                    <p class="text-gray-400 text-[10px] font-medium mb-1">إذا كانت الصورة مرفوعة وجاهزة، الصق رابطها هنا.</p>
                    <input type="text" name="direct_url" placeholder="https://res.cloudinary.com/..." class="w-full h-10 px-3 bg-white border rounded-lg text-xs focus:outline-none font-mono" dir="ltr">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1.5">رابط الانتقال (اختياري)</label>
                    <input type="text" name="link" placeholder="https://..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none font-mono" dir="ltr">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1.5">الترتيب الرقمي للعرض</label>
                    <input type="number" name="sortOrder" value="{{ count($filteredSliders ?? []) }}" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none">
                </div>
            </div>

            <input type="hidden" name="active" value="1">

            <div class="flex justify-end">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1 shadow-sm transition-all">
                    <i data-lucide="plus" class="w-4 h-4"></i> 
                    اعتماد وجدولة لافتة السلايدر الجديدة
                </button>
            </div>
        </form>
    </div>

    <div class="flex items-center justify-between flex-wrap gap-2 bg-white p-4 rounded-2xl border shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
            <i data-lucide="sliders-horizontal" class="text-[#610000] w-4 h-4"></i>
            سجلات لوائح لافتات السلايدر الرئيسية الحالية
        </h3>
        <button onclick="location.href='?view=sliders&archived={{ $showArchived ? 'false' : 'true' }}'" class="h-9 px-3 border rounded-xl flex items-center gap-1.5 {{ $showArchived ? 'bg-amber-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="archive" class="w-4 h-4"></i>
            <span>{{ $showArchived ? 'إخفاء السجلات المؤرشفة' : 'أرشيف السلايدر' }}</span>
        </button>
    </div>

    <div class="space-y-3">
        @if(!isset($filteredSliders) || count($filteredSliders) === 0)
            <div class="bg-white p-12 border rounded-2xl text-center text-gray-400">لا توجد لافتات سلايدر مطابقة لخيارات العرض حالياً</div>
        @else
            @foreach($filteredSliders as $index => $slide)
                <div class="bg-white border rounded-2xl p-4 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between {{ $slide['archived'] ? 'opacity-60 bg-gray-50' : '' }}">
                    
                    <div class="flex flex-col md:flex-row items-center gap-4 flex-1 min-w-0 w-full">
                        <div class="w-32 h-16 rounded-xl bg-slate-900 overflow-hidden shrink-0 border border-gray-200">
                            <img src="{{ $slide['image'] }}" class="w-full h-full object-cover opacity-80" alt="slide photo"
                                 onError="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iMzAiIHk9IjIwIiBmb250LXNpemU9IjgiIGZpbGw9IiM5Y2EzYWYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7YqtmFINin2YQ8L3RleHQ+PC9zdmc+'">
                        </div>
                        <div class="space-y-1 text-center md:text-right flex-1 min-w-0 w-full">
                            <div class="flex items-center justify-center md:justify-start gap-2 flex-wrap">
                                <h4 class="font-bold text-gray-800 text-sm leading-tight truncate">{{ $slide['title'] ?: 'لافتة ترحيبية' }}</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ ($slide['active'] ?? true) ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                                    {{ ($slide['active'] ?? true) ? 'مفعّل حالياً' : 'تعطيل مؤقت' }}
                                </span>
                            </div>
                            <p class="text-gray-400 font-medium text-xs truncate">{{ $slide['subtitle'] }}</p>
                            <p class="text-gray-400 text-[10px] font-mono">ترتيب العرض الكلي: <span class="text-[#610000] font-bold font-sans">{{ $slide['sortOrder'] }}</span></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-1 shrink-0 border-t md:border-t-0 pt-2 md:pt-0 w-full md:w-auto justify-center">
                        <form action="?view=sliders" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="action" value="move_slider">
                            <input type="hidden" name="id" value="{{ $slide['id'] }}">
                            <input type="hidden" name="direction" value="up">
                            <button type="submit" {{ $index === 0 ? 'disabled' : '' }} class="p-2 border rounded-lg hover:bg-slate-50 disabled:opacity-30" title="نقل لأعلى"><i data-lucide="arrow-up" class="w-4 h-4"></i></button>
                        </form>
                        <form action="?view=sliders" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="action" value="move_slider">
                            <input type="hidden" name="id" value="{{ $slide['id'] }}">
                            <input type="hidden" name="direction" value="down">
                            <button type="submit" {{ $index === count($filteredSliders)-1 ? 'disabled' : '' }} class="p-2 border rounded-lg hover:bg-slate-50 disabled:opacity-30" title="نقل لأسفل"><i data-lucide="arrow-down" class="w-4 h-4"></i></button>
                        </form>

                        <div class="w-px h-6 bg-gray-200 mx-1"></div>

                        <a href="{{ $slide['image'] }}" target="_blank" class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg" title="عرض رابط الصورة السحابي"><i data-lucide="external-link" class="w-4 h-4"></i></a>

                        <button onclick="openEditSliderModal({{ json_encode($slide) }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg" title="تعديل السلايدر"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                        
                        <form action="?view=sliders&archived={{ $showArchived ? 'true':'false' }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="action" value="toggle_archive_slider">
                            <input type="hidden" name="id" value="{{ $slide['id'] }}">
                            <input type="hidden" name="target_state" value="{{ $slide['archived'] ? 'false' : 'true' }}">
                            <button type="submit" class="p-2 {{ $slide['archived'] ? 'text-emerald-600 hover:bg-emerald-50' : 'text-amber-500 hover:bg-amber-50' }} rounded-lg" title="{{ $slide['archived'] ? 'استعادة السلايدر للواجهة' : 'نقل للأرشيف الجانبي' }}">
                                <i data-lucide="{{ $slide['archived'] ? 'archive-restore' : 'archive' }}" class="w-4 h-4"></i>
                            </button>
                        </form>

                        <form action="?view=sliders" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف لافتة السلايدر نهائياً من سيرفر المدرسة السحابي؟')">
                            @csrf
                            <input type="hidden" name="action" value="delete_slider">
                            <input type="hidden" name="id" value="{{ $slide['id'] }}">
                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </form>
                    </div>

                </div>
            @endforeach
        @endif
    </div>
</div>

<div id="edit-slider-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl max-w-lg w-full p-5 shadow-2xl border text-xs space-y-4 font-semibold animate-fade-in" dir="rtl">
        <div class="flex items-center justify-between border-b pb-2">
            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5"><i data-lucide="edit" class="w-4 h-4 text-blue-500"></i> تعديل بيانات لافتة السلايدر الرئيسي</h3>
            <button onclick="closeEditSliderModal()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-4 h-4"></i></button>
        </div>
        
        <form action="?view=sliders" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="action" value="save_slider">
            <input type="hidden" id="edit-slide-id" name="id" value="">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1">العنوان الرئيسي</label>
                    <input type="text" id="edit-slide-title" name="title" required class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">العنوان الفرعي</label>
                    <input type="text" id="edit-slide-subtitle" name="subtitle" required class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none">
                </div>
            </div>

            <div>
                <label class="text-gray-600 block mb-1">رابط الصورة السحابي الحالي (أو تعديل يدوي)</label>
                <input type="text" id="edit-slide-url" name="direct_url" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none font-mono text-gray-500" dir="ltr">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600 block mb-1">ترتيب العرض</label>
                    <input type="number" id="edit-slide-sort" name="sortOrder" class="w-full h-11 px-3 border bg-gray-50 rounded-xl focus:outline-none">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">حالة التفعيل للطلاب</label>
                    <select id="edit-slide-active" name="active" class="w-full h-11 px-2 border bg-gray-50 rounded-xl focus:outline-none">
                        <option value="1">مفعّل (يظهر في السلايدر الخارجي)</option>
                        <option value="0">معطّل مؤقتاً (مخفي في الإدارة)</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t">
                <button type="button" onclick="closeEditSliderModal()" class="h-10 px-4 border rounded-xl hover:bg-gray-50">إلغاء الأمر</button>
                <button type="submit" class="h-10 px-5 bg-blue-600 text-white rounded-xl shadow-md">تثبيت وتأكيد التعديلات السحابية</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditSliderModal(item) {
        document.getElementById('edit-slide-id').value = item.id;
        document.getElementById('edit-slide-title').value = item.title || '';
        document.getElementById('edit-slide-subtitle').value = item.subtitle || '';
        document.getElementById('edit-slide-url').value = item.image;
        document.getElementById('edit-slide-sort').value = item.sortOrder;
        document.getElementById('edit-slide-active').value = item.active ? "1" : "0";
        document.getElementById('edit-slider-modal').classList.remove('hidden');
    }
    function closeEditSliderModal() { document.getElementById('edit-slider-modal').classList.add('hidden'); }
</script>