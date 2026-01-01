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
        Schema::create('answer_options', function (Blueprint $table) {
            $table->id();
            $table->integer('option_scale_id');
            $table->unsignedTinyInteger('score'); // 1–4 (PermenPANRB)
            $table->string('label', 100);         // Bahasa Indonesia
            $table->timestamps();
            $table->softDeletes();

            $table->index(['option_scale_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_options');
    }
};
