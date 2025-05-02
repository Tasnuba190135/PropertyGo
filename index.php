<?php
include_once 'php-class-file/SessionManager.php';
$session =  SessionStatic::class;
$session::ensureSessionStarted();

if (isset($_GET['logoutMsg']) && $_GET['logoutMsg'] == 2) {
  include_once 'pop-up.php';
  showPopup('Logged out successfully!');
  unset($_GET['logout']);
}

if($session::get('redirect_url')) {
  $session::delete('redirect_url');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
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
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/agents.css">

  <!-- Include Font Awesome (or any icon library) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .text-justify {
      text-align: justify !important;
    }
  </style>
  

</head>

<body>

  <?php include_once 'navbar-user.php'; ?>

  <!--/ Carousel Start /-->
  <section>
    <div class="intro intro-carousel">
      <div id="carousel" class="owl-carousel owl-theme">
        <div class="carousel-item-a intro-item bg-image" style="background-image: url(img/slide-1.jpg)">
          <div class="overlay overlay-a"></div>
          <div class="intro-content display-table">
            <div class="table-cell">
              <div class="container">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="intro-body">
                      <!-- <p class="intro-title-top">Doral, Florida
                      <br> 78345</p> -->
                      <h1 class="intro-title mb-4"> Find Your
                        <br><span class="color-b">Perfect
                          Home</span><br>With Us
                      </h1>
                      <p class="intro-subtitle intro-price">
                        <a href="property-list.php" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4">
                          <span>Explore Now</span>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item-a intro-item bg-image" style="background-image: url(img/slide-2.jpg)">
          <div class="overlay overlay-a"></div>
          <div class="intro-content display-table">
            <div class="table-cell">
              <div class="container">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="intro-body">
                      <!-- <p class="intro-title-top">Doral, Florida
                      <br> 78345</p>
                    <h1 class="intro-title mb-4">
                      <span class="color-b">204 </span> Rino
                      <br> Venda Road Five</h1>
                    <p class="intro-subtitle intro-price">
                      <a href="#"><span class="price-a">rent | $ 12.000</span></a>
                    </p> -->
                      <h1 class="intro-title mb-4"> Find Your
                        <br><span class="color-b">Perfect
                          Home</span><br>With Us
                      </h1>
                      <p class="intro-subtitle intro-price">
                        <a href="property-list.php" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4">
                          <span>Explore Now</span>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item-a intro-item bg-image" style="background-image: url(img/slide-3.jpg)">
          <div class="overlay overlay-a"></div>
          <div class="intro-content display-table">
            <div class="table-cell">
              <div class="container">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="intro-body">
                      <!-- <p class="intro-title-top">Doral, Florida
                      <br> 78345</p>
                    <h1 class="intro-title mb-4">
                      <span class="color-b">204 </span> Alira
                      <br> Roan Road One</h1>
                    <p class="intro-subtitle intro-price">
                      <a href="#"><span class="price-a">rent | $ 12.000</span></a>
                    </p> -->
                      <h1 class="intro-title mb-4"> Find Your
                        <br><span class="color-b">Perfect
                          Home</span><br>With Us
                      </h1>
                      <p class="intro-subtitle intro-price">
                        <a href="property-list.php" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4">
                          <span>Explore Now</span>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Carousel end /-->

  <section class="our-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading-wrapper">
            <h2 class="section-title">We have the service you need</h2>
            <p class="section-subtitle">We are a team of Property Go dedicated to helping you find your
              dream property. Our services include:</p>
          </div>
        </div>
      </div>
      <div class="service-content-cards-wrapper">
        <div class="service-card-wrapper">
          <div class="service-icon">
            <i class="fas fa-home"></i>
          </div>
          <h3>Sell Your Home</h3>
          <p>Turn your property into opportunity. Reach thousands of potential buyers and sell your home faster and smarter with Property Go.</p>
        </div>

        <div class="service-card-wrapper">
          <div class="service-icon">
            <i class="fas fa-home"></i>
          </div>
          <h3>Buy a Home</h3>
          <p>Find the perfect place to call home. Browse a wide range of properties and find that matches to fit your lifestyle, budget, and dreams.</p>
        </div>

        <div class="service-card-wrapper">
          <div class="service-icon">
            <i class="fa fa-street-view"></i>
          </div>
          <h3>About Us</h3>
          <p>We are committed to connecting you with the right property. Learn more how we make property buying and selling simple and secure.</p>
        </div>

        <div class="service-card-wrapper">
          <div class="service-icon">
            <i class="fa fa-heart"></i>
          </div>
          <h3>Need Help?</h3>
          <p>We are ready to assist you with any questions about buying, selling, or exploring properties. We're here to make your journey easier.</p>
        </div>

      </div>
    </div>
  </section>

  <!--/ Agents Start /-->
  <section class="section-agents  mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Latest Properties</h2>
            </div>
          
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card-box-d">
            <div class="property-service-img-wrap">
              <img src="img/property-2.jpg" alt="" class="img-d img-fluid">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="text-box property-service">
            <h2 class="title property-service-title">Find Your Dream Property</h2>
            <p class="property-service-description text-justify">
              Explore a wide range of  properties tailored to your needs. Whether you're
              searching for a cozy family home, a lucrative investment opportunity,  we
              have a diverse collection to choose from.Start your journey with us today and discover the perfect property that matches your lifestyle.
            </p>
            <ul class="property-benefits-lists">
              <li>✅ Verified Property Listings</li>
              <li>✅ Affordable Prices & Flexible Payment Options</li>
              <li>✅ Easy & Secure Transactions</li>
              <li>✅ Trusted by Thousands of Customers</li>
              <li>✅ 24/7 Customer Support for Assistance</li>
              <li>✅ Detailed Property Insights & Virtual Tours</li>
              <li>✅ Direct Communication with Property Owners</li>
              <li>✅ Personalized Recommendations Based on Your Preferences</li>
            </ul>

            <p class="intro-subtitle intro-price">
            <div class=" mt-3">
              <a href="latest-property.php" class="btn btn-light btn-bg btn-slide hover-slide-right mt-4 "
                style="text-align: center;">
                <span>Explore Now</span>
              </a>
            </div>
            </p>

          </div>
        </div>
      </div>
    </div>
    <!-- <div class="card-overlay card-overlay-hover">
              <div class="card-header-d">
                <div class="card-title-d align-self-center">
                  <h3 class="title-d">
                    <a href="agent-single.html" class="link-two">View Details</a>
                  </h3>
                </div>
              </div>
              <div class="card-body-d">
                <p class="content-d color-text-a">
                  23/7 Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                </p>
                <div class="info-agents color-a">
                  <p>
                    <strong>Phone: </strong> +54 356 945234</p>
                  <p>
                    <strong>Email: </strong> abc@example.com</p>
                </div>
              </div>
            </div> -->
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
  </section>
  <!--/ Agents End /-->

  <section class="find-best-place">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="find-best-place-left">
            <h2>Find Best Place For Living </h2>
            <p>Spend vacations in best hotels and resorts find the great place of your
              choice using different searching options.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div>
            <a href="contact.php" class="btn btn-light btn-bg btn-slide hover-slide-right mt-4 "
              style="text-align: center;">
              <span>Contact Us</span>
            </a>
          </div>
        </div>
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