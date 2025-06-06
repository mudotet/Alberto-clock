<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - Alberto Clock</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/news.css">
</head>
<body>
    <!-- Include Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Main Content -->
    <main class="container my-5">
        <h1 class="text-center mb-4 fw-bold">Latest News</h1>
        <div class="row g-4">
            <!-- News Article 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/images/Thumnail/5-e1691031880893-646x400.jpg" class="card-img-top" alt="New Collection Launch">
                    <div class="card-body">
                        <h5 class="card-title">New Collection Launch</h5>
                        <p class="card-text">Discover our latest luxury watch collection, featuring innovative designs and timeless craftsmanship.</p>
                        <p class="text-muted small">Published on June 1, 2025</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- News Article 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/images/Thumnail/one_of_the_worlds_costliest_watches-_patek_philippe_1977.jpg" class="card-img-top" alt="Watchmaking Event">
                    <div class="card-body">
                        <h5 class="card-title">Exclusive Watchmaking Event</h5>
                        <p class="card-text">Join us for an exclusive event showcasing the art of watchmaking with our master artisans.</p>
                        <p class="text-muted small">Published on May 28, 2025</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- News Article 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/images/Thumnail/space_invaders-_omega_1967_0_rectangle_1711332223.jpg.webp" class="card-img-top" alt="Sustainability Initiative">
                    <div class="card-body">
                        <h5 class="card-title">Sustainability Initiative</h5>
                        <p class="card-text">Learn about our commitment to sustainable practices in luxury watch production.</p>
                        <p class="text-muted small">Published on May 20, 2025</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Footer -->
    <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>