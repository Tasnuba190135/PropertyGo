<?php
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;
$session::ensureSessionStarted();

// session->destroy();
include_once 'pop-up.php';
$session::get('msg1') ? showPopup($session::get('msg1')) : '';
$session::delete('msg1');


if(isset($_POST['log_in'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    include_once 'php-class-file/User.php';
    $user = new User();
    $user->email = $email;
    $user->password = $password;
    $userCheck = $user->checkUserEmailWithStatus($user->email, $user->password, "client");

    if($userCheck[0] == 1){
        include_once 'pop-up.php';
        showPopup($userCheck[1]);
        $session::storeObject('user', $user);
        // Check if a redirect URL is set in session
        $redirect_url = $session::get('redirect_url') ? $session::get('redirect_url') : 'index.php';
        $session::delete('redirect_url');
        echo "<script>window.location = '$redirect_url';</script>";
        exit();
        
        // header('Location: index.php');
        // echo"<script>window.location = 'index.php';</script>";
        // exit();

       

    }
    else{
        include_once 'pop-up.php';
        showPopup($userCheck[1]);
    }
}

$alreadyLoggedIn = false;
if($session::getObject('user') !==null){
    // $alreadyLoggedIn = true;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>

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
                     <?php if($alreadyLoggedIn === false) { ?>
                    <form method="post" action="" enctype="multipart/form-data">
                    <h2>Login Here</h2>
                    <!-- <p class="signup-text1" style="padding:0px;">Please Login using User ID and Password</p> -->
                    <hr>
                    <div class="input-field">
                        <label for="user-type">User Type:</label>
                        <select id="user-type" name="user_type" required>
                            <option value="client" id="option1">Client</option>
                            <!-- <option value="admin" id="option1">Admin</option> -->
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Enter your Email Address" required>
                    </div>
                    <div class="input-field">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="checkbox-field">
                        <!-- <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember Me</label> -->
                        <a href="reset-password-step1.php" class="forgot-password"><b><i>Forget Password?</i></b></a>
                    </div>
                    <!-- <button class="login-btn">Login</button> -->
                    <div class="button-container">
                        <button class="button-56" name="log_in" type="submit" role="button">LOG IN</button>
                    </div>
                </form>
                    <hr>
               
                <form method="post" action="signup-step1.php" enctype="multipart/form-data">

                    <p class="signup-text">Don't have an account? <a href="signup-step1.php">Sign Up</a></p>
                    <div class="button-container2">
                        <button class="btn-signup" name="sign_up" type="submit" role="button">SIGN UP</button>
                    </div>
                    </form>
                    <?php } else { ?>
                                    <?php } ?>
                </div>
            </div>
           
        
            <!-- Login Button -->
            <!-- <button class="button-56" onclick="showPopup()">Login</button> -->
        
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