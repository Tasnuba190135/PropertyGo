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

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/property.css">
    <!-- <link rel="stylesheet" href="login.css"> -->

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">





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
    </style>


</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <h4 class="text-center my-4" style="color: #ffffff;">Admin Dashboard</h4>
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

            <h5>Property Review</h5>

            <!-- Toggle Button -->
            <button class="toggle-btn d-md-none" id="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="container mt-4">
            <div class="card__wrapper">
                <div class="card__title-wrap mb-20">
                    <h3 class="table__heading-title">Property Review</h3>
                </div>
                <div class="attendant__wrapper ">
                    <table id="userTable" class="display">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>ID</th>
                                <th>Created</th>
                                <th> Status</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>304 Blaster Up</td>

                                <td>24312312</td>
                                <td>12-02-2023</td>

                                <td>
                                    <div class="attendant__status">
                                        <span class="attendant__status--pending">Approved</span>
                                    </div>
                                </td>
                                <!-- <td>
                                    <div class="attendant__action">
                                            <button class="btn btn-primary">Details</button>
                                    </div>
                                </td> -->
                                <td>
                                    <div class="attendant__action">
                                        <!-- <div class="d-flex align-items-center justify-content-center gap-10"> -->
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Details</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Property Review in Detail</h1>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div>
                                                        <!--/ Intro Single star /-->
                                                        <section class="intro-single modal-intro-single-section">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-8">
                                                                        <div class="title-single-box">
                                                                            <h1 class="title-single">304 Blaster Up(For
                                                                                Sale)</h1>
                                                                            <span class="color-text-a">23/7 Dhanmondi,
                                                                                Dhaka</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <!--/ Intro Single End /-->

                                                        <!--/ Property Single Star /-->
                                                        <section class="property-single nav-arrow-b">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <div id="property-single-carousel"
                                                                            class="owl-carousel owl-arrow gallery-property">
                                                                            <div class="carousel-item-b">
                                                                                <img src="img/slide-2.jpg" alt="">
                                                                            </div>
                                                                            <div class="carousel-item-b">
                                                                                <img src="img/slide-3.jpg" alt="">
                                                                            </div>
                                                                            <div class="carousel-item-b">
                                                                                <img src="img/slide-1.jpg" alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row justify-content-between">
                                                                            <div class="col-md-5 col-lg-4">
                                                                                <div
                                                                                    class="property-price d-flex justify-content-center foo">
                                                                                    <div class="card-header-c d-flex">
                                                                                        <!-- <div class="card-box-ico">
                                                                                            <span class="ion-money">15
                                                                                            </span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="card-title-c align-self-center">
                                                                                            <h5 class="title-c">Lakh
                                                                                            </h5>
                                                                                        </div> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="property-summary">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div
                                                                                                class="title-box-d section-t4">
                                                                                                <h3 class="title-d">
                                                                                                    Type: For Sale</h3>
                                                                                            </div>
                                                                                            <div
                                                                                                class="title-box-d section-t2">
                                                                                                <h3 class="title-d">
                                                                                                    Quick Summary</h3>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="summary-list">
                                                                                        <ul class="list">
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>Property
                                                                                                    ID:</strong>
                                                                                                <span>1134</span>
                                                                                            </li>
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>Property
                                                                                                    Type:</strong>
                                                                                                <span>Residential</span>
                                                                                            </li>
                                                                                            <!-- <li class="d-flex justify-content-between">
                      <strong>Status:</strong>
                      <span>Sale</span>
                    </li> -->
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>Division:</strong>
                                                                                                <span>Dhaka</span>
                                                                                            </li>
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>Location:</strong>
                                                                                                <span>24/7
                                                                                                    Dhanmondi,Dhaka</span>
                                                                                            </li>
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>BedRooms:</strong>
                                                                                                <span>4</span>
                                                                                            </li>
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>BathRooms:</strong>
                                                                                                <span>2</span>
                                                                                            </li>
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>Price:</strong>
                                                                                                <span>15lakh</span>
                                                                                            </li>
                                                                                            <li
                                                                                                class="d-flex justify-content-between">
                                                                                                <strong>Area:</strong>
                                                                                                <span>340m
                                                                                                    <sup>2</sup>
                                                                                                </span>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-md-7 col-lg-7 section-md-t3">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="title-box-d">
                                                                                            <h3 class="title-d">Property
                                                                                                Description</h3>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="property-description">
                                                                                    <p class="description color-text-a">
                                                                                        Vestibulum ante ipsum primis in
                                                                                        faucibus orci luctus et ultrices
                                                                                        posuere cubilia Curae; Donec
                                                                                        velit
                                                                                        neque, auctor sit amet
                                                                                        aliquam vel, ullamcorper sit
                                                                                        amet ligula. Cras ultricies
                                                                                        ligula sed magna dictum porta.
                                                                                        Curabitur aliquet quam id dui
                                                                                        posuere blandit. Mauris blandit
                                                                                        aliquet elit, eget tincidunt
                                                                                        nibh pulvinar quam id dui
                                                                                        posuere blandit.
                                                                                    </p>
                                                                                    <p
                                                                                        class="description color-text-a no-margin">
                                                                                        Curabitur arcu erat, accumsan id
                                                                                        imperdiet et, porttitor at sem.
                                                                                        Donec rutrum congue leo eget
                                                                                        malesuada. Quisque velit nisi,
                                                                                        pretium ut lacinia in, elementum
                                                                                        id enim. Donec sollicitudin
                                                                                        molestie malesuada.
                                                                                    </p>
                                                                                </div>
                                                                                <div class="row section-t3">
                                                                                    <div class="col-sm-12">
                                                                                        <!-- <div class="title-box-d">
                    <h3 class="title-d">Amenities</h3>
                  </div> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="amenities-list color-text-a">
                                                                                    <ul class="list-a no-margin">
                                                                                        <li>Balcony</li>
                                                                                        <li>Outdoor Kitchen</li>
                                                                                        <li>Cable Tv</li>
                                                                                        <li>Deck</li>
                                                                                        <li>Tennis Courts</li>
                                                                                        <li>Internet</li>
                                                                                        <li>Parking</li>
                                                                                        <li>Sun Room</li>
                                                                                        <li>Concrete Flooring</li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10 offset-md-1">
                                                                        <ul class="nav nav-pills-a nav-pills mb-3 section-t3"
                                                                            id="pills-tab" role="tablist">
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active"
                                                                                    id="pills-video-tab"
                                                                                    data-toggle="pill"
                                                                                    href="#pills-video" role="tab"
                                                                                    aria-controls="pills-video"
                                                                                    aria-selected="true">Video</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="pills-plans-tab"
                                                                                    data-toggle="pill"
                                                                                    href="#pills-plans" role="tab"
                                                                                    aria-controls="pills-plans"
                                                                                    aria-selected="false">Floor
                                                                                    Plans</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" id="pills-map-tab"
                                                                                    data-toggle="pill" href="#pills-map"
                                                                                    role="tab" aria-controls="pills-map"
                                                                                    aria-selected="false">Ubication</a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="tab-content" id="pills-tabContent">
                                                                            <div class="tab-pane fade show active"
                                                                                id="pills-video" role="tabpanel"
                                                                                aria-labelledby="pills-video-tab">
                                                                                <iframe
                                                                                    src="https://player.vimeo.com/video/73221098"
                                                                                    width="100%" height="460"
                                                                                    frameborder="0"
                                                                                    webkitallowfullscreen
                                                                                    mozallowfullscreen
                                                                                    allowfullscreen></iframe>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="pills-plans"
                                                                                role="tabpanel"
                                                                                aria-labelledby="pills-plans-tab">
                                                                                <img src="img/plan2.jpg" alt=""
                                                                                    class="img-fluid">
                                                                            </div>
                                                                            <div class="tab-pane fade" id="pills-map"
                                                                                role="tabpanel"
                                                                                aria-labelledby="pills-map-tab">
                                                                                <iframe
                                                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834"
                                                                                    width="100%" height="460"
                                                                                    frameborder="0" style="border:0"
                                                                                    allowfullscreen></iframe>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <a href="payment.html"
                                                                    class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4 btn-explore">
                                                                    <span>Proceed To Go Ahead</span>
                                                                </a> -->
                                                            </div>

                                                        </section>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                                <td>
                                    <div class="attendant__action">
                                        <button class="btn btn-danger ms-2">Archive</button>
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/scrollreveal/scrollreveal.min.js"></script>


    <!-- Template Main Javascript File -->
    <script src="../js/main.js"></script>
    <script src="js/service.js"></script>




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