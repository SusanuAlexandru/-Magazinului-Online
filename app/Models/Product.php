<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Definim tabela asociată modelului
    protected $table = 'products';
    
    // Câmpurile care pot fi completate în masă
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'Product_id',
    ];

    // Relația cu modelul `Product` (un produs aparține unei categorii)
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relația cu modelul `OrderItem` (un produs poate fi asociat cu mai multe comenzi)
    public function orderItems()
    {
        return $this->hasMany(Order::class);
    }

    // Relația cu modelul `Review` (un produs poate avea mai multe recenzii)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
