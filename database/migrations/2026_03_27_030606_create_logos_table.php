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
        Schema::table('logos', function (Blueprint $table) {
            $table->string('name')->nullable();      // nama client/logo
            $table->string('type');                  // pti, client, footer
            $table->string('path');                  // path file
            $table->integer('order')->nullable();    // urutan untuk footer
            $table->boolean('active')->default(true); // aktif atau draft
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logos');
    }
};
