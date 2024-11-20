<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Definim tabela asociată modelului
    protected $table = 'reviews';
    
    // Câmpurile care pot fi completate în masă
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    // Relația cu modelul `Product` (o recenzie aparține unui produs)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relația cu modelul `User` (o recenzie aparține unui utilizator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
