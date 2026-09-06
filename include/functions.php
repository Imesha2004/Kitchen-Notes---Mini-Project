<?php
// includes/functions.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Sanitize user text inputs
 */
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Require login for protected pages
 */
function require_login() {
    if (!is_logged_in()) {
        header("Location: auth/login.php");
        exit();
    }
}

/**
 * Get logged in user data
 */
function get_logged_user($pdo) {
    if (!is_logged_in()) return null;
    $stmt = $pdo->prepare("SELECT id, username, email, bio FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
?>
