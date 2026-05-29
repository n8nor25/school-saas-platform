<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الإدارة - نظام الساس المدرسي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white border-b h-16 flex items-center justify-between px-6 sticky top-0 z-40 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-[#610000] rounded-xl flex items-center justify-center shadow-md">
                <i data-lucide="shield-check" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <h1 class="text-sm font-bold text-gray-900">لوحة الإدارة الفائقة</h1>
                <p class="text-[10px] text-gray-400">مدرسة الأجاويد الحديثة - {{ $tenant }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-left hidden sm:block">
                <p class="text-xs font-bold text-gray-800">{{ $adminUser['username'] }}</p>
                <span class="text-[10px] bg-red-50 text-[#610000] px-2 py-0.5 rounded-full font-bold border border-red-100">مدير النظام</span>
            </div>
            <div class="w-10 h-10 bg-gradient-to-br from-slate-200 to-slate-300 rounded-full border-2 border-white shadow flex items-center justify-center font-bold text-gray-600">
                م ش
            </div>
        </div>
    </header>

    <div class="flex flex-1">
        <aside class="w-64 bg-[#1E293B] text-slate-300 flex flex-col sticky top-16 h-[calc(100vh-64px)] z-30 shadow-xl">
            <div class="p-4 border-b border-slate-700/50 bg-[#151f32]">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">قائمة الإدارة السريعة</p>
                <div class="text-xs text-emerald-400 flex items-center gap-1 font-bold">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    السيرفر المحلي متصل ومؤمن
                </div>
            </div>

            <nav class="flex-1 p-3 space-y-1 overflow-y-auto text-xs font-bold">
                <a href="?view=dashboard" class="flex items-center gap-2.5 px-3 h-11 rounded-xl transition-all {{ $currentView === 'dashboard' ? 'bg-[#610000] text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>الرئيسية والإحصائيات</span>
                </a>

                <a href="?view=results" class="flex items-center gap-2.5 px-3 h-11 rounded-xl transition-all {{ $currentView === 'results' ? 'bg-[#610000] text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                    <span>إدارة نتائج الامتحانات</span>
                </a>

                <a href="?view=teachers" class="flex items-center gap-2.5 px-3 h-11 rounded-xl transition-all {{ $currentView === 'teachers' ? 'bg-[#610000] text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>شؤون المعلمين</span>
                </a>

                <a href="?view=news" class="flex items-center gap-2.5 px-3 h-11 rounded-xl transition-all {{ $currentView === 'news' ? 'bg-[#610000] text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="newspaper" class="w-4 h-4"></i>
                    <span>أخبار ومستجدات المدرسة</span>
                </a>

                <div class="pt-4 border-t border-slate-700/50 my-2"></div>

                <a href="/{{ $tenant }}/search" target="_blank" class="flex items-center gap-2.5 px-3 h-11 rounded-xl bg-slate-800 text-blue-400 border border-slate-700/60 hover:bg-slate-700 transition-all">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    <span>بوابة استعلام الطلاب 🌐</span>
                </a>
            </nav>

            <div class="p-4 bg-[#151f32] border-t border-slate-700/50 text-center text-[11px] text-slate-400">
                إصدار النظام المطور v12.6
            </div>
        </aside>

        <main class="flex-1 p-6 overflow-y-auto max-w-[calc(100vh-256px)]">
            
            @if($currentView === 'dashboard')
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6 text-xs font-bold">
                    <div class="bg-white p-4 rounded-2xl border shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-gray-400 block">الكشوف المعتمدة</span>
                            <span class="text-2xl text-gray-800 font-mono font-bold">{{ $stats['resultsCount'] ?? 0 }} كشف</span>
                        </div>
                        <div class="w-11 h-11 bg-red-50 text-[#610000] rounded-xl flex items-center justify-center"><i data-lucide="file-check"></i></div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-gray-400 block">هيئة التدريس</span>
                            <span class="text-2xl text-gray-800 font-mono font-bold">{{ $stats['teachersCount'] ?? 0 }} معلم</span>
                        </div>
                        <div class="w-11 h-11 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="users"></i></div>
                    </div>
                    <div class="bg-white p-4 rounded-2xl border shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-gray-400 block">المقالات والأخبار</span>
                            <span class="text-2xl text-gray-800 font-mono font-bold">{{ $stats['newsCount'] ?? 0 }} خبر</span>
                        </div>
                        <div class="w-11 h-11 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center"><i data-lucide="text-quote"></i></div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border p-6 shadow-sm space-y-2">
                    <h2 class="text-base font-bold text-gray-800">مرحباً بك مجدداً يا هندسة بقاعدة البيانات السيادية 👋</h2>
                    <p class="text-gray-500 max-w-xl leading-relaxed text-xs">يمكنك من خلال القائمة الجانبية رفع كشوف الإكسيل ومزامنتها حياً ومباشرة مع شاشات الطلاب الخارجية فوراً وبأعلى معدلات الحماية المعمارية المتكاملة.</p>
                </div>
            @endif

            @if($currentView === 'results' || session()->has('live_multi_sheets') || session()->has('preview_grade'))
                @include('admin.parts.results')
            @endif

            @if($currentView === 'teachers')
                <div class="bg-white rounded-2xl border p-6 text-center text-gray-400">
                    <i data-lucide="users" class="w-12 h-12 mx-auto mb-2 text-gray-300"></i>
                    <p>لوحة شؤون المعلمين وأعضاء الكنترول المدرسي المعتمدين.</p>
                </div>
            @endif

        </main>
    </div>

    <script>
        // تفعيل الأيقونات الحركية المتجاوبة في كامل الـ Layout والأجزاء المستدعاة داخله
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>
</html>