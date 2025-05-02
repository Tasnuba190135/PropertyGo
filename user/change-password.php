<?php
include_once '../php-class-file/Auth.php';
auth('user');

include_once '../php-class-file/SessionManager.php';
include_once '../php-class-file/User.php';

$session = SessionStatic::class;
$sUser = $session::getObject("user");

$user = new User();
$user->user_id = $sUser->user_id;
$user->setValue();

$message = ""; // Plain text message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changePassword'])) {
    $currentPassword = $_POST['current-password'];
    $newPassword     = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($newPassword !== $confirmPassword) {
        $message = "New password and confirm password do not match.";
    } else {
        // Check if the current password is correct using password_verify()
        if (!password_verify($currentPassword, $user->password)) {
            $message = "Current password is incorrect.";
        } else {
            // Use the new function to hash and set the new password
            $user->setHashedPassword($newPassword);
            $updateResult = $user->update();
            if ($updateResult === true) {
                $message = "Password changed successfully.";
            } else {
                $message = "Password update failed.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard(User) - Password Change</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard-user.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include_once 'sidebar-user.php'; ?>

    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h5>Password Change</h5>
            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <!-- Display message if available -->
            <?php if (!empty($message)) { ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php } ?>

            <div class="change-password-form">
                <form action="" method="post">
                    <div class="card p-4">
                        <h2 class="table__heading-title mb-4">Change Password</h2>
                        <div class="mb-3">
                            <label for="current-password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current-password" name="current-password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                        </div>
                        <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
