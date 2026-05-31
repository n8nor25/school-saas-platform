<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة نتائج الطلاب الإلكترونية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap');
        body { font-family: 'Cairo', sans-serif; }
        .glass-effect { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
        .num { font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif; font-variant-numeric: tabular-nums; direction: ltr; unicode-bidi: bidi-override; display: inline-block; }
        .num-input { direction: ltr; text-align: center; unicode-bidi: bidi-override; }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-gray-800">

    <header class="bg-gradient-to-r from-[#1E293B] to-[#2A374E] text-white shadow-xl sticky top-0 z-50">
        <div class="container mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-amber-500 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <i data-lucide="graduation-cap" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-tight">بوابة نتائج الطلاب الإلكترونية</h1>
                    <p class="text-slate-300 text-xs font-semibold">المنصة الرسمية المعتمدة للاستعلام عن الشهادات</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold bg-white/10 px-4 h-9 flex items-center rounded-xl text-blue-200 border border-white/10 shadow-sm">
                    <i data-lucide="school" class="w-3.5 h-3.5 ml-1.5 text-amber-400"></i>
                    الفرع الحالي: مدرسة الأجاويد
                </span>
            </div>
        </div>
    </header>

    <main class="flex-1 container mx-auto px-4 py-12 max-w-4xl space-y-12">
        
        <div class="relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-[#610000] via-[#2A374E] to-amber-500 rounded-3xl blur opacity-25"></div>
            <div class="relative bg-white/90 border border-slate-100 shadow-2xl rounded-3xl overflow-hidden glass-effect">
                <div class="h-2 bg-gradient-to-r from-[#2A374E] via-[#610000] to-amber-500"></div>
                
                <div class="p-8 md:p-10 space-y-8">
                    <div class="text-center max-w-md mx-auto space-y-2">
                        <div class="w-16 h-16 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-2 shadow-inner group">
                            <i data-lucide="search-check" class="w-8 h-8 text-[#2A374E] group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h2 class="text-2xl font-black text-[#1E293B]">استعلم عن نتيجتك فوراً</h2>
                        <p class="text-gray-500 text-xs font-medium">الرجاء اختيار الصف الدراسي وتدوين رقم الجلوس بدقة للوصول للوثيقة الرسمية</p>
                    </div>

                    <form action="{{ route('student.search', ['tenant' => $tenant]) }}" method="POST" class="space-y-6 max-w-lg mx-auto">
                        @csrf
                        
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-700 flex items-center gap-1.5">
                                <i data-lucide="layers" class="w-4 h-4 text-gray-400"></i> اختر المرحلة والصف الدراسي
                            </label>
                            <div class="relative">
                                <select name="grade_id" class="w-full h-12 px-4 bg-slate-50 hover:bg-slate-100/70 border border-gray-200 rounded-2xl text-right text-xs font-bold focus:outline-none focus:border-[#2A374E] focus:ring-4 focus:ring-blue-500/10 transition-all appearance-none cursor-pointer" required>
                                    <option value="">-- انقر لتصفح الصفوف المتاحة --</option>
                                    @foreach($gradeOptions as $value => $label)
                                        <option value="{{ $value }}" {{ old('grade_id') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <i data-lucide="chevron-down" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-700 flex items-center gap-1.5">
                                <i data-lucide="binary" class="w-4 h-4 text-gray-400"></i> رقم جلوس الطالب
                            </label>
                            <div class="relative">
                                <input type="text" name="search_query" value="{{ old('search_query') }}" placeholder="اكتب رقم الجلوس المكتوب بملفك الدراسي..." class="w-full h-12 text-right text-base pr-4 pl-12 bg-slate-50 hover:bg-slate-100/70 border border-gray-200 rounded-2xl focus:outline-none focus:border-[#2A374E] focus:ring-4 focus:ring-blue-500/10 font-bold text-[#2A374E] transition-all num-input" required>
                                <i data-lucide="hash" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 pt-2">
                            <button type="submit" class="flex-1 h-12 text-sm font-extrabold bg-gradient-to-r from-[#2A374E] to-[#1E293B] hover:from-[#1E293B] hover:to-[#2A374E] text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-[0.98]">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                <span>عرض تفاصيل درجات الشهادة</span>
                            </button>
                            
                            <button type="button" onclick="clearSearchWindow()" class="h-12 px-6 border border-gray-200 hover:bg-slate-50 text-gray-500 hover:text-gray-700 font-bold rounded-2xl transition-all text-xs flex items-center justify-center gap-1.5">
                                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                                <span>مسح وبدء جديد</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- رسالة الخطأ --}}
        @if($searched && $error)
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl flex items-center gap-3 font-bold">
                <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                <span class="text-xs">{{ $error }}</span>
            </div>
        @endif

        {{-- بطاقة النتيجة --}}
        @if($studentResult)
            <div class="bg-white border shadow-2xl rounded-3xl overflow-hidden relative">
                <div class="bg-gradient-to-br from-[#2A374E] to-[#1E293B] p-8 text-white relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <div class="flex items-start justify-between flex-wrap gap-4 relative z-10">
                        <div class="space-y-1.5">
                            <span class="bg-amber-400 text-slate-900 text-[10px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">وثيقة درجات معتمدة</span>
                            <h3 class="text-2xl font-black tracking-tight text-white">{{ $studentResult['studentName'] }}</h3>
                            <div class="flex flex-wrap items-center gap-3 text-slate-300 text-xs font-semibold">
                                <span class="flex items-center gap-1"><i data-lucide="award" class="w-3.5 h-3.5 text-amber-400"></i> {{ $studentResult['gradeName'] }}</span>
                                <span>•</span>
                                <span>رقم الجلوس: <span class="text-amber-300 font-bold num">{{ $studentResult['seatNumber'] }}</span></span>
                                <span>•</span>
                                <span class="text-blue-200">{{ $studentResult['term'] }}</span>
                            </div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md border border-white/10 px-5 py-3 rounded-2xl text-center shadow-inner">
                            <p class="text-[10px] text-slate-300 font-bold mb-0.5">المجموع الكلي</p>
                            <p class="text-2xl font-black text-emerald-400 num tracking-tight">{{ $studentResult['total'] }} <span class="text-xs text-white/60 font-normal">درجة</span></p>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white space-y-6">
                    {{-- المواد الأساسية --}}
                    <div>
                        <h4 class="text-xs font-black text-gray-800 mb-3 flex items-center gap-1.5">
                            <i data-lucide="book-open" class="w-4 h-4 text-blue-500"></i>
                            المواد الأساسية (تُحسب في المجموع)
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            
                            <div class="bg-slate-50/60 p-4 rounded-2xl border border-slate-100 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-gray-700 block">اللغة العربية</span>
                                    <span class="text-[10px] text-gray-400 font-medium block">النهاية العظمى: 80</span>
                                </div>
                                <span class="text-lg font-black text-slate-800 num">{{ $studentResult['arabic'] }}</span>
                            </div>

                            <div class="bg-blue-50/40 p-4 rounded-2xl border border-blue-100 flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-extrabold text-blue-900 block">اللغة الإنجليزية</span>
                                    <span class="text-[10px] text-blue-400 font-medium block">النهاية العظمى: 60</span>
                                </div>
                                <span class="text-lg font-black text-blue-700 num">{{ $studentResult['english'] }}</span>
                            </div>

                            <div class="bg-slate-50/60 p-4 rounded-2xl border border-slate-100 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-gray-700 block">الدراسات الاجتماعية</span>
                                    <span class="text-[10px] text-gray-400 font-medium block">النهاية العظمى: 40</span>
                                </div>
                                <span class="text-lg font-black text-slate-800 num">{{ $studentResult['socialStudies'] }}</span>
                            </div>

                            {{-- جبر --}}
                            <div class="bg-cyan-50/40 p-4 rounded-2xl border border-cyan-100 flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-extrabold text-cyan-900 block">الجبر</span>
                                    <span class="text-[10px] text-cyan-400 font-medium block">جزء من الرياضيات</span>
                                </div>
                                <span class="text-lg font-black text-cyan-700 num">{{ $studentResult['algebra'] }}</span>
                            </div>

                            {{-- هندسة --}}
                            <div class="bg-cyan-50/40 p-4 rounded-2xl border border-cyan-100 flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-extrabold text-cyan-900 block">الهندسة</span>
                                    <span class="text-[10px] text-cyan-400 font-medium block">جزء من الرياضيات</span>
                                </div>
                                <span class="text-lg font-black text-cyan-700 num">{{ $studentResult['geometry'] }}</span>
                            </div>

                            {{-- رياضيات = جبر + هندسة --}}
                            <div class="bg-slate-50/60 p-4 rounded-2xl border border-slate-100 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-gray-700 block">الرياضيات</span>
                                    <span class="text-[10px] text-gray-400 font-medium block">جبر + هندسة = {{ $studentResult['algebra'] + $studentResult['geometry'] }}</span>
                                </div>
                                <span class="text-lg font-black text-slate-800 num">{{ $studentResult['math'] }}</span>
                            </div>

                            <div class="bg-slate-50/60 p-4 rounded-2xl border border-slate-100 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-gray-700 block">العلوم</span>
                                    <span class="text-[10px] text-gray-400 font-medium block">النهاية العظمى: 40</span>
                                </div>
                                <span class="text-lg font-black text-slate-800 num">{{ $studentResult['science'] }}</span>
                            </div>

                        </div>
                    </div>

                    {{-- المواد الإضافية (لا تضاف للمجموع) --}}
                    <div>
                        <h4 class="text-xs font-black text-gray-800 mb-3 flex items-center gap-1.5">
                            <i data-lucide="bookmark" class="w-4 h-4 text-purple-500"></i>
                            مواد إضافية (لا تُحسب في المجموع)
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                            <div class="bg-purple-50/30 p-4 rounded-2xl border border-purple-100/70 flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-purple-900 block">التربية الدينية</span>
                                    <span class="text-[10px] text-purple-400 font-semibold block">لا تضاف للمجموع</span>
                                </div>
                                <span class="text-base font-bold text-purple-700 num">{{ $studentResult['religion'] }}</span>
                            </div>

                            <div class="bg-purple-50/30 p-4 rounded-2xl border border-purple-100/70 flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-purple-900 block">التربية الفنية</span>
                                    <span class="text-[10px] text-purple-400 font-semibold block">لا تضاف للمجموع</span>
                                </div>
                                <span class="text-base font-bold text-purple-700 num">{{ $studentResult['art'] }}</span>
                            </div>

                            <div class="bg-purple-50/30 p-4 rounded-2xl border border-purple-100/70 flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <span class="text-xs font-bold text-purple-900 block">الحاسب الآلي</span>
                                    <span class="text-[10px] text-purple-400 font-semibold block">لا تضاف للمجموع</span>
                                </div>
                                <span class="text-base font-bold text-purple-700 num">{{ $studentResult['computer'] }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <footer class="bg-gradient-to-r from-[#1E293B] to-[#2A374E] text-white py-5 mt-auto border-t border-white/10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-slate-400 text-xs font-medium">جميع الحقوق محفوظة © {{ date('Y') }} - نظام الساس المتكامل لإدارة المدارس الذكية</p>
        </div>
    </footer>

    <script>
        if(typeof lucide !== 'undefined') lucide.createIcons();
        
        function clearSearchWindow() {
            document.querySelector('input[name="search_query"]').value = '';
            window.location.href = window.location.pathname;
        }
    </script>
</body>
</html>