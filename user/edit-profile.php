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

$message = ""; // Plain text message

// Process profile picture update
if (isset($_POST['profilePictureUpdate'])) {
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $newFile = new FileManager();
        $newFile->file_owner_id = $user->user_id;
        $uploadResult = $newFile->doOp($_FILES['avatar']);
        if ($uploadResult == 1) {
            $newFileId = $newFile->insert();
            if ($newFileId) {
                $userDetails->profile_picture_id = $newFileId;
                if ($userDetails->update()) {
                    $message = "Profile picture updated successfully.";
                } else {
                    $message = "Failed to update user details.";
                }
            } else {
                $message = "Failed to save file record.";
            }
        } else {
            $message = "Failed to upload file. Please try again.";
        }
    } else {
        $message = "No file selected or file upload error.";
    }
}

// Process user details update (editable fields only)
if (isset($_POST['userDetailsUpdate'])) {
    // Update only editable fields
    $userDetails->contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : $userDetails->contact_no;
    $userDetails->division   = isset($_POST['division'])   ? $_POST['division']   : $userDetails->division;
    $userDetails->district   = isset($_POST['district'])   ? $_POST['district']   : $userDetails->district;
    $userDetails->address    = isset($_POST['address'])    ? $_POST['address']    : $userDetails->address;
    $userDetails->gender     = isset($_POST['gender'])     ? $_POST['gender']     : $userDetails->gender;
    
    if ($userDetails->update()) {
        $message = "User details updated successfully.";
    } else {
        $message = "Failed to update user details.";
    }
}

// Refresh userDetails and file objects after processing
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
    <title>Dashboard(User) - Edit Profile</title>
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
            <h5>Edit Profile</h5>
            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="container mt-4">
            <!-- Display Message if exists -->
            <?php if (!empty($message)) { ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <div class="card__wrapper">
                <!-- Account Details Header -->
                <div class="card__title-wrap mb-20">
                    <h3 class="table__heading-title mb-4">Account Details</h3>
                    <h4 class="table__heading-title mb-3">Account Type: <?php echo ucfirst($user->user_type); ?></h4>
                    <h4 class="table__heading-title mb-3">User ID: <?php echo $user->user_id; ?></h4>
                </div>
                <hr>

                <!-- Form 1: Profile Image Update -->
                <form action="" method="post" enctype="multipart/form-data" class="profile-page-form mb-4">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Avatar</label>
                        </div>
                        <div class="col-md-9">
                            <!-- Avatar Preview -->
                            <div class="mb-3">
                                <div id="imagePreview" class="rounded-4 profile-avatar"
                                    style="background-image: url('../file/<?php echo $file1->file_new_name; ?>');">
                                </div>
                            </div>
                            <!-- Bootstrap Input Group for File Input -->
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="imageUpload" name="avatar" accept="image/*">
                                <label class="input-group-text" for="imageUpload">
                                    <i class="fa-solid fa-pen-to-square"></i> Change
                                </label>
                            </div>
                            <button type="submit" name="profilePictureUpdate" class="btn btn-primary">Update Profile Picture</button>
                        </div>
                    </div>
                </form>

                <!-- Form 2: User Details Update -->
                <form action="" method="post" class="profile-page-form">
                    <!-- Info Alert -->
                    <div class="alert alert-info">
                        <strong>Note:</strong> Full Name, Email Address, NID Number, and NID File cannot be changed here.
                        Please contact the administrator for modifications.
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label class="form-label">User ID:</label>
                            <p><?php echo $user->user_id; ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">User Type:</label>
                            <p><?php echo ucfirst($user->user_type); ?></p>
                        </div>
                    </div>
                    <!-- Read-Only Fields -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="full_name" value="<?php echo $userDetails->full_name; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address:</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>" disabled>
                        </div>
                    </div>
                    <!-- Editable Contact Number and NID Number (read-only) -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label for="contactNo" class="form-label">Contact No:</label>
                            <input type="text" class="form-control" id="contactNo" name="contact_no" value="<?php echo $userDetails->contact_no; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NID Number:</label>
                            <input type="text" class="form-control" name="nid_number" value="<?php echo $userDetails->nid_number; ?>" disabled>
                        </div>
                    </div>
                    <!-- Editable Location and Address Fields -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label for="division" class="form-label">Division:</label>
                            <select class="form-control" id="division" name="division" required>
                                <option value="">Select</option>
                                <option value="Rajshai" <?php if (strtolower($userDetails->division)=="rajshai") echo "selected"; ?>>Rajshai</option>
                                <option value="Dhaka" <?php if (strtolower($userDetails->division)=="dhaka") echo "selected"; ?>>Dhaka</option>
                                <option value="Khulna" <?php if (strtolower($userDetails->division)=="khulna") echo "selected"; ?>>Khulna</option>
                                <option value="Sylhet" <?php if (strtolower($userDetails->division)=="sylhet") echo "selected"; ?>>Sylhet</option>
                                <option value="Chittagong" <?php if (strtolower($userDetails->division)=="chittagong") echo "selected"; ?>>Chittagong</option>
                                <option value="Barisal" <?php if (strtolower($userDetails->division)=="barisal") echo "selected"; ?>>Barisal</option>
                                <option value="Dinajpur" <?php if (strtolower($userDetails->division)=="dinajpur") echo "selected"; ?>>Dinajpur</option>
                                <option value="Rangpur" <?php if (strtolower($userDetails->division)=="rangpur") echo "selected"; ?>>Rangpur</option>
                                <option value="Mymensingh" <?php if (strtolower($userDetails->division)=="mymensingh") echo "selected"; ?>>Mymensingh</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="district" class="form-label">District:</label>
                            <select class="form-control" id="district" name="district" required>
                                <option value="">Select</option>
                                <option value="Rajshai" <?php if (strtolower($userDetails->district)=="rajshai") echo "selected"; ?>>Rajshai</option>
                                <option value="Dhaka" <?php if (strtolower($userDetails->district)=="dhaka") echo "selected"; ?>>Dhaka</option>
                                <option value="Khulna" <?php if (strtolower($userDetails->district)=="khulna") echo "selected"; ?>>Khulna</option>
                                <option value="Sylhet" <?php if (strtolower($userDetails->district)=="sylhet") echo "selected"; ?>>Sylhet</option>
                                <option value="Chittagong" <?php if (strtolower($userDetails->district)=="chittagong") echo "selected"; ?>>Chittagong</option>
                                <option value="Barisal" <?php if (strtolower($userDetails->district)=="barisal") echo "selected"; ?>>Barisal</option>
                                <option value="Dinajpur" <?php if (strtolower($userDetails->district)=="dinajpur") echo "selected"; ?>>Dinajpur</option>
                                <option value="Rangpur" <?php if (strtolower($userDetails->district)=="rangpur") echo "selected"; ?>>Rangpur</option>
                                <option value="Mymensingh" <?php if (strtolower($userDetails->district)=="mymensingh") echo "selected"; ?>>Mymensingh</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $userDetails->address; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if (strtolower($userDetails->gender)=="male") echo "checked"; ?>>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if (strtolower($userDetails->gender)=="female") echo "checked"; ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="others" value="other" <?php if (strtolower($userDetails->gender)=="other") echo "checked"; ?>>
                                <label class="form-check-label" for="others">Others</label>
                            </div>
                        </div>
                    </div>
                    <!-- NID File Display (Read-Only) -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label>NID File:</label>
                            <a href="../file/<?php echo $file2->file_new_name; ?>" target="_blank" class="btn btn-secondary ms-2">
                                View NID Document
                            </a>
                        </div>
                    </div>
                    <!-- Save Changes Button for Editable Details -->
                    <div class="card-footer text-end">
                        <button type="submit" name="userDetailsUpdate" class="btn btn-primary ms-2">Save Changes</button>
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
