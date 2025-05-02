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
  <title>PG v3</title>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <!-- <link rel="shortcut icon" href="favicon.png" /> -->



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
  <!-- <link rel="stylesheet" href="css/agents.css"> -->


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
  <!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8 text-justify">
          <div class="title-single-box">
            <h1 class="title-single">We Give Great Service For Sell or Buy Property</h1>
            <span class="color-text-a">We are committed to delivering outstanding service whether you're buying your dream property or selling your current one.
Our expert team guides you through every step — from listing and exploring to negotiation and finalization — ensuring a seamless and rewarding experience.
We offer personalized assistance, market insights, and trustworthy advice to help you make confident decisions.
Your satisfaction is our priority, and we work tirelessly to match you with the perfect opportunity or the right buyer.
Discover a hassle-free journey in property transactions with our dedicated support and care.

</span>

          </div>
        </div>
        
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->
  <!--/ About Star /-->
  <section class="section-about">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="about-img-box">
            <img src="img/image_about.jpg" alt="" class="img-fluid">
          </div>
          <!-- <div class="sinse-box">
            <h3 class="sinse-title">Property Go
              <span></span>
              <br> Since 2017</h3>
            <p>Art & Creative</p>
          </div> -->
        </div>
      </div>
    </div>
  </section>
  <!--/ Services Star /-->
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


  <!--/ Services End /-->

  <!-- About Section -->
  <div id="about">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-6"> <img src="img/about4.jpg" class="img-responsive" alt=""> </div>
        <div class="col-xs-12 col-md-6">
          <div class="about-text text-justify">
            <h2>Who We Are</h2>
            <p>At Property Go, we are passionate about helping people find the perfect place to call home or the ideal investment property.
We bring years of expertise in real estate services, combining local market knowledge, professional guidance, and a customer-first approach.
Whether you want to buy, sell, or explore properties, our dedicated team ensures a smooth, transparent, and rewarding experience for every client.
We believe that finding or selling property should be simple, stress-free, and successful — and we work tirelessly to make that a reality.

</p>
            <h3>Why Choose Us?</h3>
            <div class="list-style">
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <ul>
                  <li>Years of Experience</li>
                  <li>Fully Insured</li>
                  <li>Cost Control Experts</li>
                  <li>100% Satisfaction Guarantee</li>
                </ul>
              </div>
              <div class="col-lg-6 col-sm-6 col-xs-12">
                <ul>
                  <li>Free Consultation</li>
                  <li>Satisfied Customers</li>
                  <li>Project Management</li>
                  <li>Affordable Pricing</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="section pt-0">
        <div class="container">
          <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
              <div class="img-about dots">
                <img src="img/hero_bg_3.jpg" alt="Image" class="img-fluid" />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex feature-h">
                <span class="wrap-icon me-3">
                  <span class="icon-home2"></span>
                </span>
                <div class="feature-text">
                  <h3 class="heading">Quality properties</h3>
                  <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum iste.
                  </p>
                </div>
              </div>
  
              <div class="d-flex feature-h">
                <span class="wrap-icon me-3">
                  <span class="icon-person"></span>
                </span>
                <div class="feature-text">
                  <h3 class="heading">Top rated agents</h3>
                  <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum iste.
                  </p>
                </div>
              </div>
  
              <div class="d-flex feature-h">
                <span class="wrap-icon me-3">
                  <span class="icon-security"></span>
                </span>
                <div class="feature-text">
                  <h3 class="heading">Easy and safe</h3>
                  <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum iste.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="section pt-0">
        <div class="container">
          <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0">
              <div class="img-about dots">
                <img src="img/hero_bg_2.jpg" alt="Image" class="img-fluid" />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex feature-h">
                <span class="wrap-icon me-3">
                  <span class="icon-home2"></span>
                </span>
                <div class="feature-text">
                  <h3 class="heading">Quality properties</h3>
                  <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum iste.
                  </p>
                </div>
              </div>
  
              <div class="d-flex feature-h">
                <span class="wrap-icon me-3">
                  <span class="icon-person"></span>
                </span>
                <div class="feature-text">
                  <h3 class="heading">Top rated agents</h3>
                  <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum iste.
                  </p>
                </div>
              </div>
  
              <div class="d-flex feature-h">
                <span class="wrap-icon me-3">
                  <span class="icon-security"></span>
                </span>
                <div class="feature-text">
                  <h3 class="heading">Easy and safe</h3>
                  <p class="text-black-50">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum iste.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
              <img src="img/img_2.jpg" alt="Image" class="img-fluid" />
            </div>
            <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
              <img src="img/img_3.jpg" alt="Image" class="img-fluid" />
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
              <img src="img/img_2.jpg" alt="Image" class="img-fluid" />
            </div>
          </div>
          <div class="row section-counter mt-5">
            <div
              class="col-6 col-sm-6 col-md-6 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="300"
            >
              <div class="counter-wrap mb-5 mb-lg-0">
                <span class="number"
                  ><span class="countup text-primary">2917</span></span
                >
                <span class="caption text-black-50"># of Buy Properties</span>
              </div>
            </div>
            <div
              class="col-6 col-sm-6 col-md-6 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="400"
            >
              <div class="counter-wrap mb-5 mb-lg-0">
                <span class="number"
                  ><span class="countup text-primary">3918</span></span
                >
                <span class="caption text-black-50"># of Sell Properties</span>
              </div>
            </div>
            <div
              class="col-6 col-sm-6 col-md-6 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="500"
            >
              <div class="counter-wrap mb-5 mb-lg-0">
                <span class="number"
                  ><span class="countup text-primary">38928</span></span
                >
                <span class="caption text-black-50"># of All Properties</span>
              </div>
            </div>
            <div
              class="col-6 col-sm-6 col-md-6 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="600"
            >
              <div class="counter-wrap mb-5 mb-lg-0">
                <span class="number"
                  ><span class="countup text-primary">1291</span></span
                >
                <span class="caption text-black-50"># of Agents</span>
              </div>
            </div>
          </div>
        </div>
      </div> -->

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