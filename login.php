<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Prepared statement to prevent SQL injection
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Regeneration requirement for security
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password credentials.";
        }
    } else {
        $error = "Please fill in both email and password.";
    }
}

include '../includes/header.php';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="form-card shadow-sm">
                <h3 class="fw-bold mb-1 text-center">Welcome Back</h3>
                <p class="text-muted small text-center mb-4">Login to access your recipes</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form action="login.php" method="POST" class="needs-js-validation">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Login</button>
                </form>

                <p class="small text-center text-muted mt-3 mb-0">Don't have an account? <a href="register.php" class="text-primary fw-semibold">Sign up</a></p>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kitchen Notes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top navbar-custom shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark fs-4" href="index.html">
            <i class="fa-solid fa-utensils text-primary"></i>
            <span>Kitchen Notes</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-4 me-4">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_recipe.html">Add Recipe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.html">Browse Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
            </ul>
            <div class="auth-buttons-group">
                <a href="login.html" class="btn btn-outline-dark btn-sm px-3 rounded-pill me-2">Login</a>
                <a href="register.html" class="btn btn-primary btn-sm px-3 rounded-pill">Sign Up</a>
            </div>
        </div>
    </div>
</nav>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="form-card shadow-sm">
                <h3 class="fw-bold mb-1 text-center">Welcome Back</h3>
                <p class="text-muted small text-center mb-4">Login to access your recipes</p>

                <form action="dashboard.html" method="GET" class="needs-js-validation">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Login</button>
                </form>

                <p class="small text-center text-muted mt-3 mb-0">Don't have an account? <a href="register.html" class="text-primary fw-semibold">Sign up</a></p>
            </div>
        </div>
    </div>
</main>

<footer class="footer-custom mt-5 py-4 bg-light border-top text-center text-muted">
    <div class="container">
        <p class="mb-1">&copy; 2026 <strong>Kitchen Notes</strong> - Web Application Development Project (ICT 1209).</p>
        <p class="small text-secondary mb-0">Developed by <strong>I.A. Udayasiri</strong> & <strong>A.M.S.C.M Abesingha</strong> | Rajarata University of Sri Lanka</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
