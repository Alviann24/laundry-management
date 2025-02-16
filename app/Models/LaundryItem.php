<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryItem extends Model
{
    protected $fillable = ['name', 'price', 'price_per_kg' ,'image' ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_laundry_item', 'laundry_item_id', 'order_id')
                    ->withPivot('quantity', 'weight')
                    ->withTimestamps();
    }
    
    
    
}
