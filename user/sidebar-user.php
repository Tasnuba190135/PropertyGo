<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;

// Dynamically determine the directory of this navbar file.
$navbarDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)) . '/';

// Calculate how many levels deep the current file is from the document root.
$depth = count(explode('/', trim($navbarDir, '/')));

// Create the relative path to the root directory.
$rootDir = str_repeat("../", $depth);

// Check if the logout form has been submitted.
if (isset($_GET['logout'])) {
    $session::destroy();  // Destroy the session.
    echo "<script>window.location.href = '{$rootDir}login.php';</script>";
    exit;
}
?>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-inner">
    <h4 class="text-center my-4">My Account</h4>
    <a href="<?= $rootDir ?>index.php">
        <i class="fas fa-tachometer-alt me-2"></i> Home
    </a>
    <a href="<?= $navbarDir ?>dashboard.php">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </a>
    <a href="<?= $navbarDir ?>profile.php">
        <i class="fas fa-layer-group me-2"></i> My Profile
    </a>
    <a href="<?= $navbarDir ?>edit-profile.php">
        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
    </a>
    <a href="<?= $navbarDir ?>property-history.php">
        <i class="fas fa-lock me-2"></i> Property History
    </a>
    <!-- <a href="<?//= $navbarDir ?>property-go-wallet.php">
        <i class="fas fa-file-alt me-2"></i> Property Go Wallet
    </a> -->
    <a href="<?= $navbarDir ?>change-password.php">
        <i class="fas fa-file-alt me-2"></i> Password Change
    </a>
    </div>

    <!-- Logout Form -->
    <form method="POST" action="" >
    <a href="?logout=1" class="mt-auto text-center logout-btn">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
    </form>
</div>
