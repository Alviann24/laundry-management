<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',  // Menambahkan user_id
        'created_by', // Menambahkan created_by
        'total_price',
        'status',
    ];

    public function laundryItems()
    {
        return $this->belongsToMany(LaundryItem::class, 'order_laundry_item', 'order_id', 'laundry_item_id')
                    ->withPivot('quantity', 'weight') // Tambahkan kolom pivot
                    ->withTimestamps(); // Jika tabel pivot memiliki kolom created_at dan updated_at
    }
    
    
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function details(): BelongsToMany
    {
        return $this->belongsToMany(
            LaundryItem::class,    // Model LaundryItem
            'order_laundry_item',  // Nama tabel pivot
            'order_id',            // Foreign key di tabel pivot yang merujuk ke tabel orders
            'laundry_item_id'      // Foreign key di tabel pivot yang merujuk ke tabel laundry_items
        )->withPivot('quantity', 'weight'); // Menambahkan field tambahan di tabel pivot
    }
    

}

