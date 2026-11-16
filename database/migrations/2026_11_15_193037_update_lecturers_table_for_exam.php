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
         Schema::table('lecturers', function (Blueprint $table) {
        $table->string('academic_rank')->nullable()->after('department');
        $table->renameColumn('image', 'photo');
        $table->softDeletes();
    });

    Schema::table('lecturers', function (Blueprint $table) {
        $table->string('photo')->nullable()->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('lecturers', function (Blueprint $table) {
        $table->dropSoftDeletes();
        $table->dropColumn('academic_rank');
        $table->renameColumn('photo', 'image');
    });
    }
};
