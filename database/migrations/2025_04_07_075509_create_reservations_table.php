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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('medical_center_id')->constrained('medical_centers')->onDelete('cascade');
            $table->foreignId('medical_area_id')->constrained('medical_areas')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->string('reason');
            $table->date('date');
            $table->foreignId('medical_schedule_id')->constrained('medical_schedules')->onDelete('cascade');
            $table->string('observation')->nullable();
            $table->enum('status', ['pendiente', 'procesado', 'cancelado'])->default('pendiente');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
