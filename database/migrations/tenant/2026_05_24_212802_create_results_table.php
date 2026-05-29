<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     Schema::create('results', function (Blueprint $table) {
        $table->id();
        $table->string('grade_name'); // اسم الصف (مثل: الصف الأول الثانوي)
        $table->string('term');       // الترم (مثل: الفصل الدراسي الأول)
        $table->boolean('archived')->default(false);
        $table->timestamps();
    });

    // إنشاء جدول فرعي يربط الطلاب بالدرجات الفردية لحماية الذاكرة ومنع استخدام مصفوفات JSON الضخمة
    Schema::create('student_scores', function (Blueprint $table) {
        $table->id();
        $table->foreignId('result_id')->constrained()->onDelete('cascade');
        $table->string('student_name');
        $table->integer('score');
        $table->string('subject_name');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
