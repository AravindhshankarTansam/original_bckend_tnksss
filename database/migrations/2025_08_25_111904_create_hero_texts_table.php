<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_texts', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ta');
            $table->text('description_en');
            $table->text('description_ta');
            $table->boolean('is_public')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_texts');
    }
};
