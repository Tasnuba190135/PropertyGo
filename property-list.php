<?php
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;

if($session::get('redirect_url')) {
  $session::delete('redirect_url');
}

include_once 'php-class-file/Property.php';
include_once 'php-class-file/Division.php'; // Include the file that defines $divisions
$divisions = getDivisions();

$property = new Property();
$propertyLists = $property->getByPropertyIdAndStatus(null, 1, 'posted', 'DESC');
// echo sizeof($propertyLists) . "<br>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Properties Page</title>
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
    /* Filter Card Styling */
    .filter-card {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-card label {
      font-size: 0.9rem;
      color: #555;
    }

    .filter-card .form-control {
      border: 1px solid #ccc;
      border-radius: 4px;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .filter-card button {
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .filter-card button:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-glossy {
      background: linear-gradient(145deg, #6fb1fc, #4364f7);
      border: none;
      color: #fff;
    }

    .btn-glossy:hover {
      background: linear-gradient(145deg, #4364f7, #6fb1fc);
    }
  </style>

  <!-- Dynamic District Dropdown Script -->
  <script>
    // Pass the PHP associative array to JavaScript
    var divisionsData = <?php echo json_encode($divisions); ?>;

    function updateDistricts() {
      var divisionSelect = document.getElementById('division');
      var districtSelect = document.getElementById('district');
      var selectedDivision = divisionSelect.value;

      // Clear current options
      districtSelect.innerHTML = "";

      // Populate the district dropdown based on the selected division
      if (divisionsData[selectedDivision]) {
        divisionsData[selectedDivision].forEach(function(district) {
          var option = document.createElement("option");
          option.value = district;
          option.text = district;
          districtSelect.appendChild(option);
        });
      } else {
        districtSelect.innerHTML = '<option value="">No district available</option>';
      }
    }

    // Update district dropdown on page load and when division changes
    document.addEventListener("DOMContentLoaded", function() {
      updateDistricts();
      document.getElementById('division').addEventListener('change', updateDistricts);
    });
  </script>
</head>

<body>
  <?php include_once 'navbar-user.php'; ?>

  <!-- Intro Section -->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">Properties</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if ($propertyLists === false) { ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>No properties found.</h2>
        </div>
      </div>
    </div>
  <?php } else { ?>

    <!-- Filter UI -->
    <div class="property-filter filter-card">
      <div class="container">
        <!-- Filter Line 1: Main Filters -->
        <div id="filter-line1" class="row align-items-end">
          <!-- Property Type -->
          <div class="col-12 col-md-2">
            <label for="property-type">Property Area Type:</label>
            <select id="property-type" class="form-control">
              <option value="">Select Type</option>
              <option value="">All Type</option>
              <option value="residential_area">Residential Area</option>
              <option value="commercial_area">Commercial Area</option>
            </select>
          </div>
          <!-- Division -->
          <div class="col-12 col-md-2">
            <label for="division">Division:</label>
            <select id="division" class="form-control">
              <option value="">Select Division</option>
              <?php
              // Loop through the $divisions array to output each division as an option
              foreach ($divisions as $divisionName => $districtArray) {
                echo '<option value="' . htmlspecialchars($divisionName) . '">' . ucfirst($divisionName) . '</option>';
              }
              ?>
            </select>
          </div>
          <!-- District -->
          <div class="col-12 col-md-2">
            <label for="district">District:</label>
            <select id="district" class="form-control">
              <option value="">Select District</option>
            </select>
          </div>
          <!-- Price Range -->
          <div class="col-12 col-md-3">
            <label>Price Range:</label>
            <div class="row">
              <div class="col-6">
                <input type="number" id="min-price" class="form-control" placeholder="Min Price" min="0">
              </div>
              <div class="col-6">
                <input type="number" id="max-price" class="form-control" placeholder="Max Price" min="0">
              </div>
            </div>
          </div>
          <!-- Button Container for Line 1 -->
          <div class="col-12 col-md-3 d-flex align-items-end justify-content-end" id="button-container-line1">
            <button id="search-btn-line1" class="btn btn-glossy me-2">Search</button>
            <button id="reset-btn-line1" class="btn btn-outline-danger me-2">Reset</button>
            <button id="toggle-btn" class="btn btn-secondary">More Filters</button>
          </div>
        </div>
        <!-- Filter Line 2: Extra Fields (Initially hidden) -->
        <div id="filter-line2" class="row mt-3" style="display: none;">
          <div class="col-6">
            <label for="bedroom">Bedrooms:</label>
            <input type="number" id="bedroom" class="form-control" placeholder="Number of Bedrooms" min="1">
          </div>
          <div class="col-6">
            <label for="bathroom">Bathrooms:</label>
            <input type="number" id="bathroom" class="form-control" placeholder="Number of Bathrooms" min="1">
          </div>
          <!-- Action Buttons in Line 2 -->
          <div class="col-12 mt-3">
            <button id="search-btn-line2" class="btn btn-glossy me-2">Search</button>
            <button id="reset-btn-line2" class="btn btn-outline-danger">Reset</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Filter UI -->

    <!-- Property Grid -->
    <section class="intro-single property-grid grid">
      <div class="container">
        <div class="row">
          <?php
          foreach ($propertyLists as $prop) {
            $singleProperty = new Property();
            $singleProperty->setProperties($prop);
          ?>
            <!-- Card Start -->
            <div class="col-md-4 property-card"
              data-price="<?php echo $singleProperty->price; ?>"
              data-category="<?php echo $singleProperty->property_category; ?>"
              data-division="<?php echo $singleProperty->division; ?>"
              data-district="<?php echo $singleProperty->district; ?>"
              data-bedroom="<?php echo $singleProperty->bedroom_no; ?>"
              data-bathroom="<?php echo $singleProperty->bathroom_no; ?>"
              data-area="<?php echo $singleProperty->area; ?>">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="img/property-3.jpg" alt="" class="img-a img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <h2 class="card-title-a">
                        <p><?php echo $singleProperty->property_title; ?></p>
                      </h2>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">Price | <?php echo $singleProperty->price; ?> BDT </span>
                      </div>
                      <a href="property-single.php?propertyId=<?php echo $singleProperty->property_id; ?>" class="link-a" target="_blank">Click here to view
                        <i class="fa fa-chevron-right"></i>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Area</h4>
                          <span><?php echo $singleProperty->area; ?> m<sup>2</sup></span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Beds</h4>
                          <span><?php echo $singleProperty->bedroom_no; ?></span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Baths</h4>
                          <span><?php echo $singleProperty->bathroom_no; ?></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card End -->
          <?php } ?>
        </div>
        <!-- Pagination -->
        <div class="row">
          <div class="col-sm-12">
            <nav class="pagination-a">
              <ul class="pagination justify-content-end"></ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>

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
  <script src="contactform/contactform.js"></script>
  <script src="js/main.js"></script>
  <script src="js/service.js"></script>

  <!-- Combined JavaScript: Toggle UI, Search, Reset & Pagination -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Toggle between More Filters and Less Filters
      document.getElementById('toggle-btn').addEventListener('click', function() {
        if (this.textContent.trim() === "More Filters") {
          document.getElementById('search-btn-line1').style.display = 'none';
          document.getElementById('reset-btn-line1').style.display = 'none';
          this.textContent = "Less Filters";
          document.getElementById('filter-line2').style.display = 'flex';
        } else {
          document.getElementById('filter-line2').style.display = 'none';
          document.getElementById('search-btn-line1').style.display = 'inline-block';
          document.getElementById('reset-btn-line1').style.display = 'inline-block';
          this.textContent = "More Filters";
        }
      });

      function resetFilters() {
        document.getElementById("property-type").value = '';
        document.getElementById("division").value = '';
        document.getElementById("district").value = '';
        document.getElementById("min-price").value = '';
        document.getElementById("max-price").value = '';
        document.getElementById("bedroom").value = '';
        document.getElementById("bathroom").value = '';
        document.getElementById('filter-line2').style.display = 'none';
        document.getElementById('search-btn-line1').style.display = 'inline-block';
        document.getElementById('reset-btn-line1').style.display = 'inline-block';
        document.getElementById('toggle-btn').textContent = "More Filters";
        generatePagination(allCards);
      }

      document.getElementById('reset-btn-line1').addEventListener('click', resetFilters);
      document.getElementById('reset-btn-line2').addEventListener('click', resetFilters);

      const allCards = Array.from(document.querySelectorAll('.property-card'));
      const cardsPerPage = 6; // Adjust as needed

      function filterProperties() {
        const minPrice = parseFloat(document.getElementById("min-price").value) || null;
        const maxPrice = parseFloat(document.getElementById("max-price").value) || null;
        const propertyType = document.getElementById("property-type").value;
        const division = document.getElementById("division").value;
        const district = document.getElementById("district").value;
        const bedroom = parseInt(document.getElementById("bedroom").value) || null;
        const bathroom = parseInt(document.getElementById("bathroom").value) || null;

        return allCards.filter(card => {
          const price = parseFloat(card.getAttribute("data-price"));
          const cat = card.getAttribute("data-category");
          const div = card.getAttribute("data-division");
          const dist = card.getAttribute("data-district");
          const bed = parseInt(card.getAttribute("data-bedroom"));
          const bath = parseInt(card.getAttribute("data-bathroom"));

          if (minPrice !== null && price < minPrice) return false;
          if (maxPrice !== null && price > maxPrice) return false;
          if (propertyType && propertyType !== cat) return false;
          if (division && division !== div) return false;
          if (district && district !== dist) return false;
          if (bedroom !== null && bed !== bedroom) return false;
          if (bathroom !== null && bath !== bathroom) return false;
          return true;
        });
      }

      function generatePagination(filteredCards) {
        const totalPages = Math.ceil(filteredCards.length / cardsPerPage);
        const paginationContainer = document.querySelector('.pagination-a ul.pagination');
        let paginationHTML = `<li class="page-item previous">
                                <a class="page-link" href="#" aria-label="Previous">
                                  <i class="fa fa-chevron-left"></i>
                                </a>
                              </li>`;
        for (let i = 1; i <= totalPages; i++) {
          paginationHTML += `<li class="page-item" data-page="${i}">
                               <a class="page-link" href="#">${i}</a>
                             </li>`;
        }
        paginationHTML += `<li class="page-item next">
                             <a class="page-link" href="#" aria-label="Next">
                               <i class="fa fa-chevron-right"></i>
                             </a>
                           </li>`;
        paginationContainer.innerHTML = paginationHTML;
        attachPaginationEvents(filteredCards, totalPages);
        showPage(filteredCards, 1);
      }

      function showPage(filteredCards, page) {
        allCards.forEach(card => card.style.display = 'none');
        filteredCards.forEach((card, index) => {
          if (index >= (page - 1) * cardsPerPage && index < page * cardsPerPage) {
            card.style.display = 'block';
          }
        });
        const pageButtons = document.querySelectorAll('.pagination-a .page-item[data-page]');
        pageButtons.forEach(btn => {
          btn.classList.remove('active');
          if (parseInt(btn.getAttribute('data-page')) === page) {
            btn.classList.add('active');
          }
        });
      }

      function attachPaginationEvents(filteredCards, totalPages) {
        const paginationLinks = document.querySelectorAll('.pagination-a .page-item[data-page]');
        paginationLinks.forEach(link => {
          link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = parseInt(this.getAttribute('data-page'));
            showPage(filteredCards, page);
          });
        });

        const previousBtn = document.querySelector('.pagination-a .page-item.previous');
        const nextBtn = document.querySelector('.pagination-a .page-item.next');

        previousBtn.addEventListener('click', function(e) {
          e.preventDefault();
          const current = document.querySelector('.pagination-a .page-item.active');
          let currentPage = current ? parseInt(current.getAttribute('data-page')) : 1;
          if (currentPage > 1) {
            showPage(filteredCards, currentPage - 1);
          }
        });

        nextBtn.addEventListener('click', function(e) {
          e.preventDefault();
          const current = document.querySelector('.pagination-a .page-item.active');
          let currentPage = current ? parseInt(current.getAttribute('data-page')) : 1;
          if (currentPage < totalPages) {
            showPage(filteredCards, currentPage + 1);
          }
        });
      }

      function performSearch() {
        const filteredCards = filterProperties();
        generatePagination(filteredCards);
      }

      document.getElementById('search-btn-line1').addEventListener('click', performSearch);
      document.getElementById('search-btn-line2').addEventListener('click', performSearch);

      generatePagination(allCards);
    });
  </script>
</body>

</html>