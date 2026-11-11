
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('nis', 20)->unique();
            $table->string('nisn', 20)->nullable()->unique();

            $table->string('nama_lengkap', 120);
            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->string('kelas', 20);
            $table->string('jurusan', 80);

            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telepon', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
