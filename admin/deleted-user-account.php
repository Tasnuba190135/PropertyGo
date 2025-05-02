<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;

include_once '../php-class-file/Auth.php';
auth('admin');

include_once '../php-class-file/User.php';
include_once '../php-class-file/UserDetails.php';
include_once '../php-class-file/FileManager.php';
include_once '../pop-up.php';

if (isset($_POST['delete']) || isset($_POST['retrieve'])) {
    $user2 = new User();
    $userDetails2 = new UserDetails();

    $status = 0;
    if (isset($_POST['delete'])) {
        $user2->user_id = $_POST['delete'];
        $status = -2;
    } else {
        $user2->user_id = $_POST['retrieve'];
        $status = 1;
    }

    $user2->setValue();
    $user2->status = $status;
    $user2->update();

    $session::set("msg1", "User ID : " . $user2->user_id . " with Email :  {$user2->email} has been successfully " . ($status == -2 ? "deleted" : "retrieved"));
}

// $userDetails2->setValueByUserId($user2->user_id . "with email: {$user2->email} has been successfully " . ($status == 1 ? "disabled" : "deleted") );
// $userDetails2->status = $status;
// $userDetails2->update();

//     if ($status == 2) {
//         showPopup("User ID " . $user2->user_id . " has been disabled.");
//     } else {
//         showPopup("User ID " . $user2->user_id . " has been deleted.");
//     }
// }

$user = new User();
$userListActive = $user->getDistinctUsersByStatus(-2, "client");
$userListDisable = $user->getDistinctUsersByStatus(1, "client");

$userList = array_merge($userListActive ?: [], $userListDisable ?: []);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard - Delete or Retrieve Account </title>
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

            <h5>Delete or Retrieve User Account</h5>

            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <div class="card__wrapper">
                <div class="card__title-wrap mb-20">
                    <h3 class="table__heading-title">All Users</h3>
                </div>
                <div class="attendant__wrapper ">
                    <table id="userTable" class="display">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($userList && count($userList) > 0) {
                            foreach ($userList as $userItem) {
                                $userId = $userItem['user_id'];
                                $userObj1 = new User();
                                $userObj1->user_id = $userId;
                                $userObj1->setValue();

                                // Create a new instance of UserDetails and setValue of details for this user
                                $userDetails = new UserDetails();
                                $userDetails->setValueByUserId($userId, 1);

                                $file1 = new FileManager();
                                $file1->setValueById($userDetails->profile_picture_id);

                                $file2 = new FileManager();
                                $file2->setValueById($userDetails->nid_file_id);

                                $collapseId = "collapse{$userId}";

                        ?>
                                
                                    <tr>
                                        <td><?php echo $userDetails->user_id; ?></td>
                                        <td><?php echo $userObj1->email; ?></td>
                                        <td><?php echo $userObj1->user_type; ?></td>
                                        <td><?php if ($userObj1->status == -2) { ?>Account Deleted
                                        <?php } else { ?> Account Activated <?php } ?>
                                        </td>
                                        <td>
                                            <div class="attendant__action">
                                                <!-- Corrected the data-bs-target to use $collapseId -->
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
                                                                                <!-- < class="avatar-preview rounded"> -->
                                                                                <!-- <img id="imagePreview"
                                                                                        class="rounded-4 profile-avatar"
                                                                                        src="background-image: url(../img/agent-2.jpg)"
                                                                                        alt="image-upload" > -->
                                                                                <img src="../file/<?php echo $file1->file_new_name; ?>"
                                                                                    height="200px" width="200px"
                                                                                    alt="User image"
                                                                                    class="rounded-4 profile avatar">

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
                                                                            <p><?php echo $userObj1->email; ?></p>
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
                                                                            <a href="../file/<?php echo isset($userDetails->nid_file_id) ? htmlspecialchars($file2->file_new_name) : '0.jpg'; ?>"
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
                                                <!-- Modal End -->
                                            </div>
                                        </td>
                                        <td>
                                            <div class="attendant__action d-flex gap-2">
                                                <form method="post" action="" enctype="multipart/form-data">
                                                    <?php if ($userObj1->status == 1) { ?>
                                                        <button class="btn btn-success" name="delete" type="submit"
                                                            value="<?php echo htmlspecialchars($userId); ?>">Delete Account</button>
                                                    <?php } else if ($userObj1->status == -2) { ?>
                                                        <button class="btn btn-danger" name="retrieve" type="submit"
                                                            value="<?php echo htmlspecialchars($userId); ?>">Retrieve Account</button>
                                                    <?php } ?>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                            }
                        } else {
                            echo "<p>No users found.</p>";
                        }
                        ?>
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
        $(document).ready(function() {
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