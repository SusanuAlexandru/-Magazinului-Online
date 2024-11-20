<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;

class ProductController
{
    // Detalii produs
    public function getProductDetails(Request $request, Response $response, array $args)
    {
        $product = Product::find($args['id']);
        ob_start();
        require '../views/product_details.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Căutare produse
    public function searchProducts(Request $request, Response $response)
    {
        $query = $request->getQueryParams()['query'];
        $products = Product::where('name', 'like', "%$query%")
                           ->orWhere('description', 'like', "%$query%")
                           ->get();

        ob_start();
        require '../views/search_results.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Produse dintr-o categorie
    public function getProductProducts(Request $request, Response $response, array $args)
    {
        $product = Product::find($args['product_id']);
        $products = $product->products;
        ob_start();
        require '../views/product_products.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Adăugare în coș
    public function addToCart(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        // Adăugare produs în coș logică
        return $response
            ->withHeader('Location', '/cart')
            ->withStatus(302);
    }

    // Eliminare din coș
    public function removeFromCart(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        // Eliminare produs din coș logică
        return $response
            ->withHeader('Location', '/cart')
            ->withStatus(302);
    }
}
