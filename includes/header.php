<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header with Bootstrap</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css_includes/header.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#">
        <img src="../assets/images/logo.png" alt="LogoWebsite" height="50" style="width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link-custom active" href="../views/index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-custom" href="../views/products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-custom" href="../views/news.php">New</a>
            </li>
                        <li class="nav-item">
                <a class="nav-link-custom" href="../views/about_us.php">About us</a>
            </li>
        </ul>

        <div class="d-flex align-items-center gap-3"> 
        <a href="#" class="nav-link-custom"> 
            <i class="fa-solid fa-cart-shopping fa-lg"></i>
        </a>
        <a href="../views/login.php" class="nav-link-custom">Login</a>
        </div>
    </nav>
  </header>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
