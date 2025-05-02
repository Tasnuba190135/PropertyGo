<?php
include_once '../php-class-file/User.php';
include_once '../php-class-file/UserDetails.php';
include_once '../php-class-file/FileManager.php';
include_once '../pop-up.php';

if (isset($_POST['approve']) || isset($_POST['reject'])) {
    $user2 = new User();
    $userDetails2 = new UserDetails();

    $status = 0;
    if (isset($_POST['approve'])) {
        $user2->user_id = $_POST['approve'];
        $status = 1;
    } else {
        $user2->user_id = $_POST['reject'];
        $status = -1;
    }

    $user2->setValue();
    $user2->status = $status;
    $user2->update();

    $userDetails2->setValueByUserId($user2->user_id, 0);
    $userDetails2->status = $status;
    $userDetails2->update();

    if ($status == 1) {
        showPopup("User ID " . $user2->user_id . ")approved successfully.");
    } else {
        showPopup("User ID " . $user2->user_id . ")rejected successfully.");
    }
}

$user = new user();
$userList = $user->getDistinctUsersByStatus(0, "client"); // Get all users with status 0 (pending)

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard - Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">


</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <h4 class="text-center my-4">Admin Dashboard</h4>
        <a href="admin-dashboard.html"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a>
        <a href="user-review.html"><i class="fas fa-tachometer-alt me-2"></i> User Review</a>
        <a href="user-management.html"><i class="fas fa-tachometer-alt me-2"></i> User Management</a>
        <a href="user-account-recovery.html"><i class="fas fa-tachometer-alt me-2"></i> User Account Recovery</a>
        <a href="edit-user-information.html"><i class="fa-solid fa-pen-to-square me-2"></i> Edit Client's
            Information</a>
        <a href="property-review.html"><i class="fas fa-layer-group me-2"></i>Property Review</a>
        <a href="property-management.html"><i class="fas fa-lock me-2"></i> Property Management</a>
        <a href="#" class="mt-auto text-center logout-btn">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">

            <h5>User Review</h5>

            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <div class="card__wrapper">
                <div class="card__title-wrap mb-20">
                    <h3 class="table__heading-title">All Users Review</h3>
                </div>
                <div class="attendant__wrapper ">
                    <table id="userTable" class="display">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- First item -->
                        <?php
                        if ($userList && count($userList) > 0) {
                            foreach ($userList as $userItem) {
                                $userId = $userItem['user_id'];
                                $userEmail = $userItem['email'];
                                // $user->user_type = "client";
                                $userType = $userItem['user_type'];
                                // $userStatus = $userItem['details'];
                                $userStatus = isset($userItem['details']) ? $userItem['details'] : 'N/A';

                                // Create a new instance of UserDetails and setValue details for this user
                                $userDetails = new UserDetails();
                                $userDetails->setValueByUserId($userId, 0);

                                $file1 = new FileManager();
                                $file1->setValueById($userDetails->profile_picture_id);

                                $file2 = new FileManager();
                                $file2->setValueById($userDetails->nid_file_id);

                                $file3 = new FileManager();
                                $file3->setValueById($userDetails->other_document_file_id);

                                $collapseId = "collapse{$userId}";



                            }
                        }
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $userDetails->user_id; ?></td>
                                <td><?php echo htmlspecialchars($userEmail); ?></td>
                                <td><?php echo $user->user_type; ?></td>

                                <td>
                                    <div class="attendant__action">
                                        <!-- <div class="d-flex align-items-center justify-content-center gap-10"> -->
                                        <!-- <button class="btn btn-primary" data-bs-toggle="modal" name="details" type=""
                                            data-bs-target="#<?php echo $collapsed; ?>">Details</button> -->
                                        <button class="btn btn-primary" data-bs-toggle="modal" name="details" type=""
                                            data-bs-target="#<?php echo $collapseId; ?>">Details</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="<?php echo $collapseId; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            User all details</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div action="" class="profile-page-form">
                                                            <div class="row mb-4">
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-md-0">Avatar</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <div
                                                                        class="d-inline-block position-relative me-4 mb-3 mb-lg-0 account-profile">
                                                                        <div class="avatar-preview rounded">
                                                                        <div id="imagePreview"
    class="rounded-4 profile-avatar"
    style="background-image: url(../img/agent-2.jpg)<?php echo $file1->file_new_name; ?>"
    alt="Profile pic" class="profile-img">
</div>
                                                                        </div>
                                                                        <!-- <div class="upload-link" title=""
                                                                                data-toggle="tooltip"
                                                                                data-placement="right"
                                                                                data-original-title="update">
                                                                                <input type="file" class="update-flie"
                                                                                    id="imageUpload">
                                                                                <i
                                                                                    class="fa-solid fa-pen-to-square fs-update"></i>
                                                                            </div> -->
                                                                    </div>
                                                                    <!-- add a UpDate bUTToN -->
                                                                    <!-- <a href="#"
                                                                            class=" btn btn-primary ms-2">Update</a> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <div class="row align-items-center mb-4">
                                                                <div class="col-md-6">
                                                                    <!-- <label class="form-label mb-md-2">Full Name</label> -->
                                                                    <!-- <input type="text" class="form-control" value="John Doe"> -->
                                                                    <h5><strong>User ID:
                                                                            <?php echo $userDetails->user_id; ?>
                                                                        </strong></h5>

                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-4">
                                                                <div class="col-md-6">
                                                                    <p><strong>User Type:</strong></p>
                                                                    <p><?php echo isset($user->user_type); ?></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Full Name:</strong></p>
                                                                    <p><?php echo htmlspecialchars($userDetails->full_name); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-4">
                                                                <div class="col-md-6">
                                                                    <p><strong>Email:</strong></p>
                                                                    <p><?php echo htmlspecialchars($userEmail); ?></p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <p><strong>Contact No:</strong></p>
                                                                    <p><?php echo isset($userDetails->contact_no) ? htmlspecialchars($userDetails->contact_no) : 'N/A'; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-4">
                                                                <div class="col-md-6">
                                                                    <p><strong>Division:</strong></p>
                                                                    <p><?php echo isset($userDetails->division) ? htmlspecialchars($userDetails->division) : 'N/A'; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>District:</strong></p>
                                                                    <p><?php echo isset($userDetails->district) ? htmlspecialchars($userDetails->district) : 'N/A'; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-4">
                                                                <div class="col-md-6">
                                                                    <p><strong>Address:</strong></p>
                                                                    <p><?php echo isset($userDetails->address) ? htmlspecialchars($userDetails->address) : 'N/A'; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Gender:</strong></p>
                                                                    <p><?php echo isset($userDetails->gender) ? htmlspecialchars($userDetails->gender) : 'N/A'; ?>
                                                                    </p>
                                                                </div>
                                                            </div>



                                                            <!-- <div class="col-md-6">
                                                                        <label class="form-label mb-md-2">Email</label>
                                                                        <input type="email" class="form-control" class="form-control" value="John@gmail.com">
                                                                    </div> -->


                                                            <div class="row align-items-center mb-4">
                                                                <div class="col-md-6">
                                                                    <p><strong>NID No:</strong></p>
                                                                    <p><?php echo isset($userDetails->nid_number) ? htmlspecialchars($userDetails->nid_number) : 'N/A'; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>NID File:</strong></p>
                                                                    <a href="../img/<?php echo isset($userDetails->nid_file_id) ? htmlspecialchars($file2->file_new_name) : '0.pdf'; ?>"
                                                                        target="_blank">Open File</a>
                                                                </div>
                                                            </div>
                                                        </div>




                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->


                                    </div>
                                </td>
                                <td>
                                    <div class="attendant__action">
                                        <!-- <div class="d-flex align-items-center justify-content-center gap-10"> -->
                                        <button class="btn btn-success" name="approve" type="submit"
                                            value="<?php echo htmlspecialchars($userId); ?>">Approve</button>
                                        <button class="btn btn-danger ms-2" name="=reject" type="submit"
                                            value="<?php echo htmlspecialchars($userId); ?>">Reject</button>
                                        <!-- </div> -->
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#userTable').DataTable(); // Initialize DataTables on #userTable
        });

        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    </script>
</body>

</html>