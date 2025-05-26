<?php
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;

// Include necessary PHP class files (adjust paths as needed)
include_once 'php-class-file/User.php';
include_once 'php-class-file/Property.php';
include_once 'php-class-file/FileManager.php';
include_once 'php-class-file/UserDetails.php';
include_once 'php-class-file/Comment.php';
include_once 'pop-up.php';

if ($session::get('msg1') != null) {
  showPopup($session::get('msg1'));
  $session::delete('msg1');
}

// Retrieve user session object
$sUser = $session::getObject("user");
$loggedInUser = new User();
$loggedInUser->user_id = 0;
if ($sUser != null) {
  $loggedInUser->user_id = $sUser->user_id;
}

$property = new Property();
$user = new User();
$userDetails = new UserDetails();
$comment = new Comment();
$allComments = null;

$imageFiles;
$videoFile;

if (isset($_POST['submit_comment'])) {
  $comment->property_id = $_POST['property_id'];
  $comment->user_id = $_POST['user_id'];
  $comment->comment = $_POST['comment'];
  $comment->status = 1;
  $result = $comment->insert();
  if ($result) {
    $session::set('msg1', 'Comment posted successfully!');
    echo "<script>window.location.href='property-single.php?propertyId=" . $_POST['property_id'] . "';</script>";
    exit();
  } else {
    $session::set('msg1', 'Failed to post comment. Please try again.');
    echo "<script>window.location.href='property-single.php?propertyId=" . $_POST['property_id'] . "';</script>";
    exit();
  }
}

if (isset($_GET['propertyId'])) {
  $property->property_id = $_GET['propertyId'];
  $allComments = $comment->getCommentsByFilters(null, $property->property_id, 1);
  $property->getByPropertyIdAndStatus($property->property_id);
  $user->user_id = $property->user_id;
  $user->setValue();
  $userDetails->setValueByUserId($user->user_id);

  $imageFiles = explode(',', $property->property_image_file_ids);
  $videoFile = $property->property_video_file_ids;
  // echo $videoFile . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PG v3</title>
  <link href="img/favicon.ico" rel="icon">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/property.css">


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
      color: #000;
      /* Adjust text color as needed for contrast */
    }

    /* newsletter start */
    .newsletter-sub-text {
      font-size: 20px;
      color: #bbbbbb;
      margin-bottom: 20px;
      line-height: 1.5;
      text-align: left;
    }

    .cta-section {
      padding: 120px 0;
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../img/cta-bg.jpg');
      background-size: cover;
      background-position: center;

    }

    .cta-wrapper {
      max-width: 600px;
      margin: 0 auto;
    }

    .cta-title {
      font-size: 48px;
      font-weight: 600;
      color: var(--light-color);
      margin-bottom: 20px;
    }

    .cta-text {
      font-size: 18px;
      color: #bbbbbb;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .text-justify {
      text-align: justify !important;
    }

    /* newsletter end */
  </style>



</head>

<body>
  <?php include_once 'navbar-user.php'; ?>
  <!--/ Intro Single star /-->
  <section class="intro-single">
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
              <img src="file/<?php echo $fileTemp->file_new_name; ?>" alt="">
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
                    <span class="ion-money">User ID:<?php echo $property->user_id; ?> </span>
                  </div> -->
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
                      <strong>Property Area Category:<?php // echo $property->property_category; 
                                                      ?></strong>
                      <?php
                      $catCode = $property->property_category; // e.g. 'residential' or 'commercial'
                      if ($catCode == 'residential_area') {
                        $displayCat = 'Residential Area';
                        $iconClass  = 'fa-home';
                      } else {
                        $displayCat = 'Commercial Area';
                        $iconClass  = 'fa-building';
                      }
                      // use a grey background
                      $badgeClass = 'bg-secondary text-white';
                      ?>
                      <span class="badge <?= $badgeClass ?> rounded-pill py-1 px-3">
                        <i class="fas <?= $iconClass ?> me-1"></i><?= htmlspecialchars($displayCat) ?>
                      </span>

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

            </div>

            <div class="col-md-7 col-lg-7 section-md-t3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Property Description</h3>
                  </div>
                </div>
              </div>
              <div class="property-description text-justify">
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
                <source src="file/<?php echo $videoTemp->file_new_name; ?>" type="video/mp4">
                Your browser does not support the video tag.
              <?php } else { ?>
                <p class="text-center">No video available for this property.</p>
              <?php } ?>
          </div>
        </div>

      </div>
      <!-- <a href="property-review.php" class="btn btn-light btn-bg btn-slide hover-slide-right mt-4 btn-explore">
        <span>Back To Property Review</span>
      </a> -->
    </div>
  </section>

  <section class="cta-section py-5">
    <div class="container">
      <div class="row align-items-center">

        <!-- Text Section -->
        <div class="col-md-6 mb-4 mb-md-0">
          <div class="cta-wrapper">
            <h2 class="cta-title">Contact with Owner</h2>
            <p class="cta-text">
              If you want to add more details about this property or buy this property,
              contact with property owner.
            </p>
          </div>
        </div>

        <!-- Profile Card Section -->
        <div class="col-md-6">
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="row g-0 p-3">
              <!-- Details -->
              <div class="col">
                <div class="card-body">
                  <h5 class="card-title mb-3">Owner Information</h5>
                  <p class="mb-2"><i class="fas fa-user me-2 text-primary"></i>
                    <span class="fw-semibold"><?php echo $userDetails->full_name; ?></span>
                  </p>
                  <p class="mb-2"><i class="fas fa-phone-alt me-2 text-success"></i>
                    <a href="tel:<?php echo $userDetails->contact_no; ?>" class="text-decoration-none">
                      <?php echo $userDetails->contact_no; ?>
                    </a>
                  </p>
                  <p class="mb-3"><i class="fas fa-envelope me-2 text-danger"></i>
                    <a href="mailto:<?php echo $user->email; ?>" class="text-decoration-none">
                      <?php echo $user->email; ?>
                    </a>
                  </p>
                  <div class="d-grid">
                    <a href="mailto:<?php echo $user->email; ?>"
                      class="btn btn-primary btn-sm">
                      <i class="fas fa-paper-plane me-1"></i> Contact Owner
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Comment Section Start -->
  <section id="comments" class="container my-5">
    <h3 class="mb-4">Comments</h3>

    <?php if (!empty($allComments)): ?>
      <?php foreach ($allComments as $c):
        $comment->setProperties($c);
        $tempUserDetails = new UserDetails();
        $tempUserDetails->user_id = $c['user_id'];
        $tempUserDetails->setValueByUserId($c['user_id'], 1);
      ?>
        <div class="card mb-3">
          <div class="card-body">
            <h6 class="card-subtitle mb-1 text-primary">
              <?php echo $tempUserDetails->full_name; ?>
            </h6>
            <p class="card-text"><?php echo $comment->comment; ?></p>
            <small class="text-muted"><?php echo $comment->created; ?></small>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-muted">No comments yet. Be the first to comment!</p>
    <?php endif; ?>

    <hr>

    <?php if ($loggedInUser->user_id != 0): ?>
      <h4 class="mt-4">Leave a Comment <?php echo $loggedInUser->user_id; ?></h4>
      <form method="post" action="">
        <input
          type="hidden"
          name="property_id"
          value="<?php echo $property->property_id; ?>">
        <input
          type="hidden"
          name="user_id"
          value="<?php echo $loggedInUser->user_id; ?>">
        <div class="mb-3">
          <label for="comment_text" class="form-label">Your Comment</label>
          <textarea
            name="comment"
            id="comment_text"
            class="form-control"
            rows="4"
            required></textarea>
        </div>
        <button
          type="submit"
          name="submit_comment"
          class="btn btn-primary">
          Post Comment
        </button>
      </form>
    <?php else: ?>
      <p class="text-danger">
        You must <a href="login.php">log in</a> to leave a comment.
      </p>
    <?php endif; ?>
  </section>
  <!-- Comment Section End -->




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


  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="js/main.js"></script>

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