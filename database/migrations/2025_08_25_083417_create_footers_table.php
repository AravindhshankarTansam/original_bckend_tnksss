<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ta')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();

            // 3 headers, each with 4 links
            for ($h = 1; $h <= 3; $h++) {
                $table->string("header{$h}_en")->nullable();
                $table->string("header{$h}_ta")->nullable();
                for ($l = 1; $l <= 4; $l++) {
                    $table->string("header{$h}_link{$l}_en")->nullable();
                    $table->string("header{$h}_link{$l}_ta")->nullable();
                    $table->string("header{$h}_link{$l}_url")->nullable();
                }
            }

            $table->boolean('is_public')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
