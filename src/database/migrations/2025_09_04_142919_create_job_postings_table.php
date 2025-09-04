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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('location_id')->constrained()->onDelete('restrict');
            $table->string('title');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->enum('employment_type', ['daily', 'weekly', 'monthly', 'contract'])->default('daily');
            $table->integer('salary_min');
            $table->integer('salary_max')->nullable();
            $table->enum('salary_type', ['hourly', 'daily', 'monthly'])->default('daily');
            $table->integer('required_people')->default(1);
            $table->date('work_start_date');
            $table->date('work_end_date')->nullable();
            $table->time('work_start_time')->nullable();
            $table->time('work_end_time')->nullable();
            $table->enum('status', ['active', 'paused', 'closed', 'expired'])->default('active');
            $table->timestamp('expires_at');
            $table->integer('view_count')->default(0);
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->softDeletes();
            $table->timestamps();
            
            $table->index(['status', 'expires_at', 'is_featured']);
            $table->index(['category_id', 'location_id']);
            $table->index(['salary_min', 'salary_max']);
            $table->index('work_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
