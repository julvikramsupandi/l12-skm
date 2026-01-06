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
        Schema::table('users', function (Blueprint $table) {
            $table->string('unor_id')->nullable()->after('email_verified_at');
            $table->string('unor_name')->nullable()->after('unor_id');
            $table->string('avatar')->nullable()->after('unor_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('unor_id');
            $table->dropColumn('unor_name');
            $table->dropColumn('avatar');
        });
    }
};
