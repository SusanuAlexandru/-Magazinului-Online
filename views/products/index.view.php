<?php 
use App\Models\User;

?>
<style>
    body {
        background-color: #f3f4f6;
    }
    .card {
        
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .card img {
        border-bottom: 2px solid #007bff;
        height: 200px;
        object-fit: cover;
    }
    .card-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #007bff;
    }
    .card-text {
        color: #6c757d;
        margin-bottom: 1rem;
    }
    .price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #28a745;
    }
    .btn {
        border-radius: 30px;
    }
    .btn-sm {
        padding: 0.4rem 1rem;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="row mb-4 text-center">
        <div class="col">
            <h1 class="text-dark">Product Catalog</h1>
        </div>
    </div>

    <!-- Buttons to navigate to "Add New Product" and "Add New Category" -->
    <?php if (isset($_SESSION['user_id']) && User::find($_SESSION['user_id'])->isAdmin()): ?>
        <div class="row mb-4">
            <div class="col text-center">
                <a href="/products/create" class="btn btn-success me-2">Add New Product</a>
                <a href="/categories/create" class="btn btn-success">Add New Category</a>
            </div>
        </div>
    <?php endif; ?>

        <!-- Căutare și filtrare -->
        <div class="row mb-4">
            <div class="col">
                <form action="/products" method="get" class="d-flex justify-content-center">
                    <input type="text" name="query" class="form-control w-50 me-2" placeholder="Search products" value="<?= htmlspecialchars($query ?? '') ?>">
                    <select name="categorie_id" class="form-select w-25 me-2">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= isset($categoryId) && $categoryId == $category->id ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

    <!-- Product cards -->
    <div class="row g-4 mt-5">
        <?php if ($products->count() > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-3">
                    <div class="card">
                        <!-- Product Image -->
                        <?php
                        $imagePath = '/uploads/' . htmlspecialchars($product->image);
                        ?>
                        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product->name) ?>" class="card-img-top">

                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product->name) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product->description) ?></p>
                            <p class="price"><?= $product->price ?> MDL</p>
                            <div class="d-flex justify-content-between">
                                <?php if (isset($_SESSION['user_id']) && User::find($_SESSION['user_id'])->isAdmin()): ?>
                                    <a href="/products/edit/<?= $product->id ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/products/delete/<?= $product->id ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        <input type="hidden" name="_METHOD" value="DELETE"/>
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                <?php endif; ?>
                                <a href="/products/show/<?= $product->id ?>" class="btn btn-info btn-sm">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">There are no products available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
