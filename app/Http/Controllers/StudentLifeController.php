<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentLifeController extends Controller
{
    /**
     * العرض العام لصفحة حياة الطالب والأنشطة المدرسية
     * يدمج المصادر التعليمية مثل بنك المعرفة المصري وخان أكاديمي
     */
    public function index(Request $request, $tenant)
    {
        if (function_exists('tenancy')) {
            tenancy()->initialize($tenant);
        }

        // 1. جلب التوجيهات والأنشطة التعليمية المخزنة للفرع الحالي
        $activities = $request->session()->get('student_activities_db', [
            [
                'id' => 'act_1',
                'title' => 'المعرض العلمي السنوي للمبتكرين',
                'description' => 'ملتقى طلاب المدرسة لاستعراض مجسمات فيزياء المستقبل والذكاء الاصطناعي.',
                'date' => '2026-06-10',
                'category' => 'علمي'
            ],
            [
                'id' => 'act_2',
                'title' => 'دوري كرة القدم للمرحلة الإعدادية',
                'description' => 'انطلاق التصفيات بين الفصول لتحديد بطل الكأس للمدرسة.',
                'date' => '2026-05-30',
                'category' => 'رياضي'
            ]
        ]);

        // 2. تجميع الروابط التعليمية الخارجية المعتمدة (بما فيها بنك المعرفة وخان أكاديمي)
        $educationalLinks = [
            [
                'title' => 'بنك المعرفة المصري (EKB)',
                'url' => 'https://www.ekb.eg',
                'description' => 'المصدر الوطني الأكبر للمناهج والموسوعات العلمية الرقمية لجميع المراحل الدراسية.',
                'icon' => 'book-open'
            ],
            [
                'title' => 'منصة خان أكاديمي (Khan Academy)',
                'url' => 'https://ar.khanacademy.org',
                'description' => 'دروس ومقاطع مرئية تفاعلية مجانية في الرياضيات والعلوم والبرمجة باللغة العربية.',
                'icon' => 'video'
            ]
        ];
// 📌 1. إضافة بيانات متغير التحفيز المطلوب بداخل الفيو الأصلي الخاص بك
    $motivation = [
        'text' => 'النجاح ليس بمقدار الأعمال التي تنجزها، بل بمقدار الإصرار والتحدي الذي تواجه به الصعاب يومياً.',
        'author' => 'إدارة الكنترول والمدرسة الذكية'
    ];

    // 📌 2. تمرير المتغير الجديد $motivation صراحةً داخل دالة الـ compact لتأمين الفيو
    return view('student.life', compact('tenant', 'activities', 'educationalLinks', 'motivation'));
}    
    }
