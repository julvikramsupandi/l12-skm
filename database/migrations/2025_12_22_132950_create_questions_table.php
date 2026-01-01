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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('element_id');
            $table->integer('option_scale_id');
            $table->string('question_code');
            $table->text('question_text');

            // Untuk online / offline / hybrid
            $table->enum('service_channel', [
                'OFFLINE',
                'ONLINE',
                'HYBRID'
            ])->default('HYBRID');

            // Aktif / tidak
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['element_id', 'option_scale_id', 'service_channel']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
