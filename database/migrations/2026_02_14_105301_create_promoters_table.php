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
        Schema::create('promoters', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('telegramusername')->nullable();
            $table->string('telegramid')->nullable();
            $table->text('company_description')->nullable();
            $table->string('avatar_path')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promoters');
    }
};
