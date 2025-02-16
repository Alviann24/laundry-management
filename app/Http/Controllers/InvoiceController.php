<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function generateInvoice($orderId)
    {
        $order = Order::with('customer', 'laundryItems')->findOrFail($orderId);
    
        $pdf = Pdf::loadView('invoices.invoice', compact('order'));
    
        return $pdf->stream('invoice_order_' . $order->id . '.pdf');
    }
    
}
