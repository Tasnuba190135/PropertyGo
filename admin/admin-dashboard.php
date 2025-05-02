<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;

include_once '../php-class-file/Auth.php';
auth('admin');

include_once '../pop-up.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">



</head>

<body>
    <!-- Popup -->
    <?php
    if ($session::get('msg1')) {
        showPopup($session::get('msg1'));
        $session::delete('msg1');
    }
    ?>

    <?php include_once 'sidebar-admin.php'; ?>
    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">

            <h5>Dashboard</h5>

            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <h1>My Dashboard</h1>
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