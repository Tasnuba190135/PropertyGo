<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;

include_once '../pop-up.php';

include_once '../php-class-file/User.php';
$user = new User();
$temp_admin = $session::getObject('temp_admin');
$session::copyProperties($temp_admin, $user);

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $user->updatePasswordUsingEmail($user->email, $new_password);
        // $session::destroy(); // Destroy the session after password reset
        // $session::ensureSessionStarted(); // Ensure session is started again
        $session::set("msg1", "Password reset successfully");

        // echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
        echo "<script>window.location.href = 'login.php';</script>"; // Redirect to login page immediately
        // Redirect to login page after 2 seconds
    } else {
        $session::set("msg1", "Password and Confirm Password do not match!");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Step-3</title>

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
    <!-- <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css"> -->
    <link rel="stylesheet" href="../login.css">


    <!-- Include Font Awesome (or any icon library) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Popup -->
    <?php
    if ($session::get('msg1')) {
        showPopup($session::get('msg1'));
        $session::delete('msg1');
    }
    ?>
    <section class="section1">
        <!-- HTML !-->

        <div class="container2">


            <!-- HTML !-->

            <div class="login-box">
                <!-- <div class="button-container-home">
                    <button class="button-home" onclick="location.href='index.html'">Homepage</button>
                </div> -->
                <!-- HTML !-->
                <!-- HTML !-->
                <!-- <button class="home" onclick="location.href='index.html'" role="button"><span class="text">GO TO HOMEPAGE</span></button>
<hr> -->
                <form method="post" action="" enctype="multipart/form-data">

                    <h2 style="color: white;">Reset Password</h2>
                    <hr>
                    <h2 style="color: white;">Step 3</h2>
                    <p style="color: white;">Please enter your new password.</p>
                    <hr>


                    <div class="input-field">
                        <label for="password">New Password:</label>
                        <input type="password" name="new_password" id="email" placeholder="Enter New Password" required>
                    </div>
                    <div class="input-field">
                        <label for="password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="email" placeholder="Re-Type password" required>
                    </div>
                    <!-- <div class="input-field">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
              </div> -->
                    <div class="button-container2">
                        <button class="btn-signup" name="reset_password" type="submit" role="button">Reset Password</button>
                    </div>
                </form>


                <!-- <form method="post" action="" enctype="multipart/form-data">
                    <p class="signup-text" style="padding-top: 10px;">Don't get the OTP? <a href="">Resend OTP</a></p>
                    <div class="button-container">
                        <button class="button-56" name="resend_otp" id="resend_otp" type="submit" role="button" disabled>Resend OTP</button>
                    </div>
                </form> -->




                <!--              
                <p class="signup-text">Already have an account? <a href="login.html">Login</a></p>
                    <div class="button-container">
                        <button class="button-56" onclick="location.href='login.html'" role="button">Log In</button>
                    </div> -->

                </form>
            </div>
        </div>

    </section>



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