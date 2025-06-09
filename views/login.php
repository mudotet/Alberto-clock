<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --dark-brown: #924F0D;
            --header-brown: #8D4A06;
            --light-brown: #B27F54;
            --black: #010500;
        }
        
        body {
            background-color: var(--light-brown);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            background-color: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }
        
        .login-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .login-title {
            color: var(--dark-brown);
            font-weight: 600;   
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        .form-control:focus {
            border-color: var(--light-brown);
            box-shadow: 0 0 0 0.25rem rgba(178, 127, 84, 0.25);
        }
        
        .btn-brown {
            background-color: var(--dark-brown);
            border: none;
            color: white;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-brown:hover {
            background-color: var(--header-brown);
            transform: translateY(-2px);
        }
        
        .login-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.95rem;
        }
        
        .link-brown {
            color: var(--dark-brown);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .link-brown:hover {
            color: var(--header-brown);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-8 col-lg-6">
                <div class="login-container">
                    <div class="login-header">
                        <h2 class="login-title">Welcome Back</h2>
                        <p class="text-muted">Please login to your account</p>
                    </div>
                    
                    <form action="../controllers/login_controller.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-brown w-100">Login</button>
                    </form>
                    
                    <div class="login-footer">
                        <p>Don't have an account? <a href="../views/register.php" class="link-brown">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 