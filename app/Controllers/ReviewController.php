<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class ReviewController
{
    // Adaugă o recenzie
    public function addReview(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Introducem recenzia în baza de date
        DB::table('reviews')->insert([
            'product_id' => $data['product_id'],
            'user_id' => $data['user_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'],
            'created_at' => date('Y-m-d H:i:s') // Înlocuim now() cu date()
        ]);

        // Returnăm un răspuns de succes
        $response->getBody()->write('Review added successfully.');
        return $response->withStatus(201);
    }


    // Obține recenzii pentru un produs
    public function getReviewsByProduct(Request $request, Response $response, $args): Response
    {
        $productId = $args['product_id'];
        $reviews = DB::table('reviews')->where('product_id', $productId)->get();

        $response->getBody()->write($reviews->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }
}
