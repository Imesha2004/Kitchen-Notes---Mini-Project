<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> d33f2077e7d11852004c4af311a1e4aa9c1fedab
=======
<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
include 'includes/header.php';

// Fetch recipes from DB using Prepared Statement
try {
    $stmt = $pdo->query("SELECT r.*, u.username FROM recipes r JOIN users u ON r.user_id = u.id ORDER BY r.id DESC");
    $recipes = $stmt->fetchAll();
} catch (Exception $e) {
    $recipes = [];
}
?>

<main class="container py-4">
    <!-- Hero / Rotator Section (Wireframe Blueprint 1) -->
    <section class="hero-section text-center my-3">
        <h1 class="display-5 fw-bold text-dark mb-2">What's cooking today?</h1>
        <p class="lead text-muted mb-4">Discover, save, and share your favorite dishes.</p>

        <!-- Search Bar -->
        <div class="search-box-container mb-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                </span>
                <input type="text" id="recipeSearchInput" class="form-control search-input-lg border-start-0 rounded-end-pill" placeholder="Search Bar: search by title or category...">
            </div>
        </div>

        <!-- Featured Image Rotator / Carousel Slider (JS Feature) -->
        <div id="recipeCarousel" class="carousel slide rotator-banner shadow-sm mb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#recipeCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#recipeCarousel" data-bs-slide-to="1"></button>
            </div>
            <div class="carousel-inner rounded-3" style="max-height: 260px;">
                <div class="carousel-item active bg-secondary text-white py-5" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=1200&q=80') center/cover;">
                    <div class="py-4">
                        <h3 class="fw-bold">Explore Handpicked Gourmet Recipes</h3>
                        <p>Share your culinary creations with the community</p>
                    </div>
                </div>
                <div class="carousel-item bg-dark text-white py-5" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1200&q=80') center/cover;">
                    <div class="py-4">
                        <h3 class="fw-bold">Easy 15-Minute Meals for Busy Home Cooks</h3>
                        <p>Filter by prep time and dietary preferences</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Quick-Toggle Category Filter Chips (Wireframe 1) -->
    <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-4">
        <button class="filter-chip active" data-category="All">All</button>
        <button class="filter-chip" data-category="Italian">Italian</button>
        <button class="filter-chip" data-category="Breakfast">Breakfast</button>
        <button class="filter-chip" data-category="Asian">Asian</button>
        <button class="filter-chip" data-category="Dessert">Dessert</button>
    </div>

    <!-- Dynamic 3-Column Recipe Grid -->
    <div class="recipe-grid" id="recipeContainer">
        <?php if (!empty($recipes)): ?>
            <?php foreach ($recipes as $r): ?>
                <div class="recipe-card recipe-card-item" data-title="<?= htmlspecialchars($r['title']) ?>" data-category="<?= htmlspecialchars($r['category']) ?>">
                    <div class="recipe-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80" alt="Recipe Image">
                        <span class="badge-time"><i class="fa-regular fa-clock me-1"></i> <?= $r['cook_time'] ?> min</span>
                    </div>
                    <div class="p-3">
                        <span class="badge bg-light text-primary border mb-2"><?= htmlspecialchars($r['category']) ?></span>
                        <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($r['title']) ?></h5>
                        <p class="text-muted small mb-3"><?= htmlspecialchars(substr($r['short_description'], 0, 85)) ?>...</p>
                        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                            <span class="small text-secondary"><i class="fa-solid fa-user-ninja me-1"></i> <?= htmlspecialchars($r['username']) ?></span>
                            <span class="small text-primary fw-semibold">Servings: <?= $r['servings'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">No recipes found in the database. Be the first to share one!</p>
                <a href="add_recipe.php" class="btn btn-primary rounded-pill px-4">Add Recipe</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

>>>>>>> 5e4b14d0b808c40df0fbdcf98060bc13606aed26
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Notes - Digital Recipe Book</title>
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
                    <a class="nav-link active" href="index.html">Home</a>
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

<!-- Main Landing Content -->
<main class="container py-4">
    <!-- Hero / Rotator Section -->
    <section class="hero-section text-center my-3">
        <h1 class="display-5 fw-bold text-dark mb-2">What's cooking today?</h1>
        <p class="lead text-muted mb-4">Discover, save, and share your favorite dishes.</p>

        <!-- Search Bar -->
        <div class="search-box-container mb-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                </span>
                <input type="text" id="recipeSearchInput" class="form-control search-input-lg border-start-0 rounded-end-pill" placeholder="Search Bar: search by title or category...">
            </div>
        </div>

        <!-- Featured Image Rotator / Carousel Slider -->
        <div id="recipeCarousel" class="carousel slide rotator-banner shadow-sm mb-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#recipeCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#recipeCarousel" data-bs-slide-to="1"></button>
            </div>
            <div class="carousel-inner rounded-3" style="max-height: 260px;">
                <div class="carousel-item active text-white py-5" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=1200&q=80') center/cover;">
                    <div class="py-4">
                        <h3 class="fw-bold">Explore Handpicked Gourmet Recipes</h3>
                        <p>Share your culinary creations with the community</p>
                    </div>
                </div>
                <div class="carousel-item text-white py-5" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1200&q=80') center/cover;">
                    <div class="py-4">
                        <h3 class="fw-bold">Easy 15-Minute Meals for Busy Home Cooks</h3>
                        <p>Filter by prep time and dietary preferences</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Quick-Toggle Category Filter Chips -->
    <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-4">
        <button class="filter-chip active" data-category="All">All</button>
        <button class="filter-chip" data-category="Italian">Italian</button>
        <button class="filter-chip" data-category="Breakfast">Breakfast</button>
        <button class="filter-chip" data-category="Asian">Asian</button>
        <button class="filter-chip" data-category="Dessert">Dessert</button>
    </div>

    <!-- Responsive 3-Column Grid -->
    <div class="recipe-grid" id="recipeContainer">
        <!-- Recipe Card 1 -->
        <div class="recipe-card recipe-card-item" data-title="Creamy Pasta Carbonara" data-category="Italian">
            <div class="recipe-img-wrapper">
                <img src="https://images.unsplash.com/photo-1612874742237-6526221588e3?auto=format&fit=crop&w=600&q=80" alt="Pasta Carbonara">
                <span class="badge-time"><i class="fa-regular fa-clock me-1"></i> 25 min</span>
            </div>
            <div class="p-3">
                <span class="badge bg-light text-primary border mb-2">Italian</span>
                <h5 class="fw-bold text-dark mb-1">Creamy Pasta Carbonara</h5>
                <p class="text-muted small mb-3">Traditional Italian pasta dish made with crispy bacon, eggs, and freshly grated parmesan cheese.</p>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <span class="small text-secondary"><i class="fa-solid fa-user-ninja me-1"></i> Amalka Udayasiri</span>
                    <span class="small text-primary fw-semibold">4 Servings</span>
                </div>
            </div>
        </div>

        <!-- Recipe Card 2 -->
        <div class="recipe-card recipe-card-item" data-title="Avocado Toast with Egg" data-category="Breakfast">
            <div class="recipe-img-wrapper">
                <img src="https://images.unsplash.com/photo-1525351484163-7529414344d8?auto=format&fit=crop&w=600&q=80" alt="Avocado Toast">
                <span class="badge-time"><i class="fa-regular fa-clock me-1"></i> 10 min</span>
            </div>
            <div class="p-3">
                <span class="badge bg-light text-primary border mb-2">Breakfast</span>
                <h5 class="fw-bold text-dark mb-1">Avocado Toast with Egg</h5>
                <p class="text-muted small mb-3">Crispy sourdough toast topped with mashed avocado, poached egg, and red pepper flakes.</p>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <span class="small text-secondary"><i class="fa-solid fa-user-ninja me-1"></i> Imesha Abesingha</span>
                    <span class="small text-primary fw-semibold">2 Servings</span>
                </div>
            </div>
        </div>

        <!-- Recipe Card 3 -->
        <div class="recipe-card recipe-card-item" data-title="Spicy Chicken Ramen" data-category="Asian">
            <div class="recipe-img-wrapper">
                <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=600&q=80" alt="Chicken Ramen">
                <span class="badge-time"><i class="fa-regular fa-clock me-1"></i> 35 min</span>
            </div>
            <div class="p-3">
                <span class="badge bg-light text-primary border mb-2">Asian</span>
                <h5 class="fw-bold text-dark mb-1">Spicy Chicken Ramen</h5>
                <p class="text-muted small mb-3">Rich chicken broth served with ramen noodles, tender chicken slice, soft-boiled egg, and scallions.</p>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <span class="small text-secondary"><i class="fa-solid fa-user-ninja me-1"></i> Amalka Udayasiri</span>
                    <span class="small text-primary fw-semibold">2 Servings</span>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="footer-custom mt-5 py-4 bg-light border-top text-center text-muted">
    <div class="container">
        <p class="mb-1">&copy; 2026 <strong>Kitchen Notes</strong> - Web Application Development Project (ICT 1209).</p>
        <p class="small text-secondary mb-0">Developed by <strong>I.A. Udayasiri</strong> & <strong>A.M.S.C.M Abesingha</strong> | Rajarata University of Sri Lanka</p>
    </div>
</footer>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JavaScript -->
<script src="js/main.js"></script>
</body>
</html>