<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends Model
{
    use HasFactory;
    protected $table = 'checkout_items';
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
