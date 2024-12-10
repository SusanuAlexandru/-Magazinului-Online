<?php
namespace App\Controllers;

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class OrderController
{
    // Afișează coșul de cumpărături
    public function cart(Request $request, Response $response)
    {
        $cart = $_SESSION['cart'] ?? []; // Preia coșul din sesiune
        $products = Product::all();
        
        ob_start();
        require_once '../views/orders/index.view.php'; // Vizualizare coș
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Adaugă un produs în coș
    public function addToCart(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $productId = (int) $data['product_id'];
        $quantity = (int) $data['quantity'];

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = [
                'product_id' => $productId,
                'quantity' => 0,
            ];
        }

        $_SESSION['cart'][$productId]['quantity'] += $quantity;

        return $response->withHeader('Location', '/cart')->withStatus(303);
    }

    // Actualizează cantitatea unui produs în coș
    public function updateCart(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        foreach ($data['cart'] as $productId => $quantity) {
            $productId = (int) $productId;
            $quantity = max(0, (int) $quantity);

            if ($quantity === 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId]['quantity'] = $quantity;
            }
        }

        return $response->withHeader('Location', '/cart')->withStatus(302);
    }
    public function store(Request $request, Response $response)
    {
        // Obține informațiile despre utilizator (presupunem că este deja logat în sesiune)
        $userId = $_SESSION['user_id'] ?? null; // Adaptează acest cod la modul în care gestionezi autentificarea utilizatorului

        if (!$userId) {
            return $response->withStatus(403)->getBody()->write('Nu sunteți autentificat.');
        }

        // Preia produsele din coșul de cumpărături din sesiune
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            return $response->withStatus(400)->getBody()->write('Coșul de cumpărături este gol.');
        }

        // Creează comanda
        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending', // Statusul inițial al comenzii
            'order_date' => now(), // Data comenzii
        ]);

        // Adaugă articolele din coș în tabela order_items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
            ]);
        }

        // Șterge coșul după ce comanda a fost plasată
        unset($_SESSION['cart']);

        // Redirecționează utilizatorul către o pagină de succes sau detalii comandă
        return $response->withHeader('Location', '/cart')->withStatus(303);
    }

    // Șterge un produs din coș
    public function removeFromCart(Request $request, Response $response, $args)
    {
        $productId = (int) $args['product_id'];
        unset($_SESSION['cart'][$productId]);

        return $response->withHeader('Location', '/cart')->withStatus(302);
    }

   
}

