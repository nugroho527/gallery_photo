<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id'); // Tidak nullable karena wajib terkait album
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path');
            $table->timestamps();

            // Menambahkan foreign key ke tabel albums
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['album_id']); // Hapus foreign key dulu
        });

        Schema::dropIfExists('photos');
    }
};
