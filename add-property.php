<?php
// Include necessary PHP class files
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;
$session::ensureSessionStarted();

include_once 'php-class-file/User.php';
include_once 'php-class-file/Property.php';
include_once 'php-class-file/FileManager.php';
include_once 'pop-up.php';

if($session::get('msg1')) {
  showPopup($session::get('msg1'));
  $session::delete('msg1');
}

// Retrieve user session object
$sUser = $session::getObject("user");

// If the user is not logged in, set the redirect and send them to login page.
if (!$sUser) {
  // Save the current page URL (or identifier) in the session.
  $session::set('redirect_url', 'add-property.php'); // update with your actual add property page filename
  $session::set('msg1', 'You need to login to post a property.');
  header('Location: login.php');
  exit();
}

// Create a new User object and set its user_id from the session
$user = new User();
if ($sUser) {
  // echo $sUser->user_id . " ok ----- <br>";
  $user->user_id = $sUser->user_id;
  $user->setValue();
} else {
  // If not logged in, set a session message
  $session::set('msg1', 'You need to login to post a property.');
}

// Helper function to re-array the $_FILES array for multiple uploads
function reArrayFiles($filePost)
{
  $fileArr = [];
  $fileCount = count($filePost['name']);
  $fileKeys  = array_keys($filePost);

  for ($i = 0; $i < $fileCount; $i++) {
    foreach ($fileKeys as $key) {
      $fileArr[$i][$key] = $filePost[$key][$i];
    }
  }
  return $fileArr;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  if ($sUser) {
    // Retrieve form inputs
    $propertyTitle       = $_POST['property-title'];
    $propertyAreaCategory    = $_POST['property_area_category'];
    $division            = $_POST['division'];
    $district            = $_POST['district'];
    $address             = $_POST['address'];
    $bedroom_no             = $_POST['bedroom_no'];
    $bathroom_no            = $_POST['bathroom_no'];
    $price               = $_POST['price'];
    $area                = $_POST['area'];
    $propertyDescription = $_POST['property-description'];
    // echo $propertyTitle . "<br>";

    // Handle file uploads for multiple images and a single video
    $imageFilesOriginal = $_FILES['upload-image'];
    $videoFile          = $_FILES['upload-video'];

    // Normalize the image files array
    $imageFiles = reArrayFiles($imageFilesOriginal);
    $imageFileIds = [];

    foreach ($imageFiles as $file) {
      if ($file['error'] === 0) {
        $fileManager = new FileManager();
        $fileManager->file_owner_id = $user->user_id;
        $fileManager->insert();
        $fileManager->doOp($file); // Process the full file object
        $fileManager->update();
        $imageFileIds[] = $fileManager->file_id;
      }
    }

    // Process video file (assume single video)
    $videoFileId = null;
    if ($videoFile['error'] === 0) {
      $fileManager = new FileManager();
      $fileManager->file_owner_id = $user->user_id;
      $fileManager->insert();
      $fileManager->doOp($videoFile); // Pass the full video file object
      $fileManager->update();
      $videoFileId = $fileManager->file_id;
    }

    // Insert property record
    $property = new Property();
    $property->user_id = $user->user_id;
    $property->property_title = $propertyTitle;
    $property->property_category = $propertyAreaCategory;
    $property->area = $area;
    $property->description = $propertyDescription;
    $property->division = $division;
    $property->district = $district;
    $property->address = $address;
    $property->bedroom_no = $bedroom_no;
    $property->bathroom_no = $bathroom_no;
    $property->price = $price;

    $property->property_image_file_ids = implode(',', $imageFileIds);
    // [1,2,3] -> "1,2,3"
    $property->property_video_file_ids = $videoFileId;
    $property->insert();

    // $session::set('msg1', 'Property added successfully.');
    // echo "<script>window.location.href.reload();</script>";
    
    $session::set('msg1', 'Property #' . $property->property_id . ' added successfully. Please wait for admin approval.');
    echo "<script>window.location.href='add-property.php';</script>";
    exit;
  } else {
    $session::set('msg1', 'Failed to add property.');
    echo "<script>window.location.href='add-property.php';</script>";
    exit;
  }
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
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
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
  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/property.css">
  <!-- Include Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  body {
    font-family: 'Poppins', sans-serif !important;
    color: #555555 !important;
  }
 
</style>
</head>
  
  
 

<body>
  <?php include_once 'navbar-user.php'; ?>

  <div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" data-stellar-background-ratio="0.5"
      style="background-image: url('img/slide-3.jpg')">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-7">
            <h1 class="mb-2">Our Properties</h1>
            <p class="text-white">Post To Sell Your Property.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Display session message if it exists -->
  <?php
  $msg = $session::get('msg1');
  // echo $msg."<br>";
  if ($msg) {
    include_once 'pop-up.php';
    showPopup($msg);
    $session::delete('msg1');
  }
  ?>

  <!-- Only show form if the user is logged in -->
  <?php if ($sUser): ?>
    <div class="realestate-filter">
      <div class="container">
        <div class="realestate-filter-wrap nav">
          <a href="#for-sale" onclick="showForm('for-sale')">For Sale</a>
        </div>
      </div>
    </div>

    <div class="realestate-tabpane pb-5">
      <div class="container tab-content">
        <form method="post" enctype="multipart/form-data" action="" id="for-sale">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="user-type">Property title:</label>
              <input type="text" class="form-control1 w-100" name="property-title" placeholder="Title" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label for="user-type">Choose Property Area Category:</label>
              <select name="property_area_category" class="form-control1 w-100" required>
                <option value="residential_area">Residential Area</option>
                <option value="commercial_area">Commercial Area</option>
              </select>
            </div>
            <div class="col-md-4 form-group">
              <label for="divisionSelect">Choose Division:</label>
              <select name="division" id="divisionSelect" class="form-control1 w-100" required onchange="updateDistricts();">
                <?php
                // Loop through the divisions array and create options
                include_once 'php-class-file/Division.php';
                $divisions = getDivisions();
                foreach ($divisions as $division => $districts) {
                  echo '<option value="' . htmlspecialchars($division) . '">' . ucfirst($division) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-md-4 form-group">
              <label for="districtSelect">Choose District:</label>
              <select name="district" id="districtSelect" class="form-control1 w-100" required>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="user-type">Enter Address:</label>
              <input type="text" class="form-control1 w-100" name="address" placeholder="Address" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label for="user-type">Choose Bedrooms:</label>
              <input type="number" class="form-control1 w-100" name="bedroom_no" placeholder="Choose Bedrooms" required>
            </div>
            <div class="col-md-4 form-group">
              <label for="user-type">Choose Bathrooms:</label>
              <input type="number" class="form-control1 w-100" name="bathroom_no" placeholder="Choose Bathrooms" required>
            </div>
            <div class="col-md-4 form-group">
              <label for="user-type">Enter Price:</label>
              <input type="number" name="price" class="form-control1 w-100" placeholder="Please Enter the Price" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 form-group">
              <label for="user-type">Upload Image:</label>
              <input type="file" id="upload-image" name="upload-image[]" class="form-control1 w-100" multiple required>
            </div>
            <div class="col-md-4 form-group">
              <label for="user-type">Upload Video:</label>
              <input type="file" id="upload-video" name="upload-video" class="form-control1 w-100" required>
            </div>
            <div class="col-md-4 form-group">
              <label for="user-type">Enter Area (in Square/Feet):</label>
              <input type="number" step="any" class="form-control1 w-100" name="area" placeholder="Enter Area" required>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="property-description">Enter Property Description:</label>
              <textarea id="property-description" class="form-control2 w-100" name="property-description" placeholder="Enter Property Description" required></textarea>
            </div>
          </div>

          <div class="row">
            <div class="center-container" style="padding-top: 50px;">
              <input type="submit" class="btn btn-black py-3 btn-block" name="submit" value="Submit">
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

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
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script>
    function showForm(formId) {
      // Hide all forms (in this example, only "for-sale" exists)
      document.getElementById('for-sale').style.display = 'none';
      // Show the selected form
      document.getElementById(formId).style.display = 'block';
    }
  </script>

  <script>
    // Pass the PHP associative array to JavaScript
    var divisions = <?php echo json_encode($divisions); ?>;

    function updateDistricts() {
      var divisionSelect = document.getElementById('divisionSelect');
      var districtSelect = document.getElementById('districtSelect');
      var selectedDivision = divisionSelect.value;

      // Clear current options
      districtSelect.innerHTML = "";

      // Check if there are districts for the selected division
      if (divisions[selectedDivision]) {
        divisions[selectedDivision].forEach(function(district) {
          var option = document.createElement("option");
          option.value = district;
          option.text = district;
          districtSelect.appendChild(option);
        });
      } else {
        districtSelect.innerHTML = '<option value="">No district available</option>';
      }
    }

    // Update districts on page load for the default division
    window.onload = updateDistricts;
  </script>
</body>

</html>