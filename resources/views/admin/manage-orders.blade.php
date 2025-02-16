@foreach ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->user->name }}</td>
        <td>
            @foreach ($order->laundryItems as $item)
                <span>{{ $item->name }} - {{ $item->pivot->quantity }} item</span>
                <span>{{ $item->name }} - {{ $item->pivot->weight }} kg</span>
            @endforeach
        </td>
        <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
        <td>
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" class="form-control">
                    <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="btn btn-warning">Update Status</button>
            </form>
        </td>
    </tr>
@endforeach
