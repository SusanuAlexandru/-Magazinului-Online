<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class ProductController
{
    // Obține toate produsele
    public function getAllProducts(Request $request, Response $response): Response
    {
        $products = DB::table('products')->get();
        $response->getBody()->write($products->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Adaugă un produs
    public function addProduct(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        DB::table('products')->insert([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'category_id' => $data['category_id'],
            'brand' => $data['brand'],
        ]);

        $response->getBody()->write('Product added successfully.');
        return $response->withStatus(201);
    }

    // Șterge un produs
    public function deleteProduct(Request $request, Response $response, array $args): Response
    {
        $productId = $args['id'];
        DB::table('products')->where('id', $productId)->delete();

        $response->getBody()->write('Product deleted successfully.');
        return $response;
    }
}
