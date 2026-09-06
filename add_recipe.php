<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title'] ?? '');
    $category = sanitize_input($_POST['category'] ?? '');
    $short_description = sanitize_input($_POST['short_description'] ?? '');
    $cook_time = (int)($_POST['cook_time'] ?? 0);
    $servings = (int)($_POST['servings'] ?? 0);
    
    $ingredients = isset($_POST['ingredients']) ? json_encode(array_map('sanitize_input', $_POST['ingredients'])) : '[]';
    $instructions = isset($_POST['instructions']) ? json_encode(array_map('sanitize_input', $_POST['instructions'])) : '[]';

    // Set default user if not logged in
    $user_id = $_SESSION['user_id'] ?? 1;

    $image = 'default_recipe.jpg';

    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_name = time() . '_' . basename($_FILES['image']['name']);
        $target_dir = __DIR__ . '/images/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $img_name)) {
            $image = $img_name;
        }
    }

    if (!empty($title) && !empty($category) && $cook_time > 0) {
        try {
            // Prepared statement to prevent SQL injection
            $stmt = $pdo->prepare("INSERT INTO recipes (user_id, title, category, short_description, cook_time, servings, image, ingredients, instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $title, $category, $short_description, $cook_time, $servings, $image, $ingredients, $instructions]);
            $success = "Recipe published successfully!";
        } catch (PDOException $e) {
            $error = "Error saving recipe: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all required fields marked with *.";
    }
}

include 'includes/header.php';
?>

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fa-solid fa-utensils text-primary fs-3"></i>
                    <h2 class="fw-bold mb-0">Share Your Recipe</h2>
                </div>
                <p class="text-muted mb-4">Fill in the details below and inspire the community.</p>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> <?= $success ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Add Recipe Form (Wireframe Blueprint 3) -->
                <form action="add_recipe.php" method="POST" enctype="multipart/form-data" class="needs-js-validation">
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Recipe Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Creamy Mushroom Pasta" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category *</label>
                            <select name="category" class="form-select" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="Italian">Italian</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Asian">Asian</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Healthy">Healthy</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2" placeholder="Brief summary of your dish..."></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cook Time (min) *</label>
                            <input type="number" name="cook_time" class="form-control" placeholder="30" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Servings *</label>
                            <input type="number" name="servings" class="form-control" placeholder="4" min="1" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Upload Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Dynamic Ingredients Section (Wireframe 3) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ingredients *</label>
                        <div id="ingredientsContainer">
                            <div class="input-group mb-2">
                                <input type="text" name="ingredients[]" class="form-control" placeholder="e.g. 250g Spaghetti" required>
                            </div>
                        </div>
                        <button type="button" id="addIngredientBtn" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Add Ingredients
                        </button>
                    </div>

                    <!-- Dynamic Instructions Section (Wireframe 3) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Instructions *</label>
                        <div id="stepsContainer">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Step 1</span>
                                <input type="text" name="instructions[]" class="form-control" placeholder="Describe the first cooking step..." required>
                            </div>
                        </div>
                        <button type="button" id="addStepBtn" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Add Step
                        </button>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mt-3 shadow-sm">
                        Publish Recipe
                    </button>
                </form>

            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Recipe - Kitchen Notes</title>
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
                    <a class="nav-link active" href="add_recipe.html">Add Recipe</a>
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

<!-- Add Recipe Page -->
<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fa-solid fa-utensils text-primary fs-3"></i>
                    <h2 class="fw-bold mb-0">Share Your Recipe</h2>
                </div>
                <p class="text-muted mb-4">Fill in the details below and inspire the community.</p>

                <form action="add_recipe.html" method="GET" class="needs-js-validation">
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Recipe Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Creamy Mushroom Pasta" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category *</label>
                            <select name="category" class="form-select" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="Italian">Italian</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Asian">Asian</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Healthy">Healthy</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="2" placeholder="Brief summary of your dish..."></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Cook Time (min) *</label>
                            <input type="number" name="cook_time" class="form-control" placeholder="30" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Servings *</label>
                            <input type="number" name="servings" class="form-control" placeholder="4" min="1" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Upload Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Dynamic Ingredients Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Ingredients *</label>
                        <div id="ingredientsContainer">
                            <div class="input-group mb-2">
                                <input type="text" name="ingredients[]" class="form-control" placeholder="e.g. 250g Spaghetti" required>
                            </div>
                        </div>
                        <button type="button" id="addIngredientBtn" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Add Ingredients
                        </button>
                    </div>

                    <!-- Dynamic Instructions Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Instructions *</label>
                        <div id="stepsContainer">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Step 1</span>
                                <input type="text" name="instructions[]" class="form-control" placeholder="Describe the first cooking step..." required>
                            </div>
                        </div>
                        <button type="button" id="addStepBtn" class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">
                            <i class="fa-solid fa-plus me-1"></i> Add Step
                        </button>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mt-3 shadow-sm">
                        Publish Recipe
                    </button>
                </form>

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