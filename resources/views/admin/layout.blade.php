<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>@yield('title', 'إدارة المدرسة')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .num-en {
            unicode-bidi: bidi-override;
            direction: ltr;
        }
        body { font-family: 'Segoe UI', Tahoma, Arial, sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white flex flex-col shadow-xl">
        <!-- Logo / Header -->
        <div class="p-5 border-b border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    م
                </div>
                <div>
                    <p class="text-sm font-bold">{{ $adminUser['username'] ?? 'إدارة المدرسة' }}</p>
                    <p class="text-xs text-gray-400">{{ $tenant ?? 'school1' }} - إدارة المدرسة</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <a href="/{{ $tenant ?? '' }}/admin/dashboard?view=dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ ($view ?? '') === 'dashboard' ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>🏠</span>
                <span class="text-sm">الصفحة الرئيسية</span>
            </a>

            <a href="/{{ $tenant ?? '' }}/admin/dashboard?view=results"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ ($view ?? '') === 'results' ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>📊</span>
                <span class="text-sm">إضافة وعرض النتائج</span>
            </a>

            <a href="/{{ $tenant ?? '' }}/admin/dashboard?view=teachers"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ ($view ?? '') === 'teachers' ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>👨‍🏫</span>
                <span class="text-sm">إدارة المعلمين</span>
            </a>

            <a href="/{{ $tenant ?? '' }}/admin/dashboard?view=news"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ ($view ?? '') === 'news' ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>📰</span>
                <span class="text-sm">الأخبار والإعلانات</span>
            </a>

            <a href="/{{ $tenant ?? '' }}/admin/dashboard?view=settings"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ ($view ?? '') === 'settings' ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                <span>⚙️</span>
                <span class="text-sm">إعدادات المدرسة</span>
            </a>

            <div class="pt-4 border-t border-gray-700 mt-4">
                <a href="/{{ $tenant ?? '' }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors text-gray-300 hover:bg-gray-700">
                    <span>🌐</span>
                    <span class="text-sm">عرض الموقع</span>
                </a>
            </div>
        </nav>

        <!-- Stats Footer -->
        @if(isset($stats))
        <div class="p-4 border-t border-gray-700">
            <p class="text-xs text-gray-400 mb-2">إحصائيات سريعة</p>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div class="bg-gray-700 rounded-lg p-2 text-center">
                    <p class="text-gray-400">النتائج</p>
                    <p class="text-white font-bold num-en">{{ $stats['totalResults'] ?? 0 }}</p>
                </div>
                <div class="bg-gray-700 rounded-lg p-2 text-center">
                    <p class="text-gray-400">الطلاب</p>
                    <p class="text-white font-bold num-en">{{ $stats['totalStudents'] ?? 0 }}</p>
                </div>
                <div class="bg-gray-700 rounded-lg p-2 text-center">
                    <p class="text-gray-400">نشطة</p>
                    <p class="text-green-400 font-bold num-en">{{ $stats['activeResults'] ?? 0 }}</p>
                </div>
                <div class="bg-gray-700 rounded-lg p-2 text-center">
                    <p class="text-gray-400">مؤرشفة</p>
                    <p class="text-orange-400 font-bold num-en">{{ $stats['archivedResults'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        @endif
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b px-6 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-800">
                    @switch($view ?? 'dashboard')
                        @case('dashboard') 🏠 الصفحة الرئيسية @break
                        @case('results') 📊 إضافة وعرض نتائج @break
                        @case('teachers') 👨‍🏫 إدارة المعلمين @break
                        @case('news') 📰 الأخبار والإعلانات @break
                        @case('settings') ⚙️ إعدادات المدرسة @break
                        @default 🏠 الصفحة الرئيسية
                    @endswitch
                </h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">{{ $tenant ?? '' }}</span>
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                    <span class="text-red-600 text-sm font-bold">م</span>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-6">
            @switch($view ?? 'dashboard')
                @case('results')
                    @include('admin.parts.results')
                    @break
                @case('teachers')
                    <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400">
                        <div class="text-5xl mb-3">👨‍🏫</div>
                        <p class="text-lg">قريباً - إدارة المعلمين</p>
                    </div>
                    @break
                @case('news')
                    <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400">
                        <div class="text-5xl mb-3">📰</div>
                        <p class="text-lg">قريباً - الأخبار والإعلانات</p>
                    </div>
                    @break
                @case('settings')
                    <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400">
                        <div class="text-5xl mb-3">⚙️</div>
                        <p class="text-lg">قريباً - إعدادات المدرسة</p>
                    </div>
                    @break
                @case('dashboard')
                @default
                    <!-- Dashboard Stats -->
                    @if(isset($stats))
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white rounded-xl shadow-sm border p-5 text-center">
                            <div class="text-3xl mb-2">📊</div>
                            <p class="text-2xl font-bold text-gray-800 num-en">{{ $stats['totalResults'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">إجمالي النتائج</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border p-5 text-center">
                            <div class="text-3xl mb-2">👨‍🎓</div>
                            <p class="text-2xl font-bold text-gray-800 num-en">{{ $stats['totalStudents'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">إجمالي الطلاب</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border p-5 text-center">
                            <div class="text-3xl mb-2">✅</div>
                            <p class="text-2xl font-bold text-green-600 num-en">{{ $stats['activeResults'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">نتائج نشطة</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border p-5 text-center">
                            <div class="text-3xl mb-2">📦</div>
                            <p class="text-2xl font-bold text-orange-600 num-en">{{ $stats['archivedResults'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">نتائج مؤرشفة</p>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white rounded-xl shadow-sm border p-8 text-center text-gray-400">
                        <div class="text-5xl mb-3">🏫</div>
                        <p class="text-lg">مرحباً بك في لوحة تحكم المدرسة</p>
                        <p class="text-sm mt-2">استخدم القائمة الجانبية للتنقل</p>
                    </div>
                    @break
            @endswitch
        </div>
    </main>

</div>

</body>
</html>