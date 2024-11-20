<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Definim tabela asociată modelului
    protected $table = 'users';
    
    // Câmpurile care pot fi completate în masă
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
    ];

    // Definim protecția câmpului `password` (hasharea parolei)
    protected $hidden = ['password'];

    // Relația cu modelul `Order` (un utilizator poate plasa mai multe comenzi)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relația cu modelul `Review` (un utilizator poate lăsa mai multe recenzii)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
