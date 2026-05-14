<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->unique()->after('name');
            }

            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('patient')->after('avatar_url');
            }
        });

        Schema::table('pacients', function (Blueprint $table) {
            if (! Schema::hasColumn('pacients', 'user_id')) {
                $table->foreignId('user_id')->nullable()->unique()->after('id_pacient')->constrained('users')->nullOnDelete();
            }
        });

        User::query()->update(['role' => 'patient']);

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrador',
                'email' => 'admin@sanar.local',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::query()->where('username', 'admin')->where('email', 'admin@sanar.local')->delete();

        Schema::table('pacients', function (Blueprint $table) {
            if (Schema::hasColumn('pacients', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropUnique('pacients_user_id_unique');
                $table->dropColumn('user_id');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropUnique('users_username_unique');
            }

            $columnsToDrop = [];

            if (Schema::hasColumn('users', 'username')) {
                $columnsToDrop[] = 'username';
            }

            if (Schema::hasColumn('users', 'role')) {
                $columnsToDrop[] = 'role';
            }

            if ($columnsToDrop !== []) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
