<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentResultController;
use App\Http\Controllers\StudentLifeController;
use App\Http\Controllers\SchoolHomeController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية للموقع المركزي
Route::get('/', function () {
    return view('welcome');
});

// مسار البوابة الرئيسية للمدرسة
Route::get('/{tenant}', [SchoolHomeController::class, 'index'])->name('school.home');

// مسار بحث واستعلام نتائج الطلاب
// تأكد من وجود كلا السطرين أو استخدام Route::any
Route::get('/{tenant}/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::post('/{tenant}/admin/dashboard', [AdminDashboardController::class, 'index']);

// مسارات الحياة المدرسية والشات بوت التعليمي
Route::get('/{tenant}/student-life', [StudentLifeController::class, 'index'])->name('student.life');
Route::post('/{tenant}/student-life/chat', [StudentLifeController::class, 'chat'])->name('student.life.chat');

// [الجديد] مسار لوحة التحكم المركزية الآمنة للمشرفين والمدير العام
Route::match(['get', 'post'], '{tenant}/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// تأكد من وجود اسم الرابط في نهاية السطر بداخل ملف الـ Routes
Route::get('/{tenant}/search', [StudentResultController::class, 'index'])->name('student.search');
Route::post('/{tenant}/search', [StudentResultController::class, 'index']);