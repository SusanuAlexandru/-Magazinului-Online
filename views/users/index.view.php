<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin Echipamente Sportive</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero-section {
            background-image: url('/start.jpg');
            color: black;
            object-fit: cover;
            padding: 200px 0;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .card img {
            transition: transform 0.3s ease;
        }
        .card img:hover {
            transform: scale(1.05);
        }
        .review-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #212529;
            color: #adb5bd;
        }
        footer a {
            color: #ffc107;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .review-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .review-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h4 {
        color: #007bff;
        font-weight: 600;
    }

    p {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.5;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    </style>
</head>
<body>
<?php include 'nav.view.php'; ?>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <h1>Transformă-ți pasiunea în performanță!</h1>
            <p class="lead mt-3">Descoperă echipamente sportive de top pentru fiecare sport.</p>
        </div>
    </header>
    <?php
        include __DIR__ . '/../products/index.view.php';
    ?>

   
    <!-- Secțiune Inform -->
    <section class="py-5 bg-light" style="background-color: #f4f6f9;">
    <div class="container" id="reviews-section">
        <h2 class="text-center mb-5" style="font-family: 'Arial', sans-serif; color: #343a40; font-size: 30px;">Despre Magazinul nostru de Produse Sportive</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="review-card text-center p-4 rounded shadow-sm" style="background-color: #ffffff; border: 1px solid #e0e0e0;">
                    <h4 class="mb-3" style="color: #495057; font-size: 1.25rem; font-weight: bold;">Produse de calitate</h4>
                    <p style="color: #555; font-size: 1rem;">La SprintX, oferim echipamente sportivă de înaltă calitate pentru o varietate de activități: alergare, fitness, fotbal, baschet, și multe altele. Indiferent de sportul preferat, avem ceea ce îți trebuie pentru a-ți îmbunătăți performanțele!</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="review-card text-center p-4 rounded shadow-sm" style="background-color: #ffffff; border: 1px solid #e0e0e0;">
                    <h4 class="mb-3" style="color: #495057; font-size: 1.25rem; font-weight: bold;">Livrare rapidă și siguranță în tranzacții</h4>
                    <p style="color: #555; font-size: 1rem;">Ne asigurăm că produsele comandate ajung rapid și în siguranță la tine acasă, prin serviciile noastre de livrare rapide. De asemenea, toate plățile sunt securizate, iar procesul de cumpărare este simplu și rapid.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="review-card text-center p-4 rounded shadow-sm" style="background-color: #ffffff; border: 1px solid #e0e0e0;">
                    <h4 class="mb-3" style="color: #495057; font-size: 1.25rem; font-weight: bold;">Politica de returnare simplă și eficientă</h4>
                    <p style="color: #555; font-size: 1rem;">În cazul în care nu ești mulțumit de produsul achiziționat, îți oferim o politică de returnare ușor de utilizat. Poți returna produsele în termen de 30 de zile și îți vom înapoia banii sau schimbăm produsul cu altul.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer class="py-4 text-center">
        <div class="container">
            <p>&copy; 2024 SportStore. Toate drepturile rezervate.</p>
            <a href="#">Termeni și Condiții</a> | <a href="#">Politica de Confidențialitate</a>
        </div>
    </footer>

</body>
</html>
