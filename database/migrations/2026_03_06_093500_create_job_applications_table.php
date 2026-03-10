<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('panggilan');
            $table->string('email')->index();
            $table->string('nomor_telepon', 50);
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 50);
            $table->string('agama', 50);
            $table->string('status_pernikahan', 50);
            $table->string('golongan_darah', 10);
            $table->string('pendidikan_terakhir', 50);
            $table->string('jurusan');
            $table->string('ipk', 20);
            $table->string('posisi');
            $table->text('pengalaman_kerja');
            $table->text('keahlian_khusus');
            $table->string('cv_path');
            $table->string('cv_disk', 50)->default('local');
            $table->string('portofolio', 500);
            $table->string('sumber_informasi', 100);
            $table->string('gaji_diharapkan', 100);
            $table->date('mulai_bekerja');
            $table->boolean('pernyataan_1');
            $table->boolean('pernyataan_2');
            $table->boolean('pernyataan_3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
