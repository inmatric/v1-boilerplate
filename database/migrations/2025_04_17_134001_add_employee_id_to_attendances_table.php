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
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable();

            // Menambahkan relasi foreign key ke tabel employees
            $table->foreign('employee_id')
                ->references('id')->on('employees') // Menyatakan relasi ke tabel employees
                ->onDelete('cascade') // Jika employee dihapus, maka data attendance yang terkait akan dihapus juga
                ->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
        });
    }
};
