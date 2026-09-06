<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Fetch profile or logged-in user info
$user = get_logged_user($pdo);
$username = $user ? $user['username'] : 'Amalka Udayasiri';
$bio = $user['bio'] ?? 'Home Cook · 45 recipes published';

// Fetch recipes
try {
    $stmt = $pdo->query("SELECT * FROM recipes ORDER BY id DESC");
    $recipes = $stmt->fetchAll();
} catch (Exception $e) {
    $recipes = [];
}

include 'includes/header.php';
?>

<main class="container py-4">
    <!-- User Profile Header Card (Wireframe Blueprint 2) -->
    <div class="profile-card mb-4">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            <div class="avatar-placeholder shadow-sm">
                <?= strtoupper(substr($username, 0, 1)) ?>
            </div>
            <div class="flex-grow-1 text-center text-md-start">
                <h3 class="fw-bold mb-1"><?= htmlspecialchars($username) ?></h3>
                <p class="text-muted mb-2"><i class="fa-solid fa-cookie-bite text-warning me-1"></i> <?= htmlspecialchars($bio) ?></p>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-4 text-dark fw-semibold mt-3">
                    <div><span class="fs-5 fw-bold text-primary"><?= count($recipes) + 44 ?></span> <span class="text-muted small">Recipes</span></div>
                    <div><span class="fs-5 fw-bold text-primary">128</span> <span class="text-muted small">Favorites</span></div>
                    <div><span class="fs-5 fw-bold text-primary">1.2k</span> <span class="text-muted small">Followers</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation Bar (Wireframe 2) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom pb-3 mb-4">
        <div class="d-flex gap-2">
            <button class="filter-chip active me-2">My Recipes</button>
            <button class="filter-chip me-2">Favorites</button>
            <a href="contact.php" class="filter-chip text-decoration-none">Contact</a>
        </div>
        <a href="index.php" class="text-decoration-none text-primary fw-semibold small">View All <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>

    <!-- Grid matching Wireframe 2 -->
    <div class="recipe-grid">
        <?php foreach ($recipes as $r): ?>
            <div class="recipe-card">
                <div class="recipe-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=600&q=80" alt="Recipe preview">
                    <span class="badge-time"><?= $r['cook_time'] ?> min</span>
                </div>
                <div class="p-3">
                    <span class="badge bg-light text-primary border mb-2"><?= htmlspecialchars($r['category']) ?></span>
                    <h5 class="fw-bold mb-1"><?= htmlspecialchars($r['title']) ?></h5>
                    <p class="text-muted small mb-3"><?= htmlspecialchars($r['short_description']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile & Dashboard - Kitchen Notes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation Bar -->
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
                    <a class="nav-link active" href="dashboard.html">Browse Recipes</a>
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

<!-- User Profile Dashboard -->
<main class="container py-4">
    <!-- Profile Card Component -->
    <div class="profile-card mb-4">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            <div class="avatar-placeholder shadow-sm">
                A
            </div>
            <div class="flex-grow-1 text-center text-md-start">
                <h3 class="fw-bold mb-1">Amalka Udayasiri</h3>
                <p class="text-muted mb-2"><i class="fa-solid fa-cookie-bite text-warning me-1"></i> Home Cook · 45 recipes published</p>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-4 text-dark fw-semibold mt-3">
                    <div><span class="fs-5 fw-bold text-primary">45</span> <span class="text-muted small">Recipes</span></div>
                    <div><span class="fs-5 fw-bold text-primary">128</span> <span class="text-muted small">Favorites</span></div>
                    <div><span class="fs-5 fw-bold text-primary">1.2k</span> <span class="text-muted small">Followers</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation Bar -->
    <div class="d-flex flex-wrap align-items-center justify-content-between border-bottom pb-3 mb-4">
        <div class="d-flex gap-2">
            <button class="filter-chip active me-2">My Recipes</button>
            <button class="filter-chip me-2">Favorites</button>
            <a href="contact.html" class="filter-chip text-decoration-none">Contact</a>
        </div>
        <a href="index.html" class="text-decoration-none text-primary fw-semibold small">View All <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>

    <!-- Grid matching -->
    <div class="recipe-grid">
        <div class="recipe-card">
            <div class="recipe-img-wrapper">
                <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=600&q=80" alt="Recipe preview">
                <span class="badge-time">25 min</span>
            </div>
            <div class="p-3">
                <span class="badge bg-light text-primary border mb-2">Italian</span>
                <h5 class="fw-bold mb-1">Classic Creamy Carbonara</h5>
                <p class="text-muted small mb-3">Traditional Italian pasta dish with pancetta and fresh parmesan.</p>
            </div>
        </div>
        <div class="recipe-card">
            <div class="recipe-img-wrapper">
                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=600&q=80" alt="Recipe preview">
                <span class="badge-time">15 min</span>
            </div>
            <div class="p-3">
                <span class="badge bg-light text-primary border mb-2">Healthy</span>
                <h5 class="fw-bold mb-1">Mediterranean Green Salad</h5>
                <p class="text-muted small mb-3">Fresh cucumbers, cherry tomatoes, feta cheese, and extra virgin olive oil.</p>
            </div>
        </div>
        <div class="recipe-card">
            <div class="recipe-img-wrapper">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=600&q=80" alt="Recipe preview">
                <span class="badge-time">30 min</span>
            </div>
            <div class="p-3">
                <span class="badge bg-light text-primary border mb-2">Italian</span>
                <h5 class="fw-bold mb-1">Wood-fired Margherita Pizza</h5>
                <p class="text-muted small mb-3">Fresh basil leaves, mozzarella cheese, and rich tomato passata sauce.</p>
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