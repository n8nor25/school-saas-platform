<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TenantThemeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // جلب معرف المدرسة الحالية
        $tenantId = tenant('id');

        if ($tenantId) {
            // إعداد ألوان افتراضية لكل مدرسة
            $theme = [
                'primary_color' => '#1e3a8a', // الأزرق لمدرسة school1
            ];

            if ($tenantId === 'school2') {
                $theme['primary_color'] = '#b91c1c'; // الأحمر لمدرسة school2
            }

            // مشاركة المتغير مع شاشات الـ Blade
            View::share('tenantTheme', $theme);
        }

        return $next($request);
    }
}