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
        Schema::create('respondents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->bigInteger('service_id')->index();
            $table->date('survey_date');
            $table->string('survey_time');
            $table->string('respondent_name')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['P', 'L'])->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_disability')->nullable()->default(false);
            $table->string('disability_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
