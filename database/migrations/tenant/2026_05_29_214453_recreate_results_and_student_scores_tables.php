<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('student_scores');
        Schema::dropIfExists('results');

        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('grade_name');
            $table->string('term');
            $table->string('sheet_name')->nullable();
            $table->boolean('archived')->default(false);
            $table->timestamps();
        });

        Schema::create('student_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id')->constrained()->onDelete('cascade');
            $table->string('seat_number')->nullable();
            $table->string('student_name');
            $table->decimal('arabic', 5, 1)->default(0);
            $table->decimal('english', 5, 1)->default(0);
            $table->decimal('social_studies', 5, 1)->default(0);
            $table->decimal('math', 5, 1)->default(0);
            $table->decimal('science', 5, 1)->default(0);
            $table->decimal('religion', 5, 1)->default(0);
            $table->decimal('art', 5, 1)->default(0);
            $table->decimal('computer', 5, 1)->default(0);
            $table->decimal('total', 6, 1)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_scores');
        Schema::dropIfExists('results');
    }
};