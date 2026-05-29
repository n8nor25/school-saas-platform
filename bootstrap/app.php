<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware) {
    $middleware->validateCsrfTokens(except: [
        '*/admin/dashboard', // 📌 استثناء لوحة التحكم من فحص الـ CSRF لمنع خطأ 419 نهائياً أثناء رفع الملفات
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
