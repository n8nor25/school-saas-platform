<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الحياة المدرسية - أدوات ومساعدات ذكية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;850;900&display=swap');
        body { font-family: 'Cairo', sans-serif; }
        
        .student-glow-card {
            box-shadow: 0 10px 30px -15px rgba(97, 0, 0, 0.12);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .student-glow-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -10px rgba(97, 0, 0, 0.22);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-gray-800">

    <header class="bg-[#2A374E] text-white shadow-xl sticky top-0 z-50 border-b-4 border-[#610000]">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                    <i data-lucide="graduation-cap" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black">بوابة الحياة المدرسية</h1>
                    <p class="text-blue-200 text-xs font-bold mt-0.5">أدوات ومساعدات دراسية تفاعلية مدعومة بالذكاء الاصطناعي</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 font-bold text-xs">
                <a href="/{{ $tenant }}" class="h-11 px-5 bg-[#610000] hover:bg-[#8a1414] text-white rounded-xl shadow transition-all flex items-center gap-1.5 transform active:scale-95">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>العودة للرئيسية 🌐</span>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 container mx-auto px-4 py-8 max-w-6xl space-y-8">
        
        <div class="mb-6 animate-fade-in-up">
            <div class="bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 p-0.5 rounded-3xl shadow-xl">
                <div class="bg-white rounded-[22px] p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-r from-amber-400 to-orange-500 flex items-center justify-center shrink-0 shadow-md">
                        <i data-lucide="star" class="w-7 h-7 text-white fill-white"></i>
                    </div>
                    <div class="space-y-1">
                        <div class="flex items-center gap-1">
                            <i data-lucide="zap" class="w-4 h-4 text-amber-500 fill-amber-500"></i>
                            <span class="text-xs font-black text-amber-600 tracking-wider">تحفيز اليوم المعتمد</span>
                        </div>
                        <p class="text-gray-900 text-lg md:text-xl font-black leading-relaxed tracking-wide">"{{ $motivation['text'] }}"</p>
                        <p class="text-gray-400 text-xs font-bold">— {{ $motivation['author'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 p-0.5 shadow-xl">
                <div class="relative bg-gray-900 rounded-[22px] p-6 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-right">
                        <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                            <i data-lucide="sparkles" class="w-5 h-5 text-purple-400 animate-pulse"></i>
                            <h2 class="text-xl font-black text-white tracking-wide">المساعد الذكي الفائق للدراسة NotebookLM</h2>
                        </div>
                        <p class="text-gray-300 text-xs md:text-sm max-w-xl leading-relaxed font-semibold">ارفع ملفاتك ومناهجك الدراسية ومشاريعك بصيغة PDF على مساعد جوجل الذكي، وناقشها واحصل على ملخصات فورية واختبارات تفاعلية ذكية مخصصة لك!</p>
                    </div>
                    <a href="https://notebooklm.google.com" target="_blank" class="bg-white text-gray-900 hover:bg-gray-100 font-extrabold px-6 h-11 rounded-xl text-xs flex items-center gap-1.5 transition-all shadow-md shrink-0">
                        <i data-lucide="external-link" class="w-4 h-4"></i> ابدأ الدراسة الذكية مجاناً
                    </a>
                </div>
            </div>
        </div>

        <div class="mb-8 bg-white p-6 rounded-3xl shadow-xl border border-gray-100/80">
            <div class="flex items-center justify-between mb-4 border-b pb-3">
                <h2 class="text-lg md:text-xl font-black text-[#2A374E] flex items-center gap-2">
                    <i data-lucide="bot" class="text-purple-600 w-6 h-6"></i>
                    المساعد التعليمي الذكي للمواد الدراسية
                </h2>
                <button onclick="clearChat()" class="text-xs font-bold border border-gray-200 hover:bg-red-50 hover:text-red-600 text-gray-500 px-4 py-2 rounded-xl flex items-center gap-1 transition-all shadow-sm">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> مسح المحادثة الحالية
                </button>
            </div>

            <div class="flex flex-wrap gap-2 mb-5">
                <button onclick="selectSubject('عام', this)" class="sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-gradient-to-r from-rose-500 to-rose-600 text-white shadow-md scale-105">💡 عام</button>
                <button onclick="selectSubject('الرياضيات', this)" class="sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-white text-gray-700 border hover:shadow-md">📐 الرياضيات</button>
                <button onclick="selectSubject('العلوم', this)" class="sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-white text-gray-700 border hover:shadow-md">🔬 العلوم</button>
                <button onclick="selectSubject('اللغة العربية', this)" class="sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-white text-gray-700 border hover:shadow-md">📝 اللغة العربية</button>
                <button onclick="selectSubject('اللغة الإنجليزية', this)" class="sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-white text-gray-700 border hover:shadow-md">🇬🇧 اللغة الإنجليزية</button>
            </div>

            <div class="bg-gray-50/50 rounded-2xl border border-gray-100 overflow-hidden flex flex-col h-[400px]">
                <div id="chat-box" class="flex-1 overflow-y-auto p-4 space-y-4">
                    <div id="welcome-msg" class="text-center py-10 space-y-3">
                        <div class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mx-auto shadow-lg animate-pulse"><i data-lucide="bot" class="w-7 h-7 text-white"></i></div>
                        <h4 class="font-black text-gray-700 text-base tracking-wide">مرحباً! أنا مساعدك الشخصي الذكي</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-w-xl mx-auto pt-2">
                            <button onclick="sendQuickQuestion('اشرح لي الكسور في الرياضيات')" class="p-2.5 text-right text-xs bg-white border font-bold rounded-xl text-gray-600 hover:bg-indigo-50 transition-colors shadow-sm">📐 اشرح لي الكسور في الرياضيات</button>
                            <button onclick="sendQuickQuestion('ما هي خصائص المادة؟')" class="p-2.5 text-right text-xs bg-white border font-bold rounded-xl text-gray-600 hover:bg-indigo-50 transition-colors shadow-sm">🔬 ما هي خصائص المادة؟</button>
                        </div>
                    </div>
                </div>

                <div class="p-3 border-t bg-white flex gap-2 items-center">
                    <input id="chat-input" type="text" placeholder="اكتب سؤالك العلمي المباشر هنا..." class="flex-1 h-11 px-4 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold focus:outline-none focus:border-purple-600">
                    <button onclick="handleSend()" class="h-11 px-5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black rounded-xl text-xs flex items-center justify-center gap-1.5 shadow-md">
                        <span>إرسال السؤال</span>
                        <i data-lucide="send" class="w-4 h-4 rotate-180"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <div class="flex items-center gap-2 mb-4 border-b pb-2">
                    <i data-lucide="calendar-days" class="text-red-500 w-5 h-5"></i>
                    <h3 class="text-base font-black text-[#2A374E] tracking-wide">العد التنازلي للامتحانات النهائية</h3>
                </div>
                <div class="grid grid-cols-4 gap-2.5 text-center">
                    <div class="bg-red-50 rounded-xl p-3"><div id="cd-days" class="text-2xl font-black text-red-600 font-mono">0</div><div class="text-[10px] text-gray-500 mt-0.5">يوم</div></div>
                    <div class="bg-orange-50 rounded-xl p-3"><div id="cd-hours" class="text-2xl font-black text-orange-600 font-mono">0</div><div class="text-[10px] text-gray-500 mt-0.5">ساعة</div></div>
                    <div class="bg-amber-50 rounded-xl p-3"><div id="cd-minutes" class="text-2xl font-black text-amber-600 font-mono">0</div><div class="text-[10px] text-gray-500 mt-0.5">دقيقة</div></div>
                    <div class="bg-yellow-50 rounded-xl p-3"><div id="cd-seconds" class="text-2xl font-black text-yellow-600 font-mono">0</div><div class="text-[10px] text-gray-500 mt-0.5">ثانية</div></div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="target" class="text-green-500 w-5 h-5"></i>
                        <h3 class="text-base font-black text-[#2A374E] tracking-wide">هدف المذاكرة اليومي والتحصيل</h3>
                    </div>
                    <span id="sessions-badge" class="bg-green-100 text-green-700 text-xs font-black px-3 py-0.5 rounded-full">0 جلسات</span>
                </div>
                <div class="mb-4 space-y-1.5">
                    <div class="flex justify-between text-xs text-gray-500 font-extrabold">
                        <span id="study-progress-text" class="text-gray-800 font-black">0 دقيقة</span>
                        <span>120 دقيقة</span>
                    </div>
                    <div class="w-full h-3.5 bg-gray-100 rounded-full overflow-hidden">
                        <div id="study-progress-bar" class="h-full bg-green-500" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8" id="tools-section">
            <h2 class="text-lg font-black text-[#2A374E] mb-4 flex items-center gap-2 border-r-4 border-red-500 pr-2.5">
                <i data-lucide="book-open" class="text-red-500 w-5 h-5"></i>
                أدوات دراسية ذكية ومساعدة للطلاب
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 font-bold">
                <div onclick="toggleTool('calculator')" class="student-glow-card bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100 cursor-pointer group flex flex-col justify-center min-h-[140px]">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white mb-3"><i data-lucide="calculator" class="w-6 h-6"></i></div>
                    <h3 class="font-black text-sm text-gray-800">آلة حاسبة علمية</h3>
                </div>
                <div onclick="toggleTool('pomodoro')" class="student-glow-card bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100 cursor-pointer group flex flex-col justify-center min-h-[140px]">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white mb-3"><i data-lucide="timer" class="w-6 h-6"></i></div>
                    <h3 class="font-black text-sm text-gray-800">مؤقت بومودورو للتركيز</h3>
                </div>
                <div onclick="toggleTool('tips')" class="student-glow-card bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100 cursor-pointer group flex flex-col justify-center min-h-[140px]">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 flex items-center justify-center text-white mb-3"><i data-lucide="lightbulb" class="w-6 h-6"></i></div>
                    <h3 class="font-black text-sm text-gray-800">أسرار ونصائح دراسية</h3>
                </div>
            </div>
        </div>

        <div id="panel-calculator" class="hidden bg-white rounded-2xl p-5 shadow-xl border border-gray-100 mb-8 max-w-sm mx-auto">
            <div class="flex items-center justify-between mb-3 border-b pb-2">
                <h4 class="font-bold text-sm text-gray-800 flex items-center gap-1"><i data-lucide="calculator" class="w-4 h-4 text-blue-500"></i> الآلة الحاسبة</h4>
                <button onclick="closeAllTools()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <input id="calc-screen" type="text" readonly class="w-full h-12 bg-gray-900 text-white font-mono text-left text-xl px-3 rounded-xl mb-3" value="0">
            <div class="grid grid-cols-4 gap-1.5 text-sm">
                <button onclick="pressCalc('C')" class="h-10 bg-red-100 text-red-600 font-bold rounded-lg">C</button>
                <button onclick="pressCalc('/')" class="h-10 bg-blue-50 text-blue-600 font-bold rounded-lg">/</button>
                <button onclick="pressCalc('*')" class="h-10 bg-blue-50 text-blue-600 font-bold rounded-lg">*</button>
                <button onclick="pressCalc('-')" class="h-10 bg-blue-50 text-blue-600 font-bold rounded-lg">-</button>
                <button onclick="pressCalc('7')" class="h-10 bg-gray-50 rounded-lg">7</button>
                <button onclick="pressCalc('8')" class="h-10 bg-gray-50 rounded-lg">8</button>
                <button onclick="pressCalc('9')" class="h-10 bg-gray-50 rounded-lg">9</button>
                <button onclick="pressCalc('+')" class="h-10 bg-blue-50 text-blue-600 font-bold rounded-lg">+</button>
                <button onclick="pressCalc('4')" class="h-10 bg-gray-50 rounded-lg">4</button>
                <button onclick="pressCalc('5')" class="h-10 bg-gray-50 rounded-lg">5</button>
                <button onclick="pressCalc('6')" class="h-10 bg-gray-50 rounded-lg">6</button>
                <button onclick="pressCalc('=')" class="h-10 bg-blue-600 text-white font-bold rounded-lg row-span-2">=</button>
                <button onclick="pressCalc('1')" class="h-10 bg-gray-50 rounded-lg">1</button>
                <button onclick="pressCalc('2')" class="h-10 bg-gray-50 rounded-lg">2</button>
                <button onclick="pressCalc('3')" class="h-10 bg-gray-50 rounded-lg">3</button>
                <button onclick="pressCalc('0')" class="h-10 bg-gray-50 rounded-lg col-span-2">0</button>
                <button onclick="pressCalc('.')" class="h-10 bg-gray-50 rounded-lg">.</button>
            </div>
        </div>

        <div id="panel-pomodoro" class="hidden bg-white rounded-2xl p-6 shadow-xl border border-gray-100 mb-8 max-w-sm mx-auto text-center">
            <div class="flex items-center justify-between mb-3 border-b pb-2">
                <h4 class="font-bold text-sm text-gray-800 text-right flex items-center gap-1"><i data-lucide="timer" class="w-4 h-4 text-green-500"></i> مؤقت المذاكرة والتركيز</h4>
                <button onclick="closeAllTools()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <span id="pomo-mode" class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full inline-block mb-3"> وقت التركيز والعمل 🕐</span>
            <div id="pomo-display" class="text-5xl font-mono font-bold text-gray-800 mb-4">25:00</div>
            <div class="flex justify-center gap-2">
                <button id="btn-pomo-start" onclick="togglePomodoro()" class="bg-green-600 text-white font-bold px-6 py-2 rounded-xl text-sm shadow-md">بدء المؤقت ▶️</button>
                <button onclick="resetPomodoro()" class="border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm">إعادة ضبط 🔄</button>
            </div>
        </div>

        <div id="panel-tips" class="hidden bg-white rounded-2xl p-5 shadow-xl border border-gray-100 mb-8">
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <h4 class="font-bold text-sm text-gray-800 flex items-center gap-1"><i data-lucide="lightbulb" class="w-4 h-4 text-amber-500"></i> أسرار المذاكرة الفعالة</h4>
                <button onclick="closeAllTools()" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                <div class="p-3 bg-amber-50/50 border border-amber-100 rounded-xl">
                    <h5 class="font-bold text-amber-800 mb-1">🍅 تقنية بومودورو للتركيز</h5>
                    <p class="text-gray-600 leading-relaxed text-xs">ذاكر بتركيز تام لمدة 25 دقيقة، ثم خذ راحة 5 دقائق. كررها لتشحن عقلك بكفاءة.</p>
                </div>
                <div class="p-3 bg-blue-50/50 border border-blue-100 rounded-xl">
                    <h5 class="font-bold text-blue-800 mb-1">🗣️ التعليم النشط والشرح</h5>
                    <p class="text-gray-600 leading-relaxed text-xs">اشرح الدرس لنفسك أو لزميلك بصوت عالٍ. إذا تمكنت من تبسيطه، فأنت فهمته تماماً.</p>
                </div>
            </div>
        </div>

        <div class="mb-8" id="platforms-section">
            <h2 class="text-lg font-black text-[#2A374E] mb-4 flex items-center gap-2 border-r-4 border-amber-400 pr-2.5">
                <i data-lucide="rocket" class="text-amber-500 w-5 h-5"></i>
                روابط ومنصات تعليمية رسمية ومفيدة للكنترول
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 text-sm font-bold">
                <a href="https://www.ekb.eg/" target="_blank" class="student-glow-card bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex items-center gap-3 group">
                    <div class="w-11 h-11 bg-gradient-to-r from-teal-500 to-cyan-500 text-white rounded-xl flex items-center justify-center shrink-0"><i data-lucide="file-text" class="w-5 h-5"></i></div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-black text-gray-800 text-xs truncate tracking-wide">بنك المعرفة المصري (EKB)</h4>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5 font-bold">أكبر مكتبة وموارد تعليمية وطنية</p>
                    </div>
                </a>
                <a href="https://www.khanacademy.org/" target="_blank" class="student-glow-card bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex items-center gap-3 group">
                    <div class="w-11 h-11 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0"><i data-lucide="book-open" class="w-5 h-5"></i></div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-black text-gray-800 text-xs truncate tracking-wide">أكاديمية خان العالمية</h4>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5 font-bold">شروحات ومسائل تفاعلية لكافة المواد</p>
                    </div>
                </a>
                <a href="https://notebooklm.google.com" target="_blank" class="student-glow-card bg-white rounded-2xl p-5 shadow-md border border-gray-100 flex items-center gap-3 group">
                    <div class="w-11 h-11 bg-gradient-to-br from-purple-500 to-pink-500 text-white rounded-xl flex items-center justify-center shrink-0"><i data-lucide="brain" class="w-5 h-5"></i></div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-black text-gray-800 text-xs truncate tracking-wide">NotebookLM الذكي</h4>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5 font-bold">مساعد جوجل لمناقشة وتلخيص الملفات</p>
                    </div>
                </a>
            </div>
        </div>

    </main>

    <footer class="bg-[#2A374E] text-white mt-auto border-t-4 border-[#610000] text-xs font-bold py-5">
        <div class="max-w-[1280px] mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-gray-300">
            <p>جميع الحقوق محفوظة © {{ date('Y') }} - نظام الـ SaaS لإدارة مدرسة الأجاويد الحديثة</p>
            <div class="flex items-center gap-4 text-slate-400">
                <a href="/{{ $tenant }}" class="hover:text-white transition-colors">الرئيسية للموقع 🌐</a>
                <span>•</span>
                <a href="/{{ $tenant }}/search" class="hover:text-white transition-colors">بوابة الاستعلام الإلكتروني</a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        let currentSubject = 'عام';
        const chatBox = document.getElementById('chat-box');
        const chatInput = document.getElementById('chat-input');
        const welcomeMsg = document.getElementById('welcome-msg');

        function selectSubject(subject, btn) {
            currentSubject = subject;
            document.querySelectorAll('.sub-btn').forEach(b => {
                b.className = "sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-white text-gray-700 border hover:shadow-md";
            });
            btn.className = "sub-btn px-4 py-2 rounded-full text-xs font-bold transition-all bg-[#2A374E] text-white shadow-md scale-105";
        }

        function appendMessage(sender, text) {
            if (welcomeMsg) welcomeMsg.style.display = 'none';

            const msgDiv = document.createElement('div');
            msgDiv.className = sender === 'user' ? 'flex justify-end animate-fade-in' : 'flex justify-start animate-fade-in';
            const time = new Date().toLocaleTimeString('ar-EG', { hour: '2-digit', minute: '2-digit' });

            msgDiv.innerHTML = `
                <div class="max-w-[85%] p-3.5 rounded-2xl text-sm leading-relaxed shadow-sm ${
                    sender === 'user' 
                    ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-br-sm' 
                    : 'bg-white text-gray-800 border rounded-bl-sm'
                }">
                    ${sender === 'bot' ? '<div class="text-[10px] font-bold text-purple-600 mb-1 flex items-center gap-1"><i data-lucide="bot" class="w-3.5 h-3.5"></i> المساعد الذكي</div>' : ''}
                    <div class="whitespace-pre-wrap">${text}</div>
                    <div class="text-[9px] text-left mt-1.5 opacity-60">${time}</div>
                </div>
            `;
            chatBox.appendChild(msgDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
            lucide.createIcons();
        }

        async function sendToAI(text) {
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typing-indicator';
            typingDiv.className = 'flex justify-start';
            typingDiv.innerHTML = `<div class="bg-white p-3 rounded-2xl border text-xs text-gray-400 flex items-center gap-1"><span class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-bounce"></span>جاري معالجة سؤالك وثواني للإجابة...</div>`;
            chatBox.appendChild(typingDiv);
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const response = await fetch("{{ route('student.life.chat', ['tenant' => $tenant]) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: text, subject: currentSubject })
                });
                const data = await response.json();
                document.getElementById('typing-indicator').remove();

                if (data.success) {
                    appendMessage('bot', data.response);
                } else {
                    appendMessage('bot', 'عذراً يا بطل، حدث خطأ في معالجة الإجابة، حاول مرة أخرى.');
                }
            } catch (e) {
                document.getElementById('typing-indicator').remove();
                appendMessage('bot', 'عذراً، لم أتمكن من الاتصال بالخادم الذكي. تأكد من اتصالك بالإنترنت.');
            }
        }

        function handleSend() {
            const query = chatInput.value.trim();
            if (!query) return;
            appendMessage('user', query);
            chatInput.value = '';
            sendToAI(query);
        }

        function sendQuickQuestion(text) {
            appendMessage('user', text);
            sendToAI(text);
        }

        function clearChat() {
            chatBox.innerHTML = '';
            if (welcomeMsg) welcomeMsg.style.display = 'block';
            chatBox.appendChild(welcomeMsg);
        }

        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') handleSend();
        });

        function updateExamCountdown() {
            const now = new Date();
            let examDate = new Date(now.getFullYear(), 5, 15);
            if (now > examDate) examDate = new Date(now.getFullYear() + 1, 5, 15);
            const diff = examDate - now;
            if (diff > 0) {
                document.getElementById('cd-days').innerText = Math.floor(diff / (1000 * 60 * 60 * 24));
                document.getElementById('cd-hours').innerText = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                document.getElementById('cd-minutes').innerText = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                document.getElementById('cd-seconds').innerText = Math.floor((diff % (1000 * 60)) / 1000);
            }
        }
        setInterval(updateExamCountdown, 1000);
        updateExamCountdown();

        function toggleTool(toolName) {
            closeAllTools();
            const targetPanel = document.getElementById('panel-' + toolName);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
                targetPanel.scrollIntoView({ behavior: 'smooth' });
            }
        }
        function closeAllTools() {
            document.getElementById('panel-calculator').classList.add('hidden');
            document.getElementById('panel-pomodoro').classList.add('hidden');
            document.getElementById('panel-tips').classList.add('hidden');
        }

        let calcScreen = document.getElementById('calc-screen');
        function pressCalc(val) {
            if (val === 'C') calcScreen.value = '0';
            else if (val === '=') {
                try {
                    let sanitized = calcScreen.value.replace(/[^0-9+\-*/.()]/g, '');
                    calcScreen.value = eval(sanitized);
                } catch (e) { calcScreen.value = 'خطأ'; }
            } else {
                if (calcScreen.value === '0' || calcScreen.value === 'خطأ') calcScreen.value = val;
                else calcScreen.value += val;
            }
        }

        let pomoMinutes = 25, pomoSeconds = 0, pomoInterval = null, pomoRunning = false, pomoMode = 'work', completedSessions = 0, totalMinutesStudied = 0;
        function updatePomoDisplay() {
            document.getElementById('pomo-display').innerText = `${pomoMinutes.toString().padStart(2, '0')}:${pomoSeconds.toString().padStart(2, '0')}`;
        }
        function togglePomodoro() {
            const btn = document.getElementById('btn-pomo-start');
            if (pomoRunning) {
                clearInterval(pomoInterval); pomoRunning = false; btn.innerText = 'استئناف ▶️';
            } else {
                pomoRunning = true; btn.innerText = 'إيقاف مؤقت ⏸';
                pomoInterval = setInterval(() => {
                    if (pomoSeconds === 0) {
                        if (pomoMinutes === 0) {
                            clearInterval(pomoInterval); pomoRunning = false;
                            if (pomoMode === 'work') {
                                completedSessions++; totalMinutesStudied += 25; pomoMode = 'break'; pomoMinutes = 5;
                                document.getElementById('pomo-mode').innerText = " وقت الراحة والاستراحة ☕";
                                document.getElementById('sessions-badge').innerText = `${completedSessions} جلسات`;
                                document.getElementById('study-progress-text').innerText = `${totalMinutesStudied} دقيقة`;
                                document.getElementById('study-progress-bar').style.width = Math.min((totalMinutesStudied / 120) * 100, 100) + '%';
                                document.getElementById('goal-status-text').innerText = totalMinutesStudied >= 120 ? "مذهل وممتاز! حققت هدفك الدراسي لليوم 🏆" : `بقي لك ${120 - totalMinutesStudied} دقيقة على الهدف.`;
                            } else { pomoMode = 'work'; pomoMinutes = 25; document.getElementById('pomo-mode').innerText = " وقت التركيز والعمل 1️⃣"; }
                            btn.innerText = 'بدء جلسة جديدة ▶️'; updatePomoDisplay(); return;
                        }
                        pomoMinutes--; pomoSeconds = 59;
                    } else pomoSeconds--;
                    updatePomoDisplay();
                }, 1000);
            }
        }
        function resetPomodoro() {
            clearInterval(pomoInterval); pomoRunning = false; pomoMode = 'work'; pomoMinutes = 25; pomoSeconds = 0;
            document.getElementById('btn-pomo-start').innerText = 'بدء المؤقت ▶️'; updatePomoDisplay();
        }
    </script>
</body>
</html>