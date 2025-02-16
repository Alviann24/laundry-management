@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detail Order</h2>
    <table class="table">
        <tr>
            <th>ID Order</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Nama Pembeli</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
        <tr>
            <th>Layanan</th>
            <td>
                <ul>
                    @foreach ($order->laundryItems as $item)
                        <li>{{ $item->name }} - {{ $item->pivot->quantity }} item / {{ $item->pivot->weight }} kg</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
    <a href="{{ route('penjual.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
