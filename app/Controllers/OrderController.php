<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class OrderController
{
    // Plasează o comandă
    public function placeOrder(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
    
        // Folosim `date()` pentru a obține data curentă în formatul potrivit bazei de date
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $data['user_id'],
            'order_date' => date('Y-m-d H:i:s'), 
            'status' => 'pending',
        ]);
    
        // Iterăm prin produsele din comandă și le adăugăm în tabela `order_items`
        foreach ($data['products'] as $product) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }
    
        // Returnăm un răspuns pentru client
        $response->getBody()->write('Order placed successfully.');
        return $response->withStatus(201);
    }
    

    // Obține toate comenzile
    public function getAllOrders(Request $request, Response $response): Response
    {
        $orders = DB::table('orders')->get();
        $response->getBody()->write($orders->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }
}
