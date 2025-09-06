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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->unsignedBigInteger('company_id');
            $table->string('location');
            $table->string('location_type');
            $table->string('location_code');
            $table->string('information');
            $table->string('status');
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('cooperations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
