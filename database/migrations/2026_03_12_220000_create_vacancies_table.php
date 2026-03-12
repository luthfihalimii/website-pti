<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('vacancies')) {
            return;
        }

        Schema::create('vacancies', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('employment_type')->nullable();
            $table->string('summary', 500)->nullable();
            $table->string('headline')->nullable();
            $table->text('description')->nullable();
            $table->json('qualifications')->nullable();
            $table->json('skills')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('salary_note')->nullable();
            $table->string('salary_context')->nullable();
            $table->json('benefits')->nullable();
            $table->string('poster_path')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
