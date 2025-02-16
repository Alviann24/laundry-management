@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">
                <span class="border-success ">Detail Order</span>
            </h1>
            
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success bg-opacity-10 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Order #{{ $order->id }}</h5>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'primary') }} px-3 py-2 rounded-pill">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-person-circle fs-4 me-2 text-success"></i>
                                <div>
                                    <small class="text-muted d-block">Nama Pembeli</small>
                                    <strong>{{ $order->user->name }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-box-seam me-2"></i>Detail Layanan
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead class="text-muted">
                                        <tr>
                                            <th>Layanan</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Berat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->laundryItems as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->pivot->quantity }} item</td>
                                            <td class="text-center">{{ $item->pivot->weight }} kg</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center p-3 bg-success bg-opacity-10 rounded-3">
                        <h5 class="mb-0">Total Harga</h5>
                        <h4 class="mb-0 fw-bold text-success">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</h4>
                    </div>
                </div>

                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('penjual.dashboard') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
