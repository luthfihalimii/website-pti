<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nisn', 50)->index();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jk', 20);
            $table->string('alamat', 500);
            $table->string('telp', 50);
            $table->string('kelas', 20);
            $table->string('sekolah');
            $table->string('alamat_sekolah', 500);
            $table->string('telp_sekolah', 50);
            $table->string('divisi_pilihan');
            $table->date('mulai_magang');
            $table->date('selesai_magang');
            $table->text('motivasi');
            $table->string('portofolio', 500);
            $table->string('cv_path');
            $table->string('cv_disk', 50)->default('local');
            $table->boolean('pernyataan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_applications');
    }
};
