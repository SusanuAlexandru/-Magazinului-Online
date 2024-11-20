<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Numele tabelei asociate modelului
    protected $table = 'order_items';

    // Câmpurile care pot fi completate (fillables)
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity'
    ];

    // Definirea relației cu modelul `Order`
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Definirea relației cu modelul `Product`
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Adăugăm o metodă pentru a calcula totalul unui articol
    public function getTotalPrice()
    {
        // Calculăm prețul total pe baza produsului și a cantității
        $product = $this->product; // obținem produsul asociat
        return $product ? $product->price * $this->quantity : 0;
    }
}
