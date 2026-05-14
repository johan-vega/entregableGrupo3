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
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('github_id')->nullable()->unique()->after('google_id');
            $table->string('auth_provider')->nullable()->after('github_id');
            $table->text('avatar_url')->nullable()->after('auth_provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_google_id_unique');
            $table->dropUnique('users_github_id_unique');
            $table->dropColumn(['google_id', 'github_id', 'auth_provider', 'avatar_url']);
        });
    }
};
