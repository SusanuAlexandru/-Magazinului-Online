<?php

namespace App\Controllers;

session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;

class ReviewController
{
    // Afișează toate recenziile pentru un produs
    public function index(Request $request, Response $response, $args)
    {
        $productId = $args['product_id'];

        // Validare: produsul trebuie să existe
        $product = Product::find($productId);
        if (!$product) {
            return $response->withStatus(404)->write('Produsul nu există.');
        }

        $reviews = Review::where('product_id', $productId)
            ->orderBy('review_date', 'desc')
            ->get();

        $user = User::find($_SESSION['user_id'] ?? null);

        ob_start();
        require '../views/reviews/index.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Afișează formularul pentru adăugarea unei recenzii
    public function create(Request $request, Response $response, $args)
    {
        $productId = $args['product_id'];

        // Validare: produsul trebuie să existe
        $product = Product::find($productId);
        if (!$product) {
            return $response->withStatus(404)->write('Produsul nu există.');
        }

        ob_start();
        require '../views/reviews/create.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }
    

    // Salvează o recenzie în baza de date
    public function store(Request $request, Response $response, $args)
    {
        $productId = $args['product_id'];
        $userId = $_SESSION['user_id'] ?? null;

        // Validare: utilizatorul trebuie să fie autentificat
        if (!$userId) {
            return $response->withHeader('Location', "/login")->withStatus(302);
        }

        // Validare: produsul trebuie să existe
        $product = Product::find($productId);
        if (!$product) {
            $response->getBody()->write('Produsul nu există.');
            return $response->withStatus(404);
            
        }

        // Obține datele din formular
        $data = $request->getParsedBody();
        $rating = $data['rating'] ?? null;
        $comment = $data['comment'] ?? null;

        // Validare: rating-ul trebuie să fie între 1 și 5
        if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
            return $response->withStatus(400)->write('Rating-ul trebuie să fie între 1 și 5.');
        }

        // Creează și salvează recenzia
        $review = new Review();
        $review->product_id = $productId;
        $review->user_id = $userId;
        $review->rating = (int)$rating;
        $review->comment = htmlspecialchars($comment);
        $review->review_date = date('Y-m-d H:i:s');
        $review->save();

        // Redirecționează utilizatorul înapoi la pagina produsului
        return $response->withHeader('Location', "/products/show/$productId")->withStatus(302);
    }


    // Afișează o recenzie specifică
    public function show(Request $request, Response $response, $args)
    {
        // Verificăm dacă product_id este prezent în array-ul $args
        if (isset($args['id'])) {
            $productId = $args['id'];
        } else {
            // În caz de eroare, trimitem un mesaj
            $response->getBody()->write("Product ID nu a fost găsit.");
            return $response;
        }
    
        // Căutăm produsul pe baza product_id
        $product = Product::find($productId);
    
        if (!$product) {
            $response->getBody()->write("Produsul nu a fost găsit.");
            return $response;
        }
    
        // Căutăm toate recenziile asociate produsului
        $reviews = Review::where('product_id', $productId)->get();
    
        // Verificăm dacă există recenzii
        if ($reviews->isEmpty()) {
            $response->getBody()->write("Nu există recenzii pentru acest produs.");
            return $response;
        }
    
        // Pasăm produsul și recenziile la vizualizare
        ob_start();
        require '../views/products/show.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }
    



    // Afișează formularul pentru editarea unei recenzii
    public function edit(Request $request, Response $response, $args)
    {
        $review = Review::find($args['id']);

        ob_start();
        require '../views/reviews/edit.view.php'; // Formular pentru editare
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Actualizează o recenzie în baza de date
    public function update(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $review = Review::find($args['id']);
        $review->rating = (int) $data['rating'];
        $review->comment = htmlspecialchars($data['comment']);
        $review->save();

        return $response->withHeader('Location', "/reviews/index/{$review->product_id}")->withStatus(302);
    }

    // Șterge o recenzie
    public function delete(Request $request, Response $response, $args)
    {
        $review = Review::find($args['id']);
        $review->delete();

        return $response->withHeader('Location', "/reviews/index/{$review->product_id}")->withStatus(302);
    }
}
