<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // image path
            $table->string('alt_en')->nullable(); // alt text English
            $table->string('alt_ta')->nullable(); // alt text Tamil
            $table->boolean('is_public')->default(true); // Active / Inactive
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
