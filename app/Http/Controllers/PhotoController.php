<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Menampilkan daftar foto.
     */
    public function index()
    {
        $photos = Photo::latest()->get();
        $albums = Album::all();
        return view('photos.index', compact('photos', 'albums'));
    }

    /**
     * Menyimpan foto baru.
     */
    public function store(Request $request){
    $request->validate([
        'album_id' => 'required|exists:albums,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = $request->file('image')->store('photos', 'public');

    Photo::create([
        'album_id' => $request->album_id,
        'title' => $request->title,
        'description' => $request->description,
        'image_path' => $imagePath,
    ]);

    return redirect()->route('photos.index')->with('success', 'Foto berhasil ditambahkan!');
}

    /**
     * Menampilkan form edit foto.
     */
    public function edit(Photo $photo){
        $albums = Album::all();
        return view('photos.edit', compact('photo', 'albums'));
    }

    /**
     * Memperbarui data foto.
     */
    public function update(Request $request, Photo $photo){
    $request->validate([
        'album_id' => 'required|exists:albums,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($photo->image_path);
        $imagePath = $request->file('image')->store('photos', 'public');
        $photo->image_path = $imagePath;
    }

    $photo->album_id = $request->album_id;
    $photo->title = $request->title;
    $photo->description = $request->description;
    $photo->save();

    return redirect()->route('photos.index')->with('success', 'Foto berhasil diperbarui!');
}

    /**
     * Menghapus foto.
     */
    public function destroy(Photo $photo){
    Storage::disk('public')->delete($photo->image_path);
    $photo->delete();

    return redirect()->route('photos.index')->with('success', 'Foto berhasil dihapus!');
}
}
