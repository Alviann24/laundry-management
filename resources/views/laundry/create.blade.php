@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Tambah Layanan Laundry</h1>
    
    <form action="{{ route('laundry.store') }}" method="POST" enctype="multipart/form-data"> <!-- Tambahkan enctype -->
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Nama Layanan</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="price_per_kg" class="form-label">Harga per Kilogram</label>
            <input type="number" step="0.01" class="form-control" id="price_per_kg" name="price_per_kg" placeholder="Masukkan harga per kilogram" required>
        </div>        

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Layanan</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Tambah Layanan Laundry</button>
    </form>
</div>
@endsection
