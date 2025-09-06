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
        Schema::create('item_found', function (Blueprint $table) {
        $table->id();
        $table->string('find_name', 50);
        $table->string('item_name', 100);
        $table->string('find_location', 50);
        $table->date('find_date')->nullable(); // <- bisa diisi atau tidak
        $table->string('telephone', 15);
        $table->string('photo', 255);
        $table->enum('status', ['diambil', 'belum_diambil'])->default('diambil');
        $table->text('description');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_found');
    }
};
