<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Review;

class ReviewController
{
    // Adăugare recenzie produs
    public function addProductReview(Request $request, Response $response)
    {
        ob_start();
        require '../views/add_review.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Vizualizare recenzii produs
    public function getProductReviews(Request $request, Response $response, array $args)
    {
        $reviews = Review::where('product_id', $args['product_id'])->get();
        ob_start();
        require '../views/product_reviews.view.php';
        $html = ob_get_clean();
        $response->getBody()->write($html);
        return $response;
    }

    // Actualizare recenzie produs
    public function updateProductReview(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $review = Review::find($args['review_id']);
        $review->rating = $data['rating'] ?? $review->rating;
        $review->comment = $data['comment'] ?? $review->comment;
        $review->save();

        return $response
            ->withHeader('Location', '/reviews')
            ->withStatus(302);
    }

    // Ștergere recenzie produs
    public function deleteProductReview(Request $request, Response $response, array $args)
    {
        $review = Review::find($args['review_id']);
        if ($review) {
            $review->delete();
        }

        return $response
            ->withHeader('Location', '/reviews')
            ->withStatus(302);
    }

    // Evaluare produs
    public function rateProduct(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $review = new Review();
        $review->product_id = $data['product_id'];
        $review->user_id = $data['user_id'];
        $review->rating = $data['rating'];
        $review->save();

        return $response
            ->withHeader('Location', '/reviews')
            ->withStatus(302);
    }
}
