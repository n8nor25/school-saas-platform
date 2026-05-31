<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_scores', function (Blueprint $table) {
            $table->decimal('algebra', 5, 1)->default(0)->after('social_studies');
            $table->decimal('geometry', 5, 1)->default(0)->after('algebra');
            $table->string('result')->nullable()->after('total');
        });
    }

    public function down()
    {
        Schema::table('student_scores', function (Blueprint $table) {
            $table->dropColumn(['algebra', 'geometry', 'result']);
        });
    }
};