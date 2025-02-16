@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-primary">Tambah Layanan Laundry</h1>

    <form action="{{ route('admin.laundry.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Layanan</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga per Item</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="price_per_kg" class="form-label">Harga per Kg</label>
            <input type="number" class="form-control" id="price_per_kg" name="price_per_kg">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Tambah Layanan</button>
    </form>
</div>
@endsection
