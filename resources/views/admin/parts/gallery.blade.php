<div class="space-y-6 text-xs font-semibold animate-fade-in">
    
    <div class="bg-white rounded-2xl border p-5 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
            <i data-lucide="plus-circle" class="text-emerald-500 w-4 h-4"></i>
            رفع صورة جديدة لألبومات الأنشطة والفعاليات المدرسية
        </h3>
        
        <form action="?view=gallery" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="action" value="add_gallery">
            
            <div>
                <label class="text-gray-600 block mb-1">عنوان وتفاصيل الحدث المصور (اختياري)</label>
                <input type="text" name="title" placeholder="عنوان الصورة أو الفعالية..." class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none focus:border-[#610000]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-3 bg-emerald-50/40 border border-emerald-100 rounded-xl space-y-1.5">
                    <label class="text-emerald-800 block font-bold">الخيار الأول: رفع ملف من جهازك</label>
                    <input type="file" name="uploaded_file" accept="image/*" class="w-full h-10 p-1 bg-white border rounded-lg text-xs focus:outline-none">
                </div>
                
                <div class="p-3 bg-blue-50/40 border border-blue-100 rounded-xl space-y-1.5">
                    <label class="text-blue-800 block font-bold">الخيار الثاني: الصق رابط الصورة جاهزاً</label>
                    <input type="text" name="direct_url" placeholder="https://res.cloudinary.com/..." class="w-full h-10 px-3 bg-white border rounded-lg text-xs focus:outline-none font-mono" dir="ltr">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="h-11 px-6 bg-[#610000] hover:bg-[#8B0000] text-white rounded-xl font-bold flex items-center gap-1 shadow-sm"><i data-lucide="upload-cloud" class="w-4 h-4"></i> رفع ونشر الصورة</button>
            </div>
        </form>
    </div>

    <div class="bg-white border rounded-2xl p-5 shadow-sm space-y-4">
        <div class="flex justify-between items-center border-b pb-2 flex-wrap gap-2">
            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1.5">
                <i data-lucide="images" class="text-[#610000] w-4 h-4"></i>
                ألبومات وصور المعرض المعتمد
            </h3>
            <button onclick="location.href='?view=gallery&archived={{ $showArchived ? 'false' : 'true' }}'" class="h-9 px-3 border rounded-xl flex items-center gap-1.5 {{ $showArchived ? 'bg-amber-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="archive" class="w-4 h-4"></i>
                <span>{{ $showArchived ? 'إخفاء الأرشيف' : 'عرض أرشيف الصور' }}</span>
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @if(!isset($filteredGallery) || count($filteredGallery) === 0)
                <div class="col-span-full text-center py-8 text-gray-400">لا توجد صور مطابقة للعرض حالياً</div>
            @else
                @foreach($filteredGallery as $gal)
                    <div class="group relative aspect-square rounded-xl overflow-hidden shadow-sm border bg-slate-100 flex flex-col justify-between {{ $gal['archived'] ? 'opacity-60 grayscale-[20%]' : '' }}">
                        <img src="{{ $gal['image'] }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500" alt="Gallery Photo" onError="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2YzZjRmNiIvPjx0ZXh0IHg9IjEwMCIgeT0iMTAwIiBmb250LXNpemU9IjE0IiBmaWxsPSIjOWNhM2FmIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+8J+TgCDYqtmFINi12YjYsdipPC90ZXh0Pjwvc3ZnPg=='">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 space-y-2">
                            @if($gal['title'])
                                <p class="text-white text-xs font-bold truncate mb-1">{{ $gal['title'] }}</p>
                            @endif
                            
                            <div class="grid grid-cols-2 gap-1.5">
                                <button onclick="openEditGalleryModal({{ json_encode($gal) }})" class="h-8 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center gap-0.5 font-bold text-[10px]"><i data-lucide="edit-2" class="w-3 h-3"></i> تعديل</button>
                                
                                <form action="?view=gallery" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="toggle_archive_gallery">
                                    <input type="hidden" name="id" value="{{ $gal['id'] }}">
                                    <input type="hidden" name="target_state" value="{{ $gal['archived'] ? 'false' : 'true' }}">
                                    <button type="submit" class="w-full h-8 {{ $gal['archived'] ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-amber-500 hover:bg-amber-600' }} text-white rounded-lg flex items-center justify-center gap-0.5 font-bold text-[10px]">
                                        <i data-lucide="{{ $gal['archived'] ? 'archive-restore' : 'archive' }}" class="w-3 h-3"></i> {{ $gal['archived'] ? 'استعادة' : 'أرشفة' }}
                                    </button>
                                </form>
                            </div>

                            <form action="?view=gallery" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف النهائي للحدث؟')">
                                @csrf
                                <input type="hidden" name="action" value="delete_gallery">
                                <input type="hidden" name="id" value="{{ $gal['id'] }}">
                                <button type="submit" class="w-full h-8 bg-red-600 hover:bg-red-700 text-white rounded-lg flex items-center justify-center gap-1 font-bold text-[10px]"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i> حذف نهائي</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div id="edit-gallery-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl max-w-md w-full p-5 shadow-2xl border text-xs space-y-4 font-semibold animate-fade-in">
        <div class="flex items-center justify-between border-b pb-2">
            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-1"><i data-lucide="edit" class="w-4 h-4 text-blue-500"></i> تعديل بيانات الصورة السحابية</h3>
            <button onclick="closeEditGalleryModal()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-4 h-4"></i></button>
        </div>
        <form action="?view=gallery" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="action" value="update_gallery_data">
            <input type="hidden" id="edit-gal-id" name="id" value="">
            <div>
                <label class="text-gray-600 block mb-1">تحديث عنوان الحدث</label>
                <input type="text" id="edit-gal-title" name="title" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none">
            </div>
            <div>
                <label class="text-gray-600 block mb-1">رابط الصورة الحالي أو تعديل يدوي</label>
                <input type="text" id="edit-gal-url" name="direct_url" class="w-full h-11 px-3 border bg-gray-50 rounded-xl text-xs focus:outline-none font-mono" dir="ltr">
            </div>
            <div class="flex justify-end gap-2 pt-2 border-t">
                <button type="button" onclick="closeEditGalleryModal()" class="h-10 px-4 border rounded-xl hover:bg-gray-50">إلغاء</button>
                <button type="submit" class="h-10 px-5 bg-blue-600 text-white rounded-xl shadow-md">تثبيت وحفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditGalleryModal(item) {
        document.getElementById('edit-gal-id').value = item.id;
        document.getElementById('edit-gal-title').value = item.title || '';
        document.getElementById('edit-gal-url').value = item.image;
        document.getElementById('edit-gallery-modal').classList.remove('hidden');
    }
    function closeEditGalleryModal() { document.getElementById('edit-gallery-modal').classList.add('hidden'); }
</script>