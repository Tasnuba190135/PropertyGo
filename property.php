<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PG v3</title>

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
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">


  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/property.css">
  <!-- <link rel="stylesheet" href="login.css"> -->
  <!-- <link rel="stylesheet" href="css/agents.css"> -->


  <!-- Include Font Awesome (or any icon library) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">





    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
        }
        .slider-container {
            position: relative;
            max-width: 800px; /* Increased width */
            margin: auto;
        }
        .slider {
            overflow: hidden;
            border-radius: 10px;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slides img {
            width: 1000px;
            height: 450px;
            display: block;
        }
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }
        .prev { left: -50px; } /* Placed outside the image */
        .next { right: -50px; }
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
  <section class="property-single nav-arrow-b">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">304 Blaster Up(For Sale)</h1>
            <span class="color-text-a">23/7 Dhanmondi, Dhaka</span>
          </div>
        </div>
      </div>
    </div>
   

  </section>
  <!--/ Intro Single End /-->

    <!-- <div class="container mt-5">
        <h1>304 Blaster Up (For Sale)</h1>
        <p class="text-muted">23/7 Dhanmondi, Dhaka</p> -->
        
        <div class="slider-container">
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <div class="slider">
                <div class="slides" id="slideContainer">
                    <img src="./img/slide-1.jpg" alt="Property Image 1">
                    <img src="./img/slide-2.jpg" alt="Property Image 2">
                    <img src="./img/slide-3.jpg" alt="Property Image 3">
                </div>
            </div>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
        
        <!-- <div class="row mt-4">
            <div class="col-md-4">
                <h3>Price: 15 Lakh</h3>
                <ul>
                    <li>Property ID: 1134</li>
                    <li>Type: Residential</li>
                    <li>Location: Dhanmondi, Dhaka</li>
                    <li>Bedrooms: 4</li>
                    <li>Bathrooms: 2</li>
                    <li>Area: 340m²</li>
                </ul>
            </div>
            <div class="col-md-8">
                <h3>Description</h3>
                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>
            </div>
        </div>
    </div> -->
    <div class="row justify-content-between">
            <div class="col-md-5 col-lg-4">
              <div class="property-price d-flex justify-content-center foo">
                <div class="card-header-c d-flex">
                  <div class="card-box-ico">
                    <span class="ion-money">15 </span>
                  </div>
                  <div class="card-title-c align-self-center">
                    <h5 class="title-c">Lakh</h5>
                  </div>
                </div>
              </div>
              <div class="property-summary">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d section-t4">
                      <h3 class="title-d">Type: For Sale</h3>
                    </div>
                    <div class="title-box-d section-t2">
                      <h3 class="title-d">Quick Summary</h3>
                    </div>
                  </div>
                </div>
                <div class="summary-list">
                  <ul class="list">
                    <li class="d-flex justify-content-between">
                      <strong>Property ID:</strong>
                      <span>1134</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Property Type:</strong>
                      <span>Residential</span>
                    </li>
                    <!-- <li class="d-flex justify-content-between">
                      <strong>Status:</strong>
                      <span>Sale</span>
                    </li> -->
                    <li class="d-flex justify-content-between">
                      <strong>Division:</strong>
                      <span>Dhaka</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Location:</strong>
                      <span>24/7 Dhanmondi,Dhaka</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>BedRooms:</strong>
                      <span>4</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>BathRooms:</strong>
                      <span>2</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Price:</strong>
                      <span>15lakh</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <strong>Area:</strong>
                      <span>340m
                        <sup>2</sup>
                      </span>
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
                  Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit
                  neque, auctor sit amet
                  aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta.
                  Curabitur aliquet quam id dui posuere blandit. Mauris blandit aliquet elit, eget tincidunt
                  nibh pulvinar quam id dui posuere blandit.
                </p>
                <p class="description color-text-a no-margin">
                  Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget
                  malesuada. Quisque velit nisi,
                  pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.
                </p>
              </div>
              <div class="row section-t3">
                <div class="col-sm-12">
                  <!-- <div class="title-box-d">
                    <h3 class="title-d">Amenities</h3>
                  </div> -->
                </div>
              </div>
              <div class="amenities-list color-text-a">
                <ul class="list-a no-margin">
                  <li>Balcony</li>
                  <li>Outdoor Kitchen</li>
                  <li>Cable Tv</li>
                  <li>Deck</li>
                  <li>Tennis Courts</li>
                  <li>Internet</li>
                  <li>Parking</li>
                  <li>Sun Room</li>
                  <li>Concrete Flooring</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-10 offset-md-1">
          <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab"
                aria-controls="pills-video" aria-selected="true">Video</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-plans-tab" data-toggle="pill" href="#pills-plans" role="tab"
                aria-controls="pills-plans" aria-selected="false">Floor Plans</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab"
                aria-controls="pills-map" aria-selected="false">Ubication</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
              <iframe src="https://player.vimeo.com/video/73221098" width="100%" height="460" frameborder="0"
                webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
              <img src="img/plan2.jpg" alt="" class="img-fluid">
            </div>
            <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834"
                width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
      <a href="payment.html" class=" btn btn-light btn-bg btn-slide hover-slide-right mt-4 btn-explore">
        <span>Proceed To Go Ahead</span>
      </a>
    </div>

    
    <footer class="bg-dark text-white text-center p-3 mt-5">
        <p>&copy; 2025 PropertyGo. All Rights Reserved.</p>
    </footer>

    <script>
        let index = 0;
        function moveSlide(direction) {
            const slides = document.getElementById('slideContainer');
            const totalSlides = slides.children.length;
            index = (index + direction + totalSlides) % totalSlides;
            slides.style.transform = `translateX(-${index * 800}px)`; // Adjusted for new width
        }
    </script>
</body>
</html>
