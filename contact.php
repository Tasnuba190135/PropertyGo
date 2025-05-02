<?php
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;
$session::ensureSessionStarted();

if($session::get('redirect_url')) {
  $session::delete('redirect_url');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Page</title>
        <!-- Favicon -->
        <!-- <link href="img/favicon.ico" rel="icon"> -->
        <link href="img/favicon.png" rel="icon">
        <link href="img/favicon.ico" rel="icon">
        <link href="img/apple-touch-icon.png" rel="apple-touch-icon">



        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

        
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    
          <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    
        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/navbar.css">
        <!-- <link rel="stylesheet" href="css/agents.css"> -->


        <!-- Include Font Awesome (or any icon library) -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
<style>
.custom-padding {
  padding-left: 50px;
}
</style>
    
</head>
<body>
<?php include_once 'navbar-user.php'; ?>
  <!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box text-justify">
            <h1 class="title-single">Contact US</h1>
            <span class="color-text-a">Our team at Property Go is ready to support you every step of the way.
            Whether you’re buying, selling, or just exploring options, feel free to reach out — we're here to help you find the perfect solution.</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <!--/ Contact Star /-->
  <!--/ Contact Start /-->
  <section class="contact py-5">
  <div class="container">
    <div class="row align-items-start">
      <!-- Column 1: Map -->
      <div class="col-md-6">
        <div class="contact-map box">
          <div id="map" class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3666.2650700885056!2d89.12284257430873!3d23.233439408428197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff1857827d6cb7%3A0xecab69d917b1a29b!2sJashore%20University%20of%20Science%20and%20Technology!5e0!3m2!1sen!2sbd!4v1729562155096!5m2!1sen!2sbd"
              width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <!-- Column 2: Contact Info with spacing and right shift -->
      <div class="col-md-6 custom-padding mt-4 mt-md-0">
        <div class="d-flex flex-column gap-4">
          <div class="icon-box section-b2">
            <div class="icon-box-icon">
              <span class="ion-ios-paper-plane"></span>
            </div>
            <div class="icon-box-content table-cell">
              <h4 class="icon-title">Contact Us:</h4>
              <p class="mb-1">Email. <span class="color-a">tasnim.arisha1823@admin.com</span></p>
              <p class="mb-1">Phone. <span class="color-a">01676057548</span></p>
            </div>
          </div>
          <div class="icon-box section-b2">
            <div class="icon-box-icon">
              <span class="ion-ios-pin"></span>
            </div>
            <div class="icon-box-content table-cell">
              <h4 class="icon-title">Find us in</h4>
              <p class="mb-1">Jashore University of Science and Technology<br> Jashore, Khulna, Bangladesh.</p>
            </div>
          </div>
          <div class="icon-box">
            <div class="icon-box-icon">
              <span class="ion-ios-redo"></span>
            </div>
            <div class="icon-box-content table-cell">
              <h4 class="icon-title">Social networks</h4>
              <div class="socials-footer mt-2">
                <ul class="list-inline">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- End Contact Info Column -->
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

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>


</body>
</html>  