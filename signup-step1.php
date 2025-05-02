<?php
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;

require_once 'php-class-file/EmailSender.php';
$emailSender = new EmailSender();

include_once 'pop-up.php';
if ($session::get('msg1') != null) {
    showPopup($session::get('msg1'));
    $session::delete('msg1');
}
if (isset($_POST['verify_email'])) {
    include_once 'php-class-file/User.php';

    $user = new User();
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    // checking for status 0, 1, 2, -1
    // 0 unapproved
    // 1 approved
    // -1 declined
    // 2 Blocked

    if ($user->isEmailAvailable($user->email)) {
        include_once 'pop-up.php';
        showPopup("The Email Address you provide is already used. Please try with another Email Address.");
    } else {
        $session::storeObject('temp_user', $user);
        $session::set('step', 2);
        $otp = rand(1000, 9999);
        $session::set('otp', $otp);
        $emailSender->sendMail($user->email, 'OTP for Signup', "Your OTP is: $otp");
        echo "<script>window.location.href='signup-step2.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Step-1</title>

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
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="login.css">


    <!-- Include Font Awesome (or any icon library) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php include_once 'navbar-user.php'; ?>

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

                    <h2 style="color: white;">Sign Up Here</h2>
                    <hr>
                    <h2>Step 1</h2>
                    <p>Please provide all valid information</p>
                    <hr>


                    <div class="input-field">
                        <label for="email">Email Address:</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-field">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="button-container2">
                        <button class="btn-signup" name="verify_email" type="submit" role="button">Verify Email</button>
                    </div>



                    <!--              
                <p class="signup-text">Already have an account? <a href="login.html">Login</a></p>
                    <div class="button-container">
                        <button class="button-56" onclick="location.href='login.html'" role="button">Log In</button>
                    </div> -->

                </form>
            </div>
        </div>

    </section>
    

    <!-- Footer Start -->
  <footer>
    <div class="container-fluid bg-dark text-white-50 footer pt-5  wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Property Go</a>, All Right Reserved.
              Designed By <a class="border-bottom" href="https://htmlcodex.com">Tasnuba Tasnim</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->


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