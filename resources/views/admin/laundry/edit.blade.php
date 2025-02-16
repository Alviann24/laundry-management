@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
    <h1 class="text-center mb-4 text-primary fw-bold">Edit Layanan Laundry</h1>
    <form action="{{ route('admin.laundry.update', $laundryItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Gunakan  untuk update -->

        <div class="form-group">
            <label for="name">Nama Layanan</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $laundryItem->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Harga per item</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $laundryItem->price }}" required>
        </div>

        <div class="mb-3">
            <label for="price_per_kg" class="form-label">Harga per Kg</label>
            <input type="number" step="0.01" name="price_per_kg" id="price_per_kg" class="form-control" value="{{ old('price_per_kg', $laundryItem->price_per_kg ?? '') }}">
        </div>      

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Layanan</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection