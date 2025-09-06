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
        Schema::create('complaint_resolution', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('complaint_id'); // Changed from description to complaint_id as foreign key
            $table->string('doings', 255)->nullable();
            $table->string('photo_evidence', 255)->nullable();
            $table->unsignedBigInteger('location_id');

            $table->string('notes',)->nullable();
            $table->enum('status', ['pending', 'processed', 'resolved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_resolution');
    }
};
