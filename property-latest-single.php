<?php
// Include necessary PHP class files (adjust paths as needed)
include_once 'php-class-file/SessionManager.php';
include_once 'php-class-file/User.php';
include_once 'php-class-file/Property.php';
include_once 'php-class-file/FileManager.php';

// $session = new SessionManager();

$property = new Property();

$imageFiles;
$videoFile;

if (isset($_GET['propertyId'])) {
  $property->property_id = $_GET['propertyId'];
  $property->setValue();
  $propertyDetails->setValueByPropertyId($property->property_id);

  $imageFiles = explode(',', $propertyDetails->property_image_file_ids);
  $videoFile = $propertyDetails->property_video_file_ids;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Property Latest - Single</title>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">


  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">


  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">


  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/property.css">
  <!-- <link rel="stylesheet" href="login.css"> -->
  <!-- <link rel="stylesheet" href="css/agents.css"> -->


  <!-- Include Font Awesome (or any icon library) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
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
  </style>


</head>

<body>
  <header>
    <!-- nav start -->
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
      <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
          aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
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
        </div>
        <!-- LOG IN button inside the navbar collapse -->
        <div class="navbar-collapse collapse justify-content-xl-end" id="navbarDefault">
          <button class="button-85 ml-auto" onclick="location.href='login.html'" role="button">LOG IN</button>
        </div>
      </div>
    </nav>
    <!--/ Nav End /-->
  </header>

  <!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single"><?php echo $propertyDetails->property_title; ?></h1>
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
                  <div class="card-box-ico">
                    <span class="ion-money"><?php echo $propertyDetails->price; ?> </span>
                  </div>
                </div>
              </div>
              <div class="property-summary">
                <div class="summary-list">
                  <ul class="list">
                    <li class="d-flex justify-content-between">
                      <strong>Property ID:</strong>
                      <span><?php echo $propertyDetails->property_id; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Property Type:</strong>
                      <span><?php echo $propertyDetails->property_category; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Location:</strong>
                      <span><?php echo $propertyDetails->address; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>BedRooms:</strong>
                      <span><?php echo $propertyDetails->bedroom_no; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>BathRooms:</strong>
                      <span><?php echo $propertyDetails->bathroom_no; ?></span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Price:</strong>
                      <span><?php echo $propertyDetails->price; ?> Lakh</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Area:</strong>
                      <span><?php echo $propertyDetails->area; ?> m²</span>
                    </li>
                  </ul>
                </div>
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
                  <?php echo $propertyDetails->description; ?>
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
              <iframe src="../file/<?php echo $videoTemp->file_new_name; ?>" width="100%" height="460" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php } ?>
          </div>
        </div>

      </div>
      <!-- <a href="property-review.php" class="btn btn-light btn-bg btn-slide hover-slide-right mt-4 btn-explore">
        <span>Back To Property Review</span>
      </a> -->
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