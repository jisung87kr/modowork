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
            $table->enum('role', ['job_seeker', 'employer', 'admin'])->default('job_seeker')->after('email');
            $table->string('phone')->nullable()->after('email_verified_at');
            $table->date('birth_date')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('birth_date');
            $table->text('bio')->nullable()->after('gender');
            $table->string('profile_image')->nullable()->after('bio');
            $table->boolean('is_active')->default(true)->after('profile_image');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->softDeletes();
            
            $table->index(['role', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['role', 'is_active']);
            $table->dropColumn([
                'role', 'phone', 'birth_date', 'gender', 
                'bio', 'profile_image', 'is_active', 'last_login_at'
            ]);
        });
    }
};
