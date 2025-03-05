<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{

    public function index()
{
    $albums = Album::all(); // Ambil semua data album dari database
    return view('albums.index', compact('albums'));
}
    public function run()
    {
        // Tambahkan data dummy
        Album::create([
            'nama_album' => 'Liburan ke Bali',
            'deskripsi' => 'Foto-foto liburan keluarga ke Bali tahun 2023.',
        ]);

        Album::create([
            'nama_album' => 'Wisata Kuliner',
            'deskripsi' => 'Dokumentasi kuliner di berbagai kota.',
        ]);

        // Tambahkan lebih banyak data jika diperlukan
    }
}