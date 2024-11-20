<?php
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\OrderController;
use App\Controllers\ReviewController;

// Rute pentru utilizatori
$app->get('/users', [UserController::class, 'getAllUsers']);
$app->post('/users', [UserController::class, 'createUser']);
$app->delete('/users/{id}', [UserController::class, 'deleteUser']);

// Rute pentru produse
$app->get('/products', [ProductController::class, 'getAllProducts']);
$app->post('/products', [ProductController::class, 'addProduct']);
$app->delete('/products/{id}', [ProductController::class, 'deleteProduct']);

// Rute pentru comenzi
$app->post('/orders', [OrderController::class, 'placeOrder']);
$app->get('/orders', [OrderController::class, 'getAllOrders']);

// Rute pentru recenzii
$app->post('/reviews', [ReviewController::class, 'addReview']);
$app->get('/reviews/{product_id}', [ReviewController::class, 'getReviewsByProduct']);
