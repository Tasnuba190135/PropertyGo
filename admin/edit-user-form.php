<?php
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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include_once 'sidebar-admin.php'; ?>

    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h5>Edit User Form</h5>
            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="container mt-4">
            <!-- Display Message if exists -->
          


        <!-- Content -->
        <!-- <div class="container mt-4"> -->
            <!-- Display message if available -->
            <!-- <?php if (!empty($message)) { ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php } ?> -->
           
              

            <div class="change-password-form">
                <form action="" method="post">
                    <div class="card p-4">
                        <h4 class="table__heading-title mb-4">Fill User ID and Email Address and proceed to edit client's Information </h4>
                        <div class="mb-3">
                            <label for="User ID" class="form-label">User ID</label>
                            <input type="number" class="form-control" id="user_id" name="user_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                        </div> -->
                        <button type="submit" name="changePassword" class="btn btn-primary"><b>Submit to Edit Client's Information</b></button>
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
