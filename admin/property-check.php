<?php
include_once '../php-class-file/Auth.php';
auth('admin');

// Include necessary PHP class files (adjust paths as needed)
include_once '../php-class-file/SessionManager.php';
include_once '../php-class-file/User.php';
include_once '../php-class-file/UserDetails.php';
include_once '../php-class-file/Property.php';
include_once '../php-class-file/FileManager.php';

// $session = new SessionManager();

$property = new Property();
$user = new User();
$userDetails = new UserDetails();
$imageFiles;
$videoFile;

if (isset($_GET['propertyId'])) {
  $property->property_id = $_GET['propertyId'];
  $property->getByPropertyIdAndStatus($property->property_id);

  $user->user_id = $property->user_id;
  $user->setValue();
  $userDetails->setValueByUserId($user->user_id);

  $imageFiles = explode(',', $property->property_image_file_ids);
  $videoFile = $property->property_video_file_ids;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Property Details Check Page</title>
  <link href="img/favicon.ico" rel="icon">
  <link rel="stylesheet" href="../fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/property.css">


  <style>
     body {
      background-color: #f8f9fa;
    }
    
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 500px;
    }

    .swiper-slide img {
      display: block;
      width: auto;
      height: 80%;
      object-fit: cover;
    }
    .profile-card {
    background: rgba(0, 0, 0, 0.1);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 25px;
    padding: 1rem;
    color: #000; /* Adjust text color as needed for contrast */
  }
  </style>



</head>

<body>
  <h1 style="text-align: center; padding: 30px 0;">Property Details</h1>

  <!--/ Intro Single star /-->
  <section class="intro-single1">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single"><?php echo $property->property_title; ?></h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <section class="swiper-section mb-5">
    <div class="container">
      <!-- Swiper -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          for ($i = 0; $i < count($imageFiles); $i++) {
            $fileTemp = new FileManager();
            $fileTemp->setValueById($imageFiles[$i]);
          ?>
            <div class="swiper-slide">
              <img src="../file/<?php echo $fileTemp->file_new_name; ?>" alt="">
            </div>
          <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section>

  <!--/ Property Single Star /-->
  <section class="property-single nav-arrow-b">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="row justify-content-between">
            <div class="col-md-5 col-lg-4">
              <div class="property-price d-flex justify-content-center foo">
                <div class="card-header-c d-flex">
                  <!-- <div class="card-box-ico">
                    <span class="ion-money">User ID : <?php echo $property->user_id; ?> </span>
                  </div> -->
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Property Details</h3>
                  </div>
                </div>
              </div>
              
              <div class="property-summary">
                <div class="summary-list">
                  <ul class="list">
                    <li class="d-flex justify-content-between">
                      <strong>Address:</strong>
                      <span><?php echo $property->address; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>District</strong>
                      <span><?php echo $property->district; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Division</strong>
                      <span><?php echo $property->division; ?></span>
                    </li>
                    <hr>
                    <li class="d-flex justify-content-between">
                      <strong>Property ID:</strong>
                      <span><?php echo $property->property_id; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Property Area Type:</strong>
                      <span><?php echo $property->property_category; ?></span>
                    </li>

                    <li class="d-flex justify-content-between">
                      <strong>BedRooms:</strong>
                      <span><?php echo $property->bedroom_no; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>BathRooms:</strong>
                      <span><?php echo $property->bathroom_no; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Price:</strong>
                      <span><?php echo $property->price; ?> BDT</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Area:</strong>
                      <span><?php echo $property->area; ?> Square Ft</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="profile-card mt-4 p-3 border rounded">
                <h5 class="text-center">Owner Information</h5>
                <ul class="list-unstyled mt-3">
                  <li class="d-flex justify-content-between">
                    <strong>Name:</strong>
                    <span><?php echo $userDetails->full_name; ?></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Phone:</strong>
                    <span><?php echo $userDetails->contact_no; ?></span>
                  </li>
                  <li class="d-flex justify-content-between">
                    <strong>Email:</strong>
                    <span><?php echo $user->email; ?></span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-md-7 col-lg-7 section-md-t3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Property Description</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a">
                  <?php echo $property->description; ?>
                </p>
              </div>
            </div>
          </div>

        </div>

        <!-- Video -->
        <div class="col-md-12 my-5 ">
          <div class="d-flex align-items-center justify-content-center">
            <?php if ($videoFile) { 
              $videoTemp = new FileManager();
              $videoTemp->setValueById($videoFile);
              ?>
              <!-- TODO: Add video player here -->
              <video width="720" height="480" controls>
                <source src="../file/<?php echo $videoTemp->file_new_name; ?>" type="video/mp4">
                Your browser does not support the video tag.
            <?php } ?>
          </div>
        </div>

      </div>
      <!-- <a href="property-review.php" class="btn btn-light btn-bg btn-slide hover-slide-right mt-4 btn-explore">
        <span>Back To Property Review</span>
      </a> -->
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
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
              <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
              <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
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
    </div>
    <!-- Footer End -->

  </footer>

  <!-- JavaScript Libraries -->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="../js/main.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

<!-- Template Main Javascript File -->
<script src="js/main.js"></script>
<script src="js/service.js"></script>
</body>

</html>