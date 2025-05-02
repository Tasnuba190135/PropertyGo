<?php
include_once 'php-class-file/SessionManager.php';
$session = new SessionManager();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG v3</title>
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
        
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
                    <form method="post" action="login.php">
                 <button class="button-85 ml-auto"  role="button">LOG IN</button>
                    </form>
                </div>
         </div>
     </nav>
     <!--/ Nav End /-->
 </header>

 
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
                      Home</span><br>With Us</h1>
                                            <!-- <a href="#"><span class="price-a btn btn-light btn-bg btn-slide hover-slide-right mt-4">rent | $ 12.000</span></a> -->

                    <p class="intro-subtitle intro-price">
                   
                        <a href="index.html" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4">
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
                        Home</span><br>With Us</h1>
                      <p class="intro-subtitle intro-price">
                     
                          <a href="index.html" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4">
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
                        Home</span><br>With Us</h1>
                      <p class="intro-subtitle intro-price">
                        <!-- <a href="#"><span class="price-a btn btn-light btn-bg btn-slide hover-slide-right mt-4">rent | $ 12.000</span></a> -->
                     
                          <a href="index.html" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4">
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
    
    <!--/ Services Star /-->
    <section class="section-services section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Our Services</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Buy Section -->
  <div class="col-md-6">
    <div class="card-box-c foo">
      <div class="card-header-c d-flex">
        <div class="card-box-ico">
          <span class="fa fa-home"></span>
        </div>
        <div class="card-title-c align-self-center">
          <h2 class="title-c">Buy</h2>
        </div>
      </div>
      <div class="card-body-c">
        <p class="content-c">
          Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta.ligula sed magna dictum porta
        </p>
        <p class="more-content" id="buyContent">
          Here is the extra content for the Buy section. You can add more details here!
        </p>
      </div>
      <div class="card-footer-c">
        <span class="link-c" id="readMoreBuy" onclick="toggleContent('buyContent', 'readMoreBuy')">Read more <span class="fa fa-arrow-right"></span></span>
      </div>
    </div>
  </div>

  <!-- Sell Section -->
  <!-- <div class="col-md-6">
    <div class="card-box-c foo">
      <div class="card-header-c d-flex">
        <div class="card-box-ico">
          <span class="fa fa-home"></span>
        </div>
        <div class="card-title-c align-self-center">
          <h2 class="title-c">Sell</h2>
        </div>
      </div>
      <div class="card-body-c">
        <p class="content-c">
          Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta.ligula sed magna dictum porta
        </p>
        <p class="more-content" id="sellContent">
          Here is the extra content for the Sell section. Add more details here!
        </p>
      </div>
      <div class="card-footer-c">
        <span class="link-c" id="readMoreSell" onclick="toggleContent('sellContent', 'readMoreSell')">Read more <span class="fa fa-arrow-right"></span></span>
      </div>
    </div>
  </div> -->

  <!-- Rent Section -->
  <div class="col-md-6">
    <div class="card-box-c foo">
      <div class="card-header-c d-flex">
        <div class="card-box-ico">
          <span class="fa fa-home"></span>
        </div>
        <div class="card-title-c align-self-center">
          <h2 class="title-c">Sell</h2>
        </div>
      </div>
      <div class="card-body-c">
        <p class="content-c">
          Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta.ligula sed magna dictum porta
        </p>
        <p class="more-content" id="rentContent">
          Here is the extra content for the Sell section. Add more details here!
        </p>
      </div>
      <div class="card-footer-c">
        <span class="link-c" id="readMoreSell" onclick="toggleContent('rentContent', 'readMoreRent')">Read more <span class="fa fa-arrow-right"></span></span>
        
      </div>
    </div>
  </div>

          </div>        
        </div>
      </div>
    </section>
    <!--/ Services End /-->
  
  <!--/ Agents Start /-->
  <section class="section-agents section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Latest Properties</h2>
            </div>
            <div class="title-link">
              <a href="agents-grid.html">All Properties
                <span class="fa fa-arrow-right"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card-box-d">
            <div class="card-img-d">
              <img src="img/property-1.jpg" alt="" class="img-d img-fluid">
            </div>
            <div class="card-overlay card-overlay-hover">
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
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-d">
            <div class="card-img-d">
              <img src="img/property-2.jpg" alt="" class="img-d img-fluid">
            </div>
            <div class="card-overlay card-overlay-hover">
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
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-d">
            <div class="card-img-d">
              <img src="img/property-3.jpg" alt="" class="img-d img-fluid">
            </div>
            <div class="card-overlay card-overlay-hover">
              <div class="card-header-d">
                <div class="card-title-d align-self-center">
                  <h3 class="title-d">
                    <a href="agent-single.html" class="link-two">Emma Toledo</a>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Agents End /-->

  <!-- clients review start -->
  <div class="testimonial-container1">
    <h2 class=" font-weight-bold heading text-primary mb-4 mb-md-0 title-a">Our clients Says </h2>
  </div>
  <div class="testimonial-container" id="testimonialContainer">
<!-- HTML !-->
<!-- <button class="button-57" role="button"><span class="text">Button 57</span><span>Previous Review</span></button> -->

    <!-- <button class="slider-btn prev" onclick="prevTestimonial()">Prev</button> -->
    <button class=".slider-btn button-57" onclick="prevTestimonial()"><span class="ion-ios-arrow-back"></span><span class="ion-ios-arrow-back"></span></button>

    <!-- Testimonial Cards -->
    <div class="testimonial-card">
      <img src="img/agent-1.jpg" alt="Customer 1">
      <div class="stars">★★★★★</div>
      <div class="customer-name">James Smith</div>
      <div class="designation">Designer, Co-founder</div>
      <p class="testimonial-text">"Great service, highly recommend!"</p>
    </div>
    <div class="testimonial-card">
      <img src="img/agent-2.jpg" alt="Customer 2">
      <div class="stars">★★★★★</div>
      <div class="customer-name">Mike Houston</div>
      <div class="designation">Designer, Co-founder</div>
      <p class="testimonial-text">"Very professional experience."</p>
    </div>
    <div class="testimonial-card">
      <img src="img/agent-3.jpg" alt="Customer 3">
      <div class="stars">★★★★★</div>
      <div class="customer-name">Cameron Webster</div>
      <div class="designation">Designer, Co-founder</div>
      <p class="testimonial-text">"Would definitely work with them again."</p>
    </div>
    <div class="testimonial-card">
      <img src="img/agent-4.jpg" alt="Customer 1">
      <div class="stars">★★★★★</div>
      <div class="customer-name">James Smith</div>
      <div class="designation">Designer, Co-founder</div>
      <p class="testimonial-text">"Great service, highly recommend!"</p>
    </div>
    <div class="testimonial-card">
      <img src="img/agent-5.jpg" alt="Customer 2">
      <div class="stars">★★★★★</div>
      <div class="customer-name">Mike Houston</div>
      <div class="designation">Designer, Co-founder</div>
      <p class="testimonial-text">"Very professional experience."</p>
    </div>
    <div class="testimonial-card">
      <img src="img/agent-6.jpg" alt="Customer 3">
      <div class="stars">★★★★★</div>
      <div class="customer-name">Cameron Webster</div>
      <div class="designation">Designer, Co-founder</div>
      <p class="testimonial-text">"Would definitely work with them again."</p>
    </div>

    <!-- Add more testimonial cards as needed -->
  
    <!-- Next Button -->
    <!-- <button class="slider-btn next" onclick="nextTestimonial()">Next</button> -->
    <button class=".slider-btn button-57" onclick="nextTestimonial()"><span class="ion-ios-arrow-forward"></span> <span class="ion-ios-arrow-forward"></span></button>

  </div>
    <!-- us section -->
    <section class="us_section layout_padding2">

      <div class="container">
        <div class="heading_container">
          <h2>
            Why Choose Us
          </h2>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="box">
              <div class="img-box">
                <img src="img/u-1.png" alt="">
              </div>
              <div class="detail-box">
                <h3>
                  1000+
                </h3>
                <h5>
                  Years of House
                </h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="box">
              <div class="img-box">
                <img src="img/u-2.png" alt="">
              </div>
              <div class="detail-box">
                <h3>
                  20000+
                </h3>
                <h5>
                  Projects Delivered
                </h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="box">
              <div class="img-box">
                <img src="img/u-3.png" alt="">
              </div>
              <div class="detail-box">
                <h3>
                  10000+
                </h3>
                <h5>
                  Satisfied Customers
                </h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="box">
              <div class="img-box">
                <img src="img/u-4.png" alt="">
              </div>
              <div class="detail-box">
                <h3>
                  1500+
                </h3>
                <h5>
                  Cheap Rates
                </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="btn-box">
          <a href="">
            Get A Quote
          </a>
        </div>
      </div>
    </section>
  
    <!-- end us section -->
  
  
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