<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;
// Dynamically determine the directory of this navbar file.
$navbarDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)) . '/';

// if the logout button pressed
if (isset($_GET['logout']) == 1) {
    $session::destroy();
    unset($_GET['logout']);
    // Redirect to the homepage using JavaScript.
    echo '<script type="text/javascript"> window.location.href = "login.php"; </script>';
    exit;
}
?>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
<div class="sidebar-inner">
    <h4 class="text-center my-4">Admin Dashboard</h4>
    <hr>
    <a href="<?php $navbarDir ?>admin-dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a>
    <a href="<?php $navbarDir ?>view-admin-profile.php"><i class="fas fa-layer-group me-2"></i>View Profile</a>
    <a href="<?php $navbarDir ?>edit-admin-profile.php"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</a>
    <a href="<?php $navbarDir ?>change-password.php"><i class="fas fa-file-alt me-2"></i>Change Password</a>
<hr>
    <a href="<?php $navbarDir ?>user-review.php"> <i class="fas fa-layer-group me-2"></i> User Review</a>
    <a href="<?php $navbarDir ?>user-management.php"><i class="fas fa-lock me-2"></i> User Management</a>
    <a href="<?php $navbarDir ?>deleted-user-account.php"> <i class="fas fa-user-times me-2"></i>Delete or retrieve User account</a>
    <hr>
    <?php if ($session::get('admin') == 'super_admin') { ?>
        <a href="<?php $navbarDir ?>admin-review.php"><i class="fas fa-layer-group me-2"></i> Admin Review</a>
        <a href="<?php $navbarDir ?>admin-management.php"><i class="fas fa-lock me-2"></i> Admin Management</a>
        <a href="<?php $navbarDir ?>deleted-admin-account.php"><i class="fas fa-user-times me-2"></i>Delete or retrieve Admin account</a>
        <hr>
    <?php } ?>
  
    <!-- <a href="<//?=$navbarDir ?>edit-user-info.php"><i class="fa-solid fa-pen-to-square me-2"></i> Edit Client's Information</a> -->
    <a href="<?php $navbarDir ?>property-review.php"><i class="fas fa-layer-group me-2"></i>Property Review</a>
    <a href="<?php $navbarDir ?>property-management.php"><i class="fas fa-lock me-2"></i> Property Management</a>
    <a href="<?php $navbarDir ?>pending-property-update.php"><i class="fas fa-clipboard-check me-2"></i> Review Property Update</a>
</div>
    <hr>

    <div class="logout-container">
    <a href="?logout=1" class="mt-auto text-center logout-btn">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
    </div>
</div>