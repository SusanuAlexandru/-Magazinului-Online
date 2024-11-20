<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Definim tabela asociată modelului
    protected $table = 'orders';
    
    // Câmpurile care pot fi completate în masă
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
    ];

    // Dacă dorim să indicăm faptul că datele sunt lucrate cu timestamp-uri
    public $timestamps = true;

    // Relația cu modelul `OrderItem`
    public function items()
    {
        return $this->hasMany(Order::class);
    }

    // Relația cu modelul `User` (un order aparține unui utilizator)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
