<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Order #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .invoice-header h2 {
            margin: 0;
            color: #007bff;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
        }
        .invoice-footer {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
        }
        .invoice-footer .total {
            font-size: 20px;
            color: #007bff;
        }
        .payment-info {
            background: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="invoice-header">
            <h2>ALV Laundry</h2>
            <p>Order ID: <strong>#{{ $order->id }}</strong></p>
        </div>

        <div class="invoice-details">
            <p><strong>Nama Pembeli:</strong> {{ $order->customer->name }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Layanan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->laundryItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }} item / {{ $item->pivot->weight }} kg</td>
                    <td>Rp {{ number_format($item->pivot->quantity * $item->price + $item->pivot->weight * $item->price_per_kg, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-footer">
            <p>Total: <span class="total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
        </div>

        <div class="payment-info">
            <p><strong>Metode Pembayaran:</strong> Tunai</p>
            <p>Terima kasih telah menggunakan layanan kami!</p>
        </div>
    </div>

</body>
</html>
