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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('document')->unique();
            $table->date('birthday');
            $table->string('email')->unique();
            $table->string('phone');
            $table->tinyInteger('age');
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained('municipalities')->onDelete('cascade');
            $table->foreignId('parish_id')->constrained('parishes')->onDelete('cascade');
            $table->string('sector');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
