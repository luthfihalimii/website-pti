<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('employment_type')->nullable();
            $table->string('headline');
            $table->text('summary');
            $table->longText('description');
            $table->json('qualifications');
            $table->json('skills');
            $table->string('salary_range');
            $table->string('salary_note')->nullable();
            $table->text('salary_context')->nullable();
            $table->json('benefits');
            $table->string('poster_path');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
