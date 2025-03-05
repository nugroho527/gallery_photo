@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">Gallery Photos</h2>
        <!-- Tombol Tambah Foto -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
            <i class="fas fa-plus"></i> Tambah Foto
        </button>
    </div>

    <!-- Modal Tambah Foto -->
    <div class="modal fade" id="addPhotoModal" tabindex="-1" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="addPhotoModalLabel">Tambah Foto Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Pilihan Album -->
                        <div class="mb-3">
                            <label for="album_id" class="form-label text-dark">Pilih Album</label>
                            <select class="form-control" id="album_id" name="album_id" required>
                                <option value="" selected disabled>Pilih Album</option>
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input Judul -->
                        <div class="mb-3">
                            <label for="title" class="form-label text-dark">Judul Foto</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Input Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label text-dark">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <!-- Input Foto -->
                        <div class="mb-3">
                            <label for="image" class="form-label text-dark">Pilih Foto</label>
                            <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Foto dalam Grid Responsif -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
        @foreach ($photos as $photo)
            <div class="col">
                <div class="card bg-dark text-white shadow-sm">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" class="card-img-top" alt="{{ $photo->title }}" style="object-fit: cover; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $photo->title }}</h5>
                        <p class="card-text small">{{ $photo->description }}</p>
                        <div class="d-flex justify-content-between">
                            <!-- Tombol Edit -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPhotoModal{{ $photo->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <!-- Form Hapus -->
                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Foto -->
            <div class="modal fade" id="editPhotoModal{{ $photo->id }}" tabindex="-1" aria-labelledby="editPhotoModalLabel{{ $photo->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="editPhotoModalLabel{{ $photo->id }}">Edit Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <!-- Pilihan Album -->
                                <div class="mb-3">
                                    <label for="album_id" class="form-label text-dark">Pilih Album</label>
                                    <select class="form-control" id="album_id" name="album_id" required>
                                        @foreach ($albums as $album)
                                            <option value="{{ $album->id }}" {{ $photo->album_id == $album->id ? 'selected' : '' }}>
                                                {{ $album->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Input Judul -->
                                <div class="mb-3">
                                    <label for="title" class="form-label text-dark">Judul Foto</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}" required>
                                </div>

                                <!-- Input Deskripsi -->
                                <div class="mb-3">
                                    <label for="description" class="form-label text-dark">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $photo->description }}</textarea>
                                </div>

                                <!-- Input Foto (Opsional) -->
                                <div class="mb-3">
                                    <label for="image" class="form-label text-dark">Ganti Foto (Opsional)</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
