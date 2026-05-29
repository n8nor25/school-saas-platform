<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolHomeController extends Controller
{
    public function index($tenant)
    {
        // 1. تهيئة مساحة المدرسة برمجياً لربط الاتصال بـ Supabase تلقائياً عند الحاجة
        if (function_exists('tenancy')) {
            tenancy()->initialize($tenant);
        }

        // 2. تجميع كافة البيانات المخصصة لهوية المدرسة بالتطابق مع ملف Next.js
        $schoolDetails = [
            'name' => $tenant == 'school1' ? 'مدرسة الأجاويد الحديثة' : 'المدرسة الإعدادية النموذجية',
            'description' => 'مدرسة رائدة في التعليم الإعدادي تسعى لبناء جيل واعد يمتلك مهارات المستقبل.',
            'phone' => '0123456789',
            'email' => 'info@school.edu',
            'address' => 'الشارع الرئيسي، جمهورية مصر العربية',
            'facebook_url' => 'https://facebook.com',
            
            // إعدادات المكونات وحالة الظهور (Settings toggles)
            'settings' => [
                'hero_title' => 'مرحباً بكم في مدرستنا',
                'hero_subtitle' => 'نحو تعليم متميز ومستقبل مشرق لطلابنا',
                'banner_title' => 'فتح باب التسجيل للعام الدراسي الجديد - أهلاً بكم',
                'banner_image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200',
                'vision' => 'نسعى لتقديم تعليم عصري متميز يُعد طلابنا ليكونوا قادة المستقبل، من خلال بيئة تعليمية محفزة وكوادر تعليمية مؤهلة.',
                'about_video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // مثال لفيديو تعريفي
                'live_stream_url' => 'https://youtube.com', // رابط البث المباشر للمسرح
                'show_live_stream' => true,
            ],

            // إحصائيات المدرسة الحية (Stats)
            'stats' => [
                'students' => 450,
                'teachers' => 35,
                'classes' => 18,
                'years' => 12
            ],

            // السلايدر الرئيسي (Sliders)
            'slider' => [
                ['title' => 'أهلاً بكم في منصتنا التعليمية المطورة', 'subtitle' => 'تصفح الخدمات الإلكترونية وتابع درجاتك أولاً بأول', 'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200'],
                ['title' => 'تكريم الطلاب المتفوقين في الأنشطة الطلابية', 'subtitle' => 'مدرستنا ترعى المواهب وتدعم المبتكرين دائماً', 'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200']
            ],

            // الأخبار والتنبيهات الهامة (News & Alerts)
            'news' => [
                ['title' => 'تنبيه عاجل: تعديل جدول اختبارات الشهر لصفوف المرحلة الإعدادية', 'category' => 'تنبيه', 'date' => '2026-05-27'],
                ['title' => 'بدء فعاليات مسابقة القرآن الكريم السنوية بالمدرسة', 'category' => 'فعاليات', 'date' => '2026-05-26'],
                ['title' => 'جدول امتحانات العملي لمادة الحاسب الآلي والعلوم', 'category' => 'تنبيه', 'date' => '2026-05-24'],
                ['title' => 'تكريم فريق المدرسة الفائز بالمركز الأول في دوري كرة القدم', 'category' => 'أخبار', 'date' => '2026-05-22'],
            ],

            // كادر المعلمين المتميزين (Teachers)
            'teachers' => [
                ['name' => 'أ. أحمد رأفت', 'subject' => 'رياضيات', 'email' => 'ahmed@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=150'],
                ['name' => 'أ. سارة محمود', 'subject' => 'لغة عربية', 'email' => 'sara@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=150'],
                ['name' => 'أ. محمد إبراهيم', 'subject' => 'علوم', 'email' => 'mohamed@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=150'],
                ['name' => 'أ. رانيا علي', 'subject' => 'لغة انجليزية', 'email' => 'rania@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1580894732444-8fecef2271ff?q=80&w=150'],
            ]
        ];

        return view('school.index', compact('tenant', 'schoolDetails'));
    }
}