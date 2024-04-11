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
        Schema::create('jawaban_sub_soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id');
            $table->foreignId('subsoal_id');
            $table->string('jawabansubsoal');
            $table->string('nilaijawabansubsoal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_sub_soals');
    }
};
