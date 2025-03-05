@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Album</h1>

    <div class="card bg-dark text-white">
        <div class="card-body">
            <h5 class="card-title"><strong>Nama Album:</strong> {{ $album->name }}</h5>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $album->deskripsi }}</p>
            <p class="card-text"><strong>Dibuat pada:</strong> {{ $album->created_at->format('d M Y') }}</p>
            <p class="card-text"><strong>Terakhir diperbarui:</strong> {{ $album->updated_at->format('d M Y') }}</p>

            <a href="{{ route('albums.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
