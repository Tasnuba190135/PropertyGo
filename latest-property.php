<?php
include_once 'php-class-file/Property.php';

// 1. Get all properties by division (status=1)
$property = new Property();
$divisionWisePropertyLists = $property->getRecentRowsForEachDivision(1, 'posted', 'DESC', 5);

// 2. If there are no properties, just show a "no properties found" message below
if (empty($divisionWisePropertyLists)) {
  $divisionNames = [];
} else {
  $divisionNames = array_keys($divisionWisePropertyLists);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recent 5 Properties Division Wise</title>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <!-- Fonts & CSS -->
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/property.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .btn-glossy {
      background: transparent;
      border: 2px solid transparent;
      color: #333;
      padding: 10px 20px;
      border-radius: 8px;
      transition: all 0.3s ease;
      margin: 5px;
      cursor: pointer;
      font-size: 1rem;
    }

    .btn-glossy:hover {
      border-color: #6fb1fc;
    }

    .btn-active {
      border-color: #6fb1fc;
      box-shadow: 0 0 8px 2px rgba(107, 177, 252, 0.6);
    }

    .no-property {
      text-align: center;
      margin-top: 40px;
      font-size: 1.5rem;
      color: #666;
    }
  </style>
</head>

<body>
  <?php include_once 'navbar-user.php'; ?>

  <!-- Intro Section -->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">Recent 5 Properties Division Wise</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Division Buttons -->
  <?php if ($divisionWisePropertyLists) { ?>
    <div class="container mt-4">
      <div class="d-flex justify-content-center flex-wrap">
        <?php foreach (array_keys($divisionWisePropertyLists) as $divisionName): ?>
          <button type="button" class="btn-glossy division-btn" data-division="<?= htmlspecialchars($divisionName) ?>">
            <?= htmlspecialchars($divisionName) ?>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  <?php } ?>

  <!-- Properties Section -->
  <div class="container mt-4" id="properties-container">
    <?php
    if (!$divisionWisePropertyLists) {
      include_once 'pop-up.php';
      showPopup('No property found.');
      echo '<div class="no-property">No property found.</div>';
    } else {
      foreach ($divisionWisePropertyLists as $divisionName => $properties): ?>
        <div class="division-cards" data-division="<?= htmlspecialchars($divisionName); ?>">
          <h2 style="margin-bottom: 40px;"><?= htmlspecialchars($divisionName); ?></h2>
          <div class="row">
            <?php foreach ($properties as $propArray):
              $singleProperty = new Property();
              $singleProperty->setProperties($propArray);
            ?>
              <div class="col-md-4 mb-4">
                <div class="card-box-a card-shadow">
                  <div class="img-box-a">
                    <img src="img/property-3.jpg" alt="" class="img-a img-fluid">
                  </div>
                  <div class="card-overlay">
                    <div class="card-overlay-a-content">
                      <div class="card-header-a">
                        <h2 class="card-title-a">
                          <p><?= $singleProperty->property_title; ?></p>
                        </h2>
                      </div>
                      <div class="card-body-a">
                        <div class="price-box d-flex">
                          <span class="price-a">Price | <?= $singleProperty->price; ?> BDT </span>
                        </div>
                        <a href="property-single.php?propertyId=<?= $singleProperty->property_id; ?>" class="link-a" target="_blank">
                          Click here to view <i class="fa fa-chevron-right"></i>
                        </a>
                      </div>
                      <div class="card-footer-a">
                        <ul class="card-info d-flex justify-content-around">
                          <li>
                            <h4 class="card-info-title">Area</h4>
                            <span><?= $singleProperty->area; ?> m<sup>2</sup></span>
                          </li>
                          <li>
                            <h4 class="card-info-title">Beds</h4>
                            <span><?= $singleProperty->bedroom_no; ?></span>
                          </li>
                          <li>
                            <h4 class="card-info-title">Baths</h4>
                            <span><?= $singleProperty->bathroom_no; ?></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
    <?php endforeach;
    } ?>
  </div>
  

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

  <!-- JS -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <script src="contactform/contactform.js"></script>
  <script src="js/main.js"></script>
  <script src="js/service.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var buttons = document.querySelectorAll('.division-btn');
      var divisionCards = document.querySelectorAll('.division-cards');

      if (divisionCards.length > 0) {
        divisionCards.forEach((card, index) => {
          card.style.display = index === 0 ? 'block' : 'none';
        });
        buttons.forEach((btn, index) => {
          if (index === 0) btn.classList.add('btn-active');
        });
      }

      buttons.forEach(button => {
        button.addEventListener('click', function() {
          var selectedDivision = this.getAttribute('data-division');
          buttons.forEach(btn => btn.classList.remove('btn-active'));
          this.classList.add('btn-active');
          divisionCards.forEach(card => {
            card.style.display = (card.getAttribute('data-division') === selectedDivision) ? 'block' : 'none';
          });
        });
      });
    });
  </script>
</body>

</html>