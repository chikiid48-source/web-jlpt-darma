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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('app_name')->default('JAPANFOUNDATION');
        $table->string('logo')->default('images/logo-baru.jpg');
        $table->text('address')->nullable();
        $table->string('email')->default('jlpt.indonesia@jpf.go.jp');
        $table->string('facebook')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
