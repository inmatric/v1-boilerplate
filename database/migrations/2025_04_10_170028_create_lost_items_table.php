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
    Schema::create('lost_items', function (Blueprint $table) {
        $table->id();
        $table->string('lost_name', 50);
        $table->string('item_name', 100);
        $table->string('lost_location', 50);
        $table->date('lost_date')->nullable(); // <- bisa diisi atau tidak
        $table->string('photo', 255);
        $table->enum('status', ['hilang', 'ditemukan'])->default('hilang');
        $table->text('description');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
