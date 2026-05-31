<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentResultController;
use App\Http\Controllers\StudentLifeController;
use App\Http\Controllers\SchoolHomeController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{tenant}', [SchoolHomeController::class, 'index'])->name('school.home');

Route::match(['get', 'post'], '/{tenant}/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// نتائج الطلاب
Route::post('/{tenant}/admin/results/upload', [AdminDashboardController::class, 'uploadResults'])->name('admin.results.upload');
Route::get('/{tenant}/admin/results/preview', [AdminDashboardController::class, 'getPreviewStudents'])->name('admin.results.getPreview');
Route::post('/{tenant}/admin/results/save', [AdminDashboardController::class, 'saveResults'])->name('admin.results.save');
Route::post('/{tenant}/admin/results/update-preview', [AdminDashboardController::class, 'updatePreviewStudent'])->name('admin.results.updatePreview');
Route::get('/{tenant}/admin/results/list', [AdminDashboardController::class, 'getResults'])->name('admin.results.getResults');
Route::put('/{tenant}/admin/results/{id}', [AdminDashboardController::class, 'updateSavedStudent'])->name('admin.results.update');
Route::delete('/{tenant}/admin/results/{id}', [AdminDashboardController::class, 'deleteResult'])->name('admin.results.delete');

// الأرشفة والاستعادة
Route::post('/{tenant}/admin/results/{id}/archive', [AdminDashboardController::class, 'archiveResult'])->name('admin.results.archive');
Route::post('/{tenant}/admin/results/{id}/unarchive', [AdminDashboardController::class, 'unarchiveResult'])->name('admin.results.unarchive');
Route::delete('/{tenant}/admin/results-group/{id}', [AdminDashboardController::class, 'deleteResultGroup'])->name('admin.results.deleteGroup');
Route::post('/{tenant}/admin/results/bulk', [AdminDashboardController::class, 'bulkAction'])->name('admin.results.bulk');

// بحث الطلاب
Route::match(['get', 'post'], '/{tenant}/search', [StudentResultController::class, 'index'])->name('student.search');

// الحياة المدرسية
Route::get('/{tenant}/student-life', [StudentLifeController::class, 'index'])->name('student.life');
Route::post('/{tenant}/student-life/chat', [StudentLifeController::class, 'chat'])->name('student.life.chat');