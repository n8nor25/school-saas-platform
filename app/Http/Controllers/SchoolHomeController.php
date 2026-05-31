<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolSetting;
use App\Models\SchoolNews;
use App\Models\SchoolTeacher;
use App\Models\SchoolSlider;

class SchoolHomeController extends Controller
{
    public function index(Request $request, $tenant)
    {
        if (function_exists('tenancy')) {
            tenancy()->initialize($tenant);
        }

        // جلب البيانات من قاعدة البيانات مع قيم افتراضية احتياطية
        $schoolDetails = [
            'name' => SchoolSetting::get('school_name', 'المدرسة الإعدادية النموذجية'),
            'description' => SchoolSetting::get('school_description', 'مدرسة رائدة في التعليم الإعدادي.'),
            'phone' => SchoolSetting::get('school_phone', ''),
            'email' => SchoolSetting::get('school_email', ''),
            'address' => SchoolSetting::get('school_address', ''),
            'facebook_url' => SchoolSetting::get('school_facebook', '#'),

            'settings' => [
                'hero_title' => SchoolSetting::get('hero_title', 'مرحباً بكم في مدرستنا'),
                'hero_subtitle' => SchoolSetting::get('hero_subtitle', 'نحو تعليم متميز'),
                'vision' => SchoolSetting::get('vision', ''),
                'about_video' => SchoolSetting::get('about_video', ''),
                'live_stream_url' => SchoolSetting::get('live_stream_url', ''),
                'show_live_stream' => SchoolSetting::get('show_live_stream', false),
                'banner_title' => SchoolSetting::get('banner_title', ''),
                'banner_image' => SchoolSetting::get('banner_image', ''),
            ],

            'stats' => SchoolSetting::get('stats', [
                'students' => 0,
                'teachers' => 0,
                'classes' => 0,
                'years' => 0,
            ]),

            'slider' => SchoolSlider::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->toArray(),

            'news' => SchoolNews::where('is_active', true)
                ->orderBy('date', 'desc')
                ->get()
                ->toArray(),

            'teachers' => SchoolTeacher::where('is_active', true)
                ->get()
                ->toArray(),
        ];

        return view('school.index', compact('tenant', 'schoolDetails'));
    }
}