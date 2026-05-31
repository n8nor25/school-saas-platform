<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolSetting;
use App\Models\SchoolNews;
use App\Models\SchoolTeacher;
use App\Models\SchoolSlider;

class TenantDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === إعدادات المدرسة ===
        SchoolSetting::set('school_name', 'مدرسة الأجاويد الحديثة');
        SchoolSetting::set('school_description', 'مدرسة رائدة في التعليم الإعدادي تسعى لبناء جيل واعد يمتلك مهارات المستقبل.');
        SchoolSetting::set('school_phone', '0123456789');
        SchoolSetting::set('school_email', 'info@school.edu');
        SchoolSetting::set('school_address', 'الشارع الرئيسي، جمهورية مصر العربية');
        SchoolSetting::set('school_facebook', 'https://facebook.com');
        SchoolSetting::set('hero_title', 'مرحباً بكم في مدرستنا');
        SchoolSetting::set('hero_subtitle', 'نحو تعليم متميز ومستقبل مشرق لطلابنا');
        SchoolSetting::set('vision', 'نسعى لتقديم تعليم عصري متميز يُعد طلابنا ليكونوا قادة المستقبل، من خلال بيئة تعليمية محفزة وكوادر تعليمية مؤهلة.');
        SchoolSetting::set('stats', [
            'students' => 450,
            'teachers' => 35,
            'classes' => 18,
            'years' => 12,
        ], 'json');

        // === السلايدر ===
        SchoolSlider::create([
            'title' => 'أهلاً بكم في منصتنا التعليمية المطورة',
            'subtitle' => 'تصفح الخدمات الإلكترونية وتابع درجاتك أولاً بأول',
            'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=1200',
            'sort_order' => 1,
        ]);
        SchoolSlider::create([
            'title' => 'تكريم الطلاب المتفوقين في الأنشطة الطلابية',
            'subtitle' => 'مدرستنا ترعى المواهب وتدعم المبتكرين دائماً',
            'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200',
            'sort_order' => 2,
        ]);

        // === الأخبار ===
        SchoolNews::create(['title' => 'تنبيه عاجل: تعديل جدول اختبارات الشهر لصفوف المرحلة الإعدادية', 'category' => 'تنبيه', 'date' => '2026-05-27']);
        SchoolNews::create(['title' => 'بدء فعاليات مسابقة القرآن الكريم السنوية بالمدرسة', 'category' => 'فعاليات', 'date' => '2026-05-26']);
        SchoolNews::create(['title' => 'جدول امتحانات العملي لمادة الحاسب الآلي والعلوم', 'category' => 'تنبيه', 'date' => '2026-05-24']);
        SchoolNews::create(['title' => 'تكريم فريق المدرسة الفائز بالمركز الأول في دوري كرة القدم', 'category' => 'أخبار', 'date' => '2026-05-22']);

        // === المعلمين ===
        SchoolTeacher::create(['name' => 'أ. أحمد رأفت', 'subject' => 'رياضيات', 'email' => 'ahmed@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=150']);
        SchoolTeacher::create(['name' => 'أ. سارة محمود', 'subject' => 'لغة عربية', 'email' => 'sara@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=150']);
        SchoolTeacher::create(['name' => 'أ. محمد إبراهيم', 'subject' => 'علوم', 'email' => 'mohamed@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=150']);
        SchoolTeacher::create(['name' => 'أ. رانيا علي', 'subject' => 'لغة انجليزية', 'email' => 'rania@school.edu', 'avatar' => 'https://images.unsplash.com/photo-1580894732444-8fecef2271ff?q=80&w=150']);
    }
}