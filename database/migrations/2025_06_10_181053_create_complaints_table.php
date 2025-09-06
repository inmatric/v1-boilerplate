<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name', 255);
            $table->string('customer_phone', 255);
            $table->text('description');
            $table->string('proof_image', 255)->nullable();
            $table->enum('status', ['pending', 'processed', 'resolved', 'rejected'])->default('pending');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->foreign(['location_id', 'employee_id'])
                ->references(['location_id', 'employee_id'])
                ->on('location_divisions')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['location_id', 'employee_id']);
        });

        Schema::dropIfExists('complaints');
    }
};