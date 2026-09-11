<?php
// Presentational header only — does not start or modify the session.
$__viweka_logged_in = (session_status() === PHP_SESSION_ACTIVE) && isset($_SESSION['user_id']);
$__viweka_username = $__viweka_logged_in && isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<header class="site-header">
    <a class="brand" href="<?php echo $__viweka_logged_in ? 'dashboard.php' : 'login.php'; ?>">
        <img src="images/logo.jpeg" alt="Viweka Hospital logo">
        <span class="brand-text">
            <span class="name">Viweka Hospital</span>
            <span class="tagline">Management System</span>
        </span>
    </a>
    <?php if ($__viweka_logged_in): ?>
    <div class="user-box">
        <span class="welcome">Welcome, <?php echo htmlspecialchars($__viweka_username); ?></span>
        <a href="logout.php">Logout</a>
    </div>
    <?php endif; ?>
</header>
