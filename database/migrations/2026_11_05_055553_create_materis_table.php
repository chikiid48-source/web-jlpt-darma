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
    Schema::create('materis', function (Blueprint $table) {
        $table->id();
        $table->string('level'); // n5, n4, n3, n2, n1
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('type'); // pdf atau video
        $table->string('file_url'); // Link GDrive (PDF) atau YouTube
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
