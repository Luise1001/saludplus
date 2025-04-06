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
        Schema::create('medical_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_center_id')->constrained('medical_centers')->onDelete('cascade');
            $table->foreignId('medical_area_id')->constrained('medical_areas')->onDelete('cascade');
            $table->string('day');
            $table->time('hour');
            $table->tinyInteger('slots')->default(1);
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_schedules');
    }
};
