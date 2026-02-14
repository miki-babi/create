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
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->text('bio')->nullable();
            $table->string('telegramusername')->nullable();
            $table->string('telegramid')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar_path')->nullable();
            $table->json('social_platforms')->nullable();
            $table->json('niches')->nullable();
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creators');
    }
};
