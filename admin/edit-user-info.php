<?php
include_once '../php-class-file/Auth.php';
auth('admin');

include_once '../php-class-file/User.php';
include_once '../php-class-file/UserDetails.php';
include_once '../php-class-file/FileManager.php';
include_once '../php-class-file/Division.php';  // Include Division class

$divisions = getDivisions(); // Returns an associative array: division => [districts...]

$user = new User();
$userDetails = new UserDetails();

$message = ""; // Plain text message

// Process profile picture update
if (isset($_POST['profilePictureUpdate'])) {
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $newFile = new FileManager();
        $newFileId = $newFile->insert();
        $newFile->file_owner_id = $_POST['profilePictureUpdate'];
        $newFile->doOp($_FILES['avatar']);
        $uploadResult = $newFile->update();

        if($uploadResult) {
            $userDetails->user_id = $_POST['profilePictureUpdate'];
            $userDetails->setValueByUserId($userDetails->user_id);
            $userDetails->profile_picture_id = $newFileId;
            $userDetails->update();
            $message = "Profile picture updated successfully.";
        } else {
            $message = "Failed to upload file. Please try again.";
        }
    } else {
        $message = "No file selected for upload.";
    }     
}

// Process user details update (all editable fields)
if (isset($_POST['userDetailsUpdate'])) {
    $user->user_id = $_POST['userDetailsUpdate'];
    $user->setValue();
    $userDetails->user_id = $user->user_id;
    $userDetails->setValueByUserId($user->user_id);

    $user->email            = isset($_POST['email'])      ? $_POST['email']      : $user->email;
    $userDetails->full_name  = isset($_POST['full_name'])  ? $_POST['full_name']  : $userDetails->full_name;
    $userDetails->nid_number= isset($_POST['nid_number']) ? $_POST['nid_number'] : $userDetails->nid_number;
    $userDetails->contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : $userDetails->contact_no;
    $userDetails->division   = isset($_POST['division'])   ? $_POST['division']   : $userDetails->division;
    $userDetails->district   = isset($_POST['district'])   ? $_POST['district']   : $userDetails->district;
    $userDetails->address    = isset($_POST['address'])    ? $_POST['address']    : $userDetails->address;
    $userDetails->gender     = isset($_POST['gender'])     ? $_POST['gender']     : $userDetails->gender;
    
    // Update the user details and email
    if ($userDetails->update() && $user->update()) {
        $message = "User details updated successfully. ";
    } else {
        $message = "Failed to update user details. ";
    }
    
    // Process NID document update if a new file is provided
    if (isset($_FILES['nid_document']) && $_FILES['nid_document']['error'] === 0) {
        $newNidFile = new FileManager();
        $newNidFile->insert();
        $newNidFile->file_owner_id = $user->user_id;
        $uploadResult = $newNidFile->doOp($_FILES['nid_document']);
        $uploadResult = $newNidFile->update();
        $userDetails->nid_file_id = $newNidFile->file_id;

        if($uploadResult) {
            $userDetails->update();
            $message .= "NID Document updated successfully.";
        } else {
            $message .= "Failed to upload NID Document. Please try again.";
        }
    }
}

if(isset($_GET['userId'])) {
    $user->user_id = $_GET['userId'];
    $user->setValue();
    $userDetails->user_id = $user->user_id;
    $userDetails->setValueByUserId($user->user_id);
    $file1 = new FileManager();
    $file1->setValueById($userDetails->profile_picture_id);
    $file2 = new FileManager();
    $file2->setValueById($userDetails->nid_file_id);
} else {
    $message = "User ID not found.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard(Admin) - Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
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
    <?php include_once 'sidebar-admin.php'; ?>

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
                    <?php
                    include_once '../pop-up.php';
                    showPopup($message);
                    ?>
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
                            <button type="submit" name="profilePictureUpdate" class="btn btn-primary" value="<?php echo $userDetails->user_id; ?>">Update Profile Picture</button>
                        </div>
                    </div>
                </form>

                <!-- Form 2: User Details Update -->
                <form action="" method="post" class="profile-page-form" enctype="multipart/form-data">
                    <!-- Info Alert -->
                    <div class="alert alert-info">
                        <strong>Note:</strong> You can change the Full Name, Email Address, NID Number, upload a new NID Document and also edit all other information.
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
                    <!-- Editable Fields -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="full_name" value="<?php echo $userDetails->full_name; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address:</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>">
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label for="contactNo" class="form-label">Contact No:</label>
                            <input type="text" class="form-control" id="contactNo" name="contact_no" value="<?php echo $userDetails->contact_no; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NID Number:</label>
                            <input type="text" class="form-control" name="nid_number" value="<?php echo $userDetails->nid_number; ?>">
                        </div>
                    </div>
                    <!-- Location and Address Fields -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label for="division" class="form-label">Division:</label>
                            <select class="form-control" id="division" name="division" required>
                                <option value="">Select</option>
                                <?php 
                                foreach($divisions as $divName => $districts) {
                                    $selected = (strtolower($userDetails->division) == strtolower($divName)) ? 'selected' : '';
                                    echo "<option value=\"$divName\" $selected>$divName</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="district" class="form-label">District:</label>
                            <select class="form-control" id="district" name="district" required>
                                <option value="">Select</option>
                                <?php 
                                // If a division is already selected, pre-populate the district select.
                                if (!empty($userDetails->division) && isset($divisions[$userDetails->division])) {
                                    foreach($divisions[$userDetails->division] as $district) {
                                        $selected = ($userDetails->district == $district) ? 'selected' : '';
                                        echo "<option value=\"$district\" $selected>$district</option>";
                                    }
                                }
                                ?>
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
                    <!-- NID File Display and Upload Option -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <label>NID File:</label>
                            <a href="../file/<?php echo $file2->file_new_name; ?>" target="_blank" class="btn btn-secondary ms-2">
                                View Current NID Document
                            </a>
                        </div>
                        <div class="col-md-6">
                            <label for="nid_document" class="form-label">Upload New NID Document:</label>
                            <input type="file" class="form-control" id="nid_document" name="nid_document" accept="application/pdf, image/*">
                        </div>
                    </div>
                    <!-- Save Changes Button for Editable Details -->
                    <div class="card-footer text-end">
                        <button type="submit" name="userDetailsUpdate" class="btn btn-primary ms-2" value="<?php echo $userDetails->user_id; ?>">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Sidebar toggle functionality remains unchanged
        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });

        // Dynamic District Population based on Division selection
        const divisionsData = <?php echo json_encode($divisions); ?>;
        const divisionSelect = document.getElementById("division");
        const districtSelect = document.getElementById("district");

        divisionSelect.addEventListener("change", function() {
            const selectedDivision = this.value;
            districtSelect.innerHTML = '<option value="">Select</option>'; // reset options
            if (divisionsData[selectedDivision]) {
                divisionsData[selectedDivision].forEach(function(district) {
                    let option = document.createElement("option");
                    option.value = district;
                    option.text = district;
                    districtSelect.appendChild(option);
                });
            }
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
