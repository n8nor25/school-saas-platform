<div class="space-y-4 text-xs font-semibold animate-fade-in">
    
    <div class="flex justify-between items-center bg-white p-4 rounded-2xl border shadow-sm flex-wrap gap-2">
        <h2 class="text-sm font-bold text-[#1a1a2e] flex items-center gap-2">
            <i data-lucide="newspaper" class="w-4 h-4 text-[#610000]"></i>
            إدارة سجلات الأخبار والإعلانات المدرسية السحابية
        </h2>
        <div class="flex items-center gap-2 font-bold">
            <button onclick="location.href='?view=news&archived={{ $showArchived ? 'false' : 'true' }}'" class="h-9 px-3 border rounded-xl flex items-center gap-1.5 transition-all {{ $showArchived ? 'bg-amber-600 text-white border-amber-600 shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="archive" class="w-4 h-4"></i>
                <span>{{ $showArchived ? 'إخفاء الأرشيف' : 'عرض أرشيف الأخبار' }}</span>
                @if(isset($archivedCount) && $archivedCount > 0 && !$showArchived)
                    <span class="bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded-full text-[10px]">{{ $archivedCount }}</span>
                @endif
            </button>
            <button onclick="openNewsModal()" class="h-9 px-4 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl flex items-center gap-1 shadow-sm transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>إضافة خبر جديد</span>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
        @if(!isset($filteredNews) || count($filteredNews) === 0)
            <div class="text-center py-12 space-y-2">
                <i data-lucide="alert-circle" class="w-12 h-12 mx-auto text-gray-300"></i>
                <p class="text-gray-400 text-xs font-bold">{{ $showArchived ? 'لا توجد أخبار مؤرشفة حالياً في نظام المدرسة' : 'لا توجد أخبار منشورة حالياً في المنصة التعليمية' }}</p>
            </div>
        @else
            <div class="divide-y divide-gray-100 text-xs">
                @foreach($filteredNews as $item)
                    <div class="p-4 flex items-start justify-between gap-4 hover:bg-slate-50/60 transition-colors {{ $item['archived'] ? 'bg-gray-50/50 opacity-60' : '' }}">
                        <div class="flex items-start gap-3 min-w-0 flex-1">
                            <div class="w-16 h-12 rounded-xl bg-slate-100 border overflow-hidden shrink-0 text-gray-400 flex items-center justify-center">
                                <img src="{{ $item['image'] ?? 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjIj48L3N2Zz4=' }}" class="w-full h-full object-cover" onError="this.style.display='none'">
                                <i data-lucide="newspaper" class="w-4 h-4 text-gray-300 absolute"></i>
                            </div>
                            
                            <div class="space-y-1 min-w-0 flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h4 class="font-bold text-gray-800 text-sm leading-normal truncate">{{ $item['title'] }}</h4>
                                    <span class="px-2 py-0.5 rounded text-[9px] font-bold border {{ $item['active'] ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $item['active'] ? 'علني ومنشور' : 'مسودة مخفية' }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-400 font-semibold text-[10px]">
                                    <span class="border px-1.5 py-0.5 rounded bg-gray-50 text-[#610000] border-red-100">{{ $item['category'] }}</span>
                                    <span><i data-lucide="calendar" class="w-3 h-3 inline ml-0.5"></i> {{ $item['date'] ?? date('Y-m-d') }}</span>
                                </div>
                                @if(isset($item['excerpt']) && $item['excerpt'])
                                    <p class="text-gray-500 leading-relaxed text-xs pt-0.5 truncate">{{ $item['excerpt'] }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-0.5 shrink-0">
                            @if($item['archived'])
                                <form action="?view=news&archived=true" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="restore">
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg" title="استعادة واجهة العرض"><i data-lucide="archive-restore" class="w-4 h-4"></i></button>
                                </form>
                            @else
                                <form action="?view=news&archived=false" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="archive">
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg" title="نقل للأرشيف"><i data-lucide="archive" class="w-4 h-4"></i></button>
                                </form>
                            @endif

                            <button onclick="openNewsModal({{ json_encode($item) }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg" title="تعديل محتوى الخبر"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                            <button onclick="triggerDelete('{{ $item['id'] }}')" class="p-2 text-red-500 hover:bg-red-50 rounded-lg" title="حذف نهائي"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="news-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full p-5 shadow-2xl border text-xs space-y-4 font-semibold animate-fade-in" dir="rtl">
            <div class="flex items-center justify-between border-b pb-2">
                <h3 id="modal-title" class="text-sm font-bold text-gray-800">إضافة خبر أو قرار جديد للمنصة</h3>
                <button onclick="closeNewsModal()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            
            <form action="?view=news&archived={{ $showArchived?'true':'false' }}" method="POST" enctype="multipart/form-data" class="space-y-3 font-semibold">
                @csrf
                <input type="hidden" name="action" value="save">
                <input type="hidden" id="form-id" name="id" value="">

                <div>
                    <label class="text-gray-600 block mb-1">عنوان الخبر الرئيسي *</label>
                    <input type="text" id="form-title" name="title" required placeholder="أدخل عنوان الخبر بوضوح..." class="w-full h-10 px-3 bg-gray-50 border rounded-xl text-xs focus:outline-none focus:border-[#610000]">
                </div>
                <div>
                    <label class="text-gray-600 block mb-1">ملخص موجز للخبر</label>
                    <input type="text" id="form-excerpt" name="excerpt" placeholder="اكتب ملخصاً سرياً وجذاباً..." class="w-full h-10 px-3 bg-gray-50 border rounded-xl text-xs focus:outline-none focus:border-[#610000]">
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-slate-50/60 p-2.5 border rounded-xl">
                    <div>
                        <label class="text-gray-500 block mb-1 font-bold">رفع صورة الخبر (من جهازك)</label>
                        <input type="file" name="uploaded_file" accept="image/*" class="w-full h-9 p-1 bg-white border rounded-lg text-[11px] focus:outline-none">
                    </div>
                    <div>
                        <label class="text-gray-500 block mb-1 font-bold">أو ضع رابط الصورة مباشرة</label>
                        <input type="text" id="form-image-url" name="direct_url" placeholder="https://..." class="w-full h-9 px-2 bg-white border rounded-lg text-[11px] focus:outline-none font-mono" dir="ltr">
                    </div>
                </div>

                <div>
                    <label class="text-gray-600 block mb-1">تفاصيل ومحتوى القرار الكامل</label>
                    <textarea id="form-content" name="content" placeholder="اكتب الحيثيات والقرارات الكاملة والتعليمات هنا..." class="w-full h-20 p-3 bg-gray-50 border rounded-xl text-xs focus:outline-none focus:border-[#610000] resize-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-600 block mb-1">باب وتصنيف الإعلان</label>
                        <select id="form-category" name="category" class="w-full h-10 px-2 bg-gray-50 border rounded-xl text-xs focus:outline-none">
                            <option value="أخبار">أخبار المدرسة</option>
                            <option value="تنبيه">تنبيهات وإعلانات عاجلة</option>
                            <option value="فعاليات">فعاليات وأنشطة طلابية</option>
                            <option value="نتائج">شؤون الامتحانات</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-600 block mb-1">حالة ظهور الخبر للطلاب</label>
                        <select id="form-active" name="active" class="w-full h-10 px-2 bg-gray-50 border rounded-xl text-xs focus:outline-none">
                            <option value="1">منشور علني (يعرض فوراً بالموقع)</option>
                            <option value="0">مسودة مغلقة (حفظ مؤقت في الإدارة)</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t">
                    <button type="button" onclick="closeNewsModal()" class="h-10 px-4 border rounded-xl hover:bg-gray-50 transition-colors">إلغاء</button>
                    <button type="submit" class="h-10 px-5 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl shadow-md transition-colors">حفظ وتأكيد نشر الخبر</button>
                </div>
            </form>
        </div>
    </div>

    <div id="delete-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl text-center text-xs space-y-4">
            <div class="w-12 h-12 bg-red-50 text-red-600 flex items-center justify-center rounded-full mx-auto"><i data-lucide="alert-triangle" class="w-6 h-6"></i></div>
            <div>
                <h3 class="text-sm font-bold text-gray-800">تأكيد عملية الحذف النهائي للخبر</h3>
                <p class="text-gray-400 mt-1 leading-relaxed">هل أنت متأكد من مسح السجل الدراسي لهذا الخبر نهائياً من النظام؟ لا يمكن التراجع عن هذا الإجراء.</p>
            </div>
            <form action="?view=news&archived={{ $showArchived?'true':'false' }}" method="POST" class="flex gap-2 justify-center">
                @csrf
                <input type="hidden" name="action" value="delete">
                <input type="hidden" id="delete-id" name="id" value="">
                <button type="button" onclick="closeDeleteModal()" class="h-10 px-4 border rounded-xl hover:bg-gray-50 font-bold">إلغاء الأمر</button>
                <button type="submit" class="h-10 px-5 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow-md font-bold">نعم، احذف السجل</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openNewsModal(item = null) {
        const modal = document.getElementById('news-modal');
        const title = document.getElementById('modal-title');
        const formId = document.getElementById('form-id');
        const formTitle = document.getElementById('form-title');
        const formExcerpt = document.getElementById('form-excerpt');
        const formContent = document.getElementById('form-content');
        const formCategory = document.getElementById('form-category');
        const formActive = document.getElementById('form-active');
        const formImageUrl = document.getElementById('form-image-url');

        if (item) {
            title.innerText = "تعديل محتوى الخبر وتحديث السحابة";
            formId.value = item.id;
            formTitle.value = item.title;
            formExcerpt.value = item.excerpt || '';
            formContent.value = item.content || '';
            formCategory.value = item.category;
            formActive.value = item.active ? "1" : "0";
            formImageUrl.value = item.image || '';
        } else {
            title.innerText = "إضافة خبر أو قرار جديد للمنصة";
            formId.value = "";
            formTitle.value = "";
            formExcerpt.value = "";
            formContent.value = "";
            formCategory.value = "أخبار";
            formActive.value = "1";
            formImageUrl.value = "";
        }
        modal.classList.remove('hidden');
    }
    function closeNewsModal() { document.getElementById('news-modal').classList.add('hidden'); }
    function triggerDelete(id) {
        document.getElementById('delete-id').value = id;
        document.getElementById('delete-modal').classList.remove('hidden');
    }
    function closeDeleteModal() { document.getElementById('delete-modal').classList.add('hidden'); }
</script>