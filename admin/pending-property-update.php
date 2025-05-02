<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;
include_once '../php-class-file/Auth.php';
auth('admin');

// hellow world
// Include necessary PHP class files (adjust paths as needed)
include_once '../php-class-file/User.php';
include_once '../php-class-file/Property.php';
include_once '../pop-up.php';

$property =  new Property();

if (isset($_POST['approve']) || isset($_POST['reject'])) {
    $property_id = $_POST['property_id'];
    $property->property_id = $property_id;
    $property->setValue();

    if (isset($_POST['approve'])) {
        $property->updateStatus($property_id, 1);
        $property->updateStatus($property->parent_property_id, -3);

        include_once '../pop-up.php';
        $session::set('msg1', "Accepted. Property ID: " . $property_id);
    }
    // Check if 'reject' button was clicked and set status to 0 (rejected)
    elseif (isset($_POST['reject'])) {
        $property->updateStatus($property_id, -1);
        $property->updateStatus($property->parent_property_id, 1);

        include_once '../pop-up.php';
        $session::set('msg1', "Rejected. Property ID: " . $property_id);
    }
}

// Retrieve properties for this user
$property = new Property();
$properties = $property->getByPropertyIdAndStatus(null, [4], 'created', 'ASC');
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Dashboard - Property Review</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" />
        <!-- FontAwesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../css/dashboard.css">


    </head>
    <style>
        .modal-dialog {
            max-width: 1050px !important;
            margin-right: auto;
            margin-left: auto;
        }

        .modal-content {
            padding: 40px;
        }

        .modal-intro-single-section {
            padding: 60px 0px !important;
        }

        .modal-dialog-scrollable .modal-content {
            overflow-y: auto !important;
        }

        ul li {
            list-style-type: none !important;
        }


        /* Set the carousel image size and ensure full view without cropping */
        #propertyCarousel .carousel-inner img {
            width: 500px;
            height: 500px;
            object-fit: contain;
            margin: auto;
            /* Center the image horizontally */
        }
    </style>


</head>

<body>
    <!-- Popup -->
    <?php
    if ($session::get('msg1')) {
        showPopup($session::get('msg1'));
        $session::delete('msg1');
    }
    ?>

    
    <!-- Sidebar -->
    <?php include_once 'sidebar-admin.php'; ?>

    <!-- Main Content -->
    <div id="main-content" class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h5>Pending Property Update Request</h5>
            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <div class="card__wrapper">
                <div class="card__title-wrap mb-20">
                    <h3 class="table__heading-title">Pending Property Update Requests</h3>
                </div>
                <div class="attendant__wrapper ">
                    <table id="userTable" class="display">
                        <thead>
                            <tr>
                                <th>Property title</th>
                                <th>Property ID</th>
                                <th>Created</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($properties)) {
                                foreach ($properties as $prop) {
                                    // Load property details for the current property_id
                                    // echo $prop['property_id'] . "<br>";
                                    $propertyDetails = new Property();
                                    $propertyDetails->setProperties($prop);
                            ?>
                                    <tr>
                                        <td><?php echo $propertyDetails->property_title; ?></td>
                                        <td style="padding-left: 25px;"><?php echo $propertyDetails->property_id; ?></td>
                                        <td><?php echo $propertyDetails->created; ?></td>
                                        <td>
                                            <div class="attendant__action d-flex flex-column align-items-start gap-2">
                                                <a href="property-check.php?propertyId=<?php echo $propertyDetails->parent_property_id; ?>" target="_blank" class="btn btn-primary w-100">Review Current Post</a>
                                                <a href="property-check.php?propertyId=<?php echo $propertyDetails->property_id; ?>" target="_blank" class="btn btn-success btn-block w-100"  style="white-space: nowrap;">Review Pending Edit Post</a>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="attendant__action d-flex flex-column align-items-start gap-2">
                                            <form method="POST" action="">
        <!-- Hidden property_id field to pass along with form submission -->
        <input type="hidden" name="property_id" value="<?php echo $propertyDetails->property_id; ?>" />
        
        <div class="mb-2">
            <button type="submit" name="approve" value="1" class="btn btn-dark btn-block w-100">Approve</button>
        </div>
        
        <div>
            <button type="submit" name="reject" value="-1" class="btn btn-danger btn-block w-100">Reject</button>
        </div>
    </form>

                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<p>No properties found.</p>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript -->

    <!-- JavaScript Libraries -->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/jquery/jquery-migrate.min.js"></script>
    <script src="../lib/popper/popper.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/scrollreveal/scrollreveal.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="../css/contactform/contactform.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/scrollreveal/scrollreveal.min.js"></script>

    <!-- Template Main Javascript File -->
    <script src="../js/main.js"></script>
    <script src="js/service.js"></script>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                order: [
                    [2, "asc"]
                ]
            });
        });

        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    </script>
</body>

</html>