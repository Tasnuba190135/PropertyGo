<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;
include_once '../php-class-file/User.php';
include_once '../pop-up.php';

// include_once '../php-class-file/Auth.php';
// auth('admin');

if ($session::get('msg1') !== null) {
    showPopup($session::get('msg1'));
    $session::delete('msg1');
}

$alreadyLoggedIn = false;


if (isset($_POST['log_in'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['user-type'];

    $user = new User();
    $user->email = $email;
    $user->password = $password;
    $user->user_type = $userType;
    $userCheck = $user->checkUserEmailWithStatus($user->email, $user->password, $user->user_type);

    if ($userCheck[0] == "1") {
        // echo 'all ok <br>';
        showPopup($userCheck[1]);
        $session::storeObject('temp_admin', $user);
        if ($userType == "super-admin") {
            $session::set('admin', "super_admin");
        } elseif ($userType == "admin") {
            $session::set('admin', "admin");
        }
        echo '<script>window.location.href = "admin-dashboard.php";</script>';
    } elseif ($userCheck[0] == "10") {
        showPopup($userCheck[1]);
    } else {
        showPopup($userCheck[1]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <!-- <link href="style.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="navbar.css"> -->
    <link rel="stylesheet" href="../login.css">


    <!-- Include Font Awesome (or any icon library) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- <header>
        nav start
        <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
            <div class="container">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <a class="navbar-brand text-brand" href="index.html">PROPERTY<span class="color-b"> GO</span></a>

                <div class="navbar-collapse collapse justify-content-lg-end" id="navbarDefault">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_property.html">Add Property</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="explore_property.html">Explore Property</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact Us</a>
                        </li>
                    </ul>
                </div> -->
    <!-- LOG IN button inside the navbar collapse -->
    <!-- <div class="navbar-collapse collapse justify-content-xl-end" id="navbarDefault">
                    <button class="button-85 ml-auto" role="button">LOG IN</button>
                </div>
            </div>
        </nav> -->
    <!--/ Nav End /-->
    <!-- </header> -->

    <section class="section1">
        <!-- HTML !-->
        <div class="container1">
            <!-- HTML !-->
            <div class="login-box">
                <!-- <div class="button-container-home">
                    <button class="button-home" onclick="location.href='index.html'">Homepage</button>
                </div> -->
                <!-- HTML !-->
                <!-- HTML !-->
                <!-- <button class="home" onclick="location.href='index.html'" role="button"><span class="text">GO TO
                            HOMEPAGE</span></button> -->
                <!-- <hr> -->
                <?php if ($alreadyLoggedIn === false) { ?>
                    <form method="post" action="" enctype="multipart/form-data">
                        <h2>Admin | Login</h2>
                        <!-- <p class="signup-text1">Please Login using User ID and Password</p> -->
                        <hr>
                        <div class="input-field">
                            <label for="user-type">User Type:</label>
                            <select id="user-type" name="user-type" required>
                                <!-- <option value="client" id="option1">Client</option> -->
                                <option value="super-admin" id="option1">Super Admin</option>
                                <option value="admin" id="option1">Admin</option>

                            </select>
                        </div>
                        <div class="input-field">
                            <label for="=email">Email Address:</label>
                            <input type="email" id="email" placeholder="Enter your Email Address" name="email" required>
                        </div>
                        <div class="input-field">
                            <label for="password">Password:</label>
                            <input type="password" id="password" placeholder="Enter your password" name="password" required>
                        </div>
                        <div class="checkbox-field">
                            <!-- <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember Me</label> -->
                            <a href="admin-reset-password-step1.php" class="forgot-password"><b><i>Forget Password?</i></b></a>
                        </div>
                        <div class="button-container">
                            <button class="button-56" name="log_in" type="submit" role="button">LOG IN</button>
                        </div>
                    </form>
                    <hr>

                    <form method="post" action="admin-signup-step1.php" enctype="multipart/form-data">

                        <p class="signup-text">Don't have an account? <a href="admin-signup-step1.php">Sign Up</a></p>
                        <div class="button-container2">
                            <button class="btn-signup" name="sign_up" type="submit" role="button">SIGN UP</button>
                        </div>
                    </form>

            </div>
        </div>



    <?php } else { ?>
        <h3 class="h4 form-box text-black mb-4">Welcome to Property Go Admin Panel</h3>
        <div class="button-container">
            <button class="button-56" onclick="location.href='admin-dashboard.php'" role="button">Go to Dashboard</button>
        </div>
    <?php } ?>
    <!-- <form method="post" action="signup.html">

                    <p class="signup-text">Don't have an account? <a href="signup.html">Sign Up</a></p>
                    <div class="button-container2">
                        <button class="btn-signup" type="submit" role="button">SIGN UP</button>
                    </div>
                </div>
            </div> -->
    <!-- Popup Container -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Login Successful</h2>
            <p>Welcome! You have successfully logged in.</p>
        </div>
    </div>
    <!-- </form> -->
    <!-- Login Button -->
    <!-- <button class="button-56" onclick="showPopup()">Login</button> -->

    </section>

    <footer>
        <!-- Footer Start -->
        <!-- <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Photo Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-1.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-2.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-4.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-5.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Property Go</a>, All Right Reserved.

                            Designed By <a class="border-bottom" href="https://htmlcodex.com">Tasnuba Tasnim</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Footer End -->
    </footer>


    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/popper/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/scrollreveal/scrollreveal.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>
    <script src="js/service.js"></script>

</body>

</html>