<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // جدول إعدادات المدرسة الأساسية
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();    // مفتاح الإعداد (مثل: school_name)
            $table->text('value')->nullable();   // قيمة الإعداد
            $table->string('type')->default('text'); // text, json, number
            $table->timestamps();
        });

        // جدول الأخبار
        Schema::create('school_news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('category')->default('أخبار'); // أخبار، تنبيه، فعاليات
            $table->date('date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // جدول المعلمين
        Schema::create('school_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // جدول السلايدر
        Schema::create('school_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('image');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_sliders');
        Schema::dropIfExists('school_news');
        Schema::dropIfExists('school_teachers');
        Schema::dropIfExists('school_settings');
    }
};