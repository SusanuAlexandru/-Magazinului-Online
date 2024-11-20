<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Order;

class OrderItemController
{
    // Adăugare articol în comandă
    public function addOrderItem(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        
        // Validare date
        if (!isset($data['order_id']) || !isset($data['product_id']) || !isset($data['quantity'])) {
            return $response->withStatus(400)->getBody()->write('Invalid input');
        }

        // Verificăm dacă există comanda și produsul
        $order = Order::find($data['order_id']);
        $product = Product::find($data['product_id']);
        
        if (!$order || !$product) {
            return $response->withStatus(404)->getBody()->write('Order or Product not found');
        }

        // Creăm articolul de comandă
        $orderItem = OrderItem::create([
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
        ]);
        
        $response->getBody()->write('Order item added successfully.');
        return $response->withStatus(201);
    }

    // Obține articolele dintr-o comandă
    public function getOrderItems(Request $request, Response $response, array $args)
    {
        $orderItems = OrderItem::where('order_id', $args['order_id'])->get();
        
        // Verificăm dacă sunt articole
        if ($orderItems->isEmpty()) {
            return $response->withStatus(404)->getBody()->write('No items found for this order');
        }

        $response->getBody()->write($orderItems->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Actualizare cantitate articol comandă
    public function updateOrderItem(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        
        // Găsim articolul de comandă
        $orderItem = OrderItem::find($args['id']);
        
        if (!$orderItem) {
            return $response->withStatus(404)->getBody()->write('Order item not found');
        }

        // Actualizăm cantitatea
        $orderItem->quantity = $data['quantity'] ?? $orderItem->quantity;
        $orderItem->save();

        $response->getBody()->write('Order item updated successfully.');
        return $response;
    }

    // Ștergere articol din comandă
    public function deleteOrderItem(Request $request, Response $response, array $args)
    {
        $orderItem = OrderItem::find($args['id']);
        
        if (!$orderItem) {
            return $response->withStatus(404)->getBody()->write('Order item not found');
        }

        // Ștergem articolul
        $orderItem->delete();

        $response->getBody()->write('Order item deleted successfully.');
        return $response;
    }
}
