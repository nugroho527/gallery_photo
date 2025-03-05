@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Album Baru</h1>

    <form action="{{ route('albums.store') }}" method="POST">
        @csrf

        <!-- Nama Album -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Album</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
