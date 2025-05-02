<?php
include_once '../php-class-file/Auth.php';
auth('user');

include_once '../php-class-file/SessionManager.php';
include_once '../php-class-file/User.php';
include_once '../php-class-file/UserDetails.php';
include_once '../php-class-file/FileManager.php';

$session = SessionStatic::class;

$user = new User();
$sUser = $session::getObject("user");
$user->user_id = $sUser->user_id;
$user->setValue();

$userDetails = new UserDetails();
$userDetails->user_id = $user->user_id;
$userDetails->setValueByUserId($user->user_id);

$file1 = new FileManager();
$file1->setValueById($userDetails->profile_picture_id);

$file2 = new FileManager();
$file2->setValueById($userDetails->nid_file_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard(User) - View Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard-user.css">
    <style>
        .profile-avatar {
            width: 150px;
            height: 150px;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include_once 'sidebar-user.php'; ?>

    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h5>My Profile</h5>
            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <div class="card__wrapper">
                <div class="card__title-wrap mb-20">
                    <h3 class="table__heading-title mb-4">Account Details</h3>
                </div>
                <div class="card__title-wrap mb-20">
                    <h4 class="table__heading-title mb-3">Account Type: <?php echo ucfirst($user->user_type); ?></h4>
                </div>
                <div class="card__title-wrap mb-20">
                    <h4 class="table__heading-title mb-3">User ID: <?php echo $user->user_id; ?></h4>
                </div>
                <hr>
                <div class="card-body">
                    <!-- Profile Image Section -->
                    <form action="" class="profile-page-form">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label class="form-label mb-md-0">Avatar</label>
                            </div>
                            <div class="col-md-5 d-flex justify-content-center">
                                <div class="d-inline-block position-relative me-4 mb-3 mb-lg-0 account-profile">
                                    <div class="avatar-preview rounded">
                                        <div id="imagePreview" class="rounded-4 profile-avatar"
                                             style="background-image: url('../file/<?php echo $file1->file_new_name; ?>');">
                                        </div>
                                    </div>
                                </div>
                                <!-- You can add an update button here if needed -->
                            </div>
                        </div>
                    </form>
                    <!-- User Information Form -->
                    <form action="#" class="mt-2">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <h5>User ID: <?php echo $user->user_id; ?></h5>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <p>User Type:</p>
                                <p><?php echo ucfirst($user->user_type); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>Full Name:</p>
                                <p><?php echo $userDetails->full_name; ?></p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <p>Email Address:</p>
                                <p><?php echo $user->email; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>Contact No:</p>
                                <p><?php echo $userDetails->contact_no; ?></p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <p>NID Number:</p>
                                <p><?php echo $userDetails->nid_number; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>Division:</p>
                                <p><?php echo $userDetails->division; ?></p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <p>District:</p>
                                <p><?php echo $userDetails->district; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>Address:</p>
                                <p><?php echo $userDetails->address; ?></p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <p>Gender:</p>
                                <p><?php echo $userDetails->gender; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>NID File:</p>
                                <p>
                                    <a href="../file/<?php echo $file2->file_new_name; ?>" target="_blank">
                                        View NID Document
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
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
