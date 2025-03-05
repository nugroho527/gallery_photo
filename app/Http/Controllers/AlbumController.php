<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller {
    public function index() {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:albums,name',
        'deskripsi' => 'nullable|string',
    ], [
        'name.required' => 'Nama album wajib diisi.',
        'name.unique' => 'Nama album sudah ada. Silakan gunakan nama lain.',
    ]);

    Album::create([
        'name' => $request->name,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('albums.index')->with('success', 'Album berhasil ditambahkan!');
}


    public function edit(Album $album) {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, $id)
{
    $album = Album::findOrFail($id);

    $request->validate([
        'name' => 'required|unique:albums,name,' . $album->id,
        'deskripsi' => 'nullable|string',
    ], [
        'name.required' => 'Nama album wajib diisi.',
        'name.unique' => 'Nama album sudah ada. Silakan gunakan nama lain.',
    ]);

    $album->update([
        'name' => $request->name,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('albums.index')->with('success', 'Album berhasil diperbarui!');
}


    public function destroy(Album $album) {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album berhasil dihapus!');
    }

    public function show($id)
    {
        $album = Album::findOrFail($id); // Mencari album berdasarkan ID, jika tidak ditemukan akan menghasilkan 404
        return view('albums.show', compact('album'));
    }

}
