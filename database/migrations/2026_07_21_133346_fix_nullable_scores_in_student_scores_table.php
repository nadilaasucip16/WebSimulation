<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah skema dulu agar kolom menerima NULL, baru reset data palsu.
        Schema::table('student_scores', function (Blueprint $table) {
            $table->integer('pretest')->nullable()->default(null)->change();
            $table->integer('posttest')->nullable()->default(null)->change();
        });

        // Baris yang posttest=0 karena default database (bukan hasil submit nyata)
        // diset ke NULL agar kondisi !== null di Blade bekerja benar.
        DB::table('student_scores')
            ->where('posttest', 0)
            ->update(['posttest' => null]);
    }

    public function down(): void
    {
        Schema::table('student_scores', function (Blueprint $table) {
            $table->integer('pretest')->default(0)->change();
            $table->integer('posttest')->default(0)->change();
        });
    }
};
