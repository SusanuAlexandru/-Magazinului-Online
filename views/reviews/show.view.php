<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalii Recenzie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container-rew {
            margin-top: 50px;
        }
        .form-title {
            text-align: center;
            color: #495057;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 18px;
        }
        .review-details {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .rating {
            font-size: 25px;
            color: #f39c12;
        }
        .comment {
            font-size: 18px;
            color: #555;
            margin-top: 15px;
        }
        .mb-3 {
            margin-bottom: 20px;
        }
        .stars {
            display: inline-block;
            margin-left: 10px;
        }
        .stars span {
            font-size: 22px;
            color: #f39c12;
        }
        .stars span.empty {
            color: #ddd;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-rew">
        <div class="form-title">
            Detalii Recenzii pentru Produsul #<?= htmlspecialchars($product->id) ?>
        </div>

        <div class="row justify-content-center">
    <div class="col-md-8">
        <?php if (isset($reviews) && !$reviews->isEmpty()): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="review-details">
                    <div class="mb-3">
                        <strong>Rating:</strong>
                        <span class="rating">
                            <?php
                                // Creăm un array cu 5 stele (poziții)
                                $stars = [1, 2, 3, 4, 5];
                                // Iterăm prin array pentru a crea stelele
                                foreach ($stars as $star) {
                                    if ($star <= $review->rating) {
                                        echo "<span class='star full'>★</span>"; // Stea plină
                                    } else {
                                        echo "<span class='star empty'>☆</span>"; // Stea goală
                                    }
                                }
                            ?>
                        </span>
                    </div>

                    <div class="mb-3">
                        <strong>Comentariu:</strong>
                        <p class="comment"><?= nl2br(htmlspecialchars($review->comment)) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">
                Nu există recenzii pentru acest produs.
            </div>
        <?php endif; ?>
    </div>
</div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
