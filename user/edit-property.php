<?php
include_once '../php-class-file/Auth.php';
auth('user');

include_once '../php-class-file/SessionManager.php';
include_once '../php-class-file/User.php';
include_once '../php-class-file/Property.php';
include_once '../php-class-file/FileManager.php';
include_once '../php-class-file/Division.php'; // Include file to fetch divisions and districts

$divisions = getDivisions(); // $divisions is an associative array: division => array(district1, district2, ...)

$session = SessionStatic::class;
$sUser   = $session::getObject("user");
$user   = new User();
$user->user_id = $sUser->user_id;

$property = new Property();
$originalImageIds = [];
$originalVideoIds = [];

// Grab propertyId from GET or default to 0
$propertyId = isset($_GET['propertyId']) ? intval($_GET['propertyId']) : 0;
if ($propertyId) {
  // Instantiate Property and load data
  $property->getByPropertyIdAndStatus($propertyId);

  // Original file IDs (as loaded from the database)
  $originalImageIds = array_filter(array_map('trim', explode(',', $property->property_image_file_ids)));
  $originalVideoIds = array_filter(array_map('trim', explode(',', $property->property_video_file_ids)));
}

if (isset($_POST['propertyUpdate'])) {
  $property->status = 4; // Set status to 4 (pending) for the update
  // Update property details from form
  $property->property_id        = $_POST['propertyUpdate'];
  $property->parent_property_id = $_POST['propertyUpdate'];
  $property->user_id           = $user->user_id;
  $property->property_title     = $_POST['property-title'];
  $property->property_category  = $_POST['property_area_category'];
  $property->division           = $_POST['division'];
  $property->district           = $_POST['district'];  // Added district update
  $property->address            = $_POST['address'];
  $property->bedroom_no         = $_POST['bedroom'];
  $property->bathroom_no        = $_POST['bathroom'];
  $property->price              = $_POST['price'];
  $property->area               = $_POST['area'];
  $property->description        = $_POST['property-description'];

  // Process existing file IDs (images & videos)
  $remainingImageIds = isset($_POST['existingImageIds'])
    ? array_filter(array_map('trim', explode(',', $_POST['existingImageIds'])))
    : [];
  $remainingVideoIds = isset($_POST['existingVideoIds'])
    ? array_filter(array_map('trim', explode(',', $_POST['existingVideoIds'])))
    : [];

  // echo $_POST['existingVideoIds'] . "<br>";
  // exit;

  // Process new image uploads
  $newImageIds = [];
  for ($i = 0; $i < count($_FILES['property-images-upload']['name']); $i++) {
    $fileArray = [
      'name'     => $_FILES['property-images-upload']['name'][$i],
      'type'     => $_FILES['property-images-upload']['type'][$i],
      'tmp_name' => $_FILES['property-images-upload']['tmp_name'][$i],
      'error'    => $_FILES['property-images-upload']['error'][$i],
      'size'     => $_FILES['property-images-upload']['size'][$i],
    ];
    $fileManager = new FileManager();
    $fileManager->insert();
    $newId = $fileManager->doOp($fileArray);
    $fileManager->update();
    if ($newId) {
      $newImageIds[] = $fileManager->file_id;
    }
  }
  // Merge the image IDs
  $finalImageIds = array_merge($remainingImageIds, $newImageIds);
  $property->property_image_file_ids = !empty($finalImageIds) ? implode(',', $finalImageIds) : '';

  // Process new video uploads
  $newVideoIds = [];
  for ($i = 0; $i < count($_FILES['property-videos-upload']['name']); $i++) {
    $fileArray = [
      'name'     => $_FILES['property-videos-upload']['name'][$i],
      'type'     => $_FILES['property-videos-upload']['type'][$i],
      'tmp_name' => $_FILES['property-videos-upload']['tmp_name'][$i],
      'error'    => $_FILES['property-videos-upload']['error'][$i],
      'size'     => $_FILES['property-videos-upload']['size'][$i],
    ];
    $fileManager = new FileManager();
    $fileManager->insert();
    $newId = $fileManager->doOp($fileArray);
    $fileManager->update();
    if ($newId) {
      $newVideoIds[] = $fileManager->file_id;
    }
  }

  // $finalVideoIds = array_merge($remainingVideoIds, $newVideoIds);
  $finalVideoIds = $newVideoIds ?? $_POST['existingVideoIds'];
  $property->property_video_file_ids = !empty($finalVideoIds) ? implode(',', $finalVideoIds) : $_POST['existingVideoIds'];
  // echo $property->property_video_file_ids . "<br>";
  // exit;
  // Update property record by insert new row for approval
  if ($property->insert()) {
    $property->updateStatus($propertyId, 3); // Set status to 3 (pending) for the new property record
    include_once '../pop-up.php';
    $session::set("msg1", "Property details updated successfully. Please wait for admin approval. Property ID: {$property->property_id}");
  } else {
    include_once '../pop-up.php';
    $session::set("msg1", "Failed to update property details. Please try again.");
  }
  // Refresh original arrays if needed
  $originalImageIds = $finalImageIds;
  $originalVideoIds = $finalVideoIds;

  echo "<script>window.location.href = 'property-history.php';</script>"; // Redirect to property history page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard(User) - Edit Property</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/dashboard-user.css">
  <!-- jQuery (needed for animate effect) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- CSS for Media Edit and gallery layout -->
  <style>
    .file-container {
      display: inline-block;
      margin-bottom: 15px;
      text-align: center;
      transition: opacity 0.3s ease;
      overflow: hidden;
      position: relative;
    }

    .file-container img,
    .file-container video {
      display: block;
      width: 100%;
      height: auto;
    }

    /* Delete overlay styles */
    .delete-overlay {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: rgba(255, 0, 0, 0.8);
      color: white;
      padding: 2px 5px;
      font-size: 12px;
      border-radius: 3px;
      cursor: pointer;
    }

    /* Gallery layout */
    .image-gallery,
    .video-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .image-card,
    .video-card {
      position: relative;
      width: 200px;
      /* adjust width as needed */
      border: 1px solid #ddd;
      border-radius: 5px;
      overflow: hidden;
    }

    .image-card img,
    .video-card video {
      width: 100%;
      display: block;
    }

    /* Mark a container as deleted (lower opacity) */
    .deleted {
      opacity: 0.3;
      pointer-events: none;
    }
  </style>

  <!-- Dynamic District Dropdown Script -->
  <script>
    // Load divisions and their districts from PHP
    var divisionsData = <?php echo json_encode($divisions); ?>;

    function updateDistricts() {
      var divisionSelect = document.getElementById('division');
      var districtSelect = document.getElementById('district');
      var selectedDivision = divisionSelect.value;
      districtSelect.innerHTML = "<option value=''>Select District</option>";
      if (divisionsData[selectedDivision]) {
        divisionsData[selectedDivision].forEach(function(district) {
          var option = document.createElement("option");
          option.value = district;
          option.text = district;
          districtSelect.appendChild(option);
        });
      }
      // If the property already has a district, set it as selected.
      <?php if (!empty($property->district)) { ?>
        districtSelect.value = "<?php echo $property->district; ?>";
      <?php } ?>
    }
    document.addEventListener("DOMContentLoaded", function() {
      updateDistricts();
      document.getElementById('division').addEventListener('change', updateDistricts);
    });
  </script>
</head>

<body>
  <!-- Sidebar -->
  <?php include_once 'sidebar-user.php'; ?>

  <!-- Main Content -->
  <div id="main-content" class="main-content">
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
      <h5>Edit Property</h5>
    </div>

    <div class="container mt-4">
      <?php if (!empty($message)) { ?>
        <div class="alert alert-info">
          <?php echo $message; ?>
        </div>
      <?php } ?>

      <div class="card__wrapper">
        <div class="card__title-wrap mb-20">
          <h3 class="table__heading-title mb-4">Property Details</h3>
          <h4 class="table__heading-title mb-3">Property ID: <?php echo $property->property_id; ?></h4>
        </div>
        <hr>

        <!-- Form: Edit Property Details -->
        <form action="" method="post" class="profile-page-form mb-4" enctype="multipart/form-data">
          <!-- Hidden fields for existing file IDs -->
          <input type="hidden" name="existingImageIds" id="existingImageIds" value="<?php echo implode(',', $originalImageIds); ?>">
          <input type="hidden" name="existingVideoIds" id="existingVideoIds" value="<?php echo implode(',', $originalVideoIds); ?>">

          <!-- Property Title -->
          <div class="row align-items-center mb-4">
            <div class="col-md-6">
              <label class="form-label">Property Title:</label>
              <input type="text" class="form-control" name="property-title" value="<?php echo $property->property_title; ?>" required>
            </div>
          </div>

          <!-- Category, Division, District, Address -->
          <div class="row mb-4">
            <div class="col-md-3">
              <label for="property_area_category" class="form-label">Property Area Category:</label>
              <select class="form-control" id="property_area_category" name="property_area_category" required>
                <!-- <option value="all_type" <?php if ($property->property_category === 'All Type') echo 'selected'; ?>>All Type</option> -->
                <option value="residential_area" <?php if ($property->property_category === 'Residential Area') echo 'selected'; ?>>Residential Area</option>
                <option value="commercial_area" <?php if ($property->property_category === 'Commercial Area') echo 'selected'; ?>>Commercial Area</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="division" class="form-label">Division:</label>
              <select class="form-control" id="division" name="division" required>
                <option value="">Select Division</option>
                <?php
                foreach ($divisions as $divisionName => $districtArray) {
                  $selected = ($property->division === $divisionName) ? 'selected' : '';
                  echo '<option value="' . htmlspecialchars($divisionName) . '" ' . $selected . '>' . ucfirst($divisionName) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-md-3">
              <label for="district" class="form-label">District:</label>
              <select class="form-control" id="district" name="district" required>
                <option value="">Select District</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="address" class="form-label">Address:</label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $property->address; ?>" required>
            </div>
          </div>

          <!-- Bedrooms, Bathrooms, Price -->
          <div class="row mb-4">
            <div class="col-md-4">
              <label for="bedroom" class="form-label">Bedrooms:</label>
              <input type="number" class="form-control" id="bedroom" name="bedroom" value="<?php echo $property->bedroom_no; ?>" required>
            </div>
            <div class="col-md-4">
              <label for="bathroom" class="form-label">Bathrooms:</label>
              <input type="number" class="form-control" id="bathroom" name="bathroom" value="<?php echo $property->bathroom_no; ?>" required>
            </div>
            <div class="col-md-4">
              <label for="price" class="form-label">Price:</label>
              <input type="number" class="form-control" id="price" name="price" value="<?php echo $property->price; ?>" required>
            </div>
          </div>

          <!-- Area and Description -->
          <div class="row mb-4">
            <div class="col-md-4">
              <label for="area" class="form-label">Area (in Square Feet):</label>
              <input type="number" class="form-control" id="area" name="area" value="<?php echo $property->area; ?>" required>
            </div>
            <div class="col-md-8">
              <label for="property-description" class="form-label">Property Description:</label>
              <textarea class="form-control" id="property-description" name="property-description" rows="4" required><?php echo $property->description; ?></textarea>
            </div>
          </div>

          <!-- Property Images Section -->
          <div class="row mb-4">
            <div class="col-md-12">
              <label for="property-images" class="form-label">Property Images:</label>
              <div id="imagesContainer" class="image-gallery">
                <?php foreach ($originalImageIds as $fileId) {
                  $file = new FileManager();
                  $file->setValueById($fileId);
                ?>
                  <div class="image-card file-container" data-file-id="<?php echo $file->file_id; ?>" data-type="image">
                    <img src="../file/<?php echo $file->file_new_name; ?>" alt="Property Image">
                    <div class="delete-overlay">Delete</div>
                  </div>
                <?php } ?>
              </div>
              <label for="property-images-upload" class="form-label mt-3">Upload New Images:</label>
              <input type="file" class="form-control" id="property-images-upload" name="property-images-upload[]" multiple>
            </div>
          </div>

          <!-- Property Videos Section -->
          <div class="row mb-4">
            <div class="col-md-12">
              <label for="property-videos" class="form-label">Property Videos:</label>
              <div id="videosContainer" class="video-gallery">
                <?php foreach ($originalVideoIds as $fileId) {
                  $file = new FileManager();
                  $file->setValueById($fileId);
                ?>
                  <div class="video-card file-container" data-file-id="<?php echo $file->file_id; ?>" data-type="video">
                    <video controls>
                      <source src="../file/<?php echo $file->file_new_name; ?>" type="video/mp4">
                    </video>
                    <div class="delete-overlay">Delete</div>
                  </div>
                <?php } ?>
              </div>
              <label for="property-videos-upload" class="form-label mt-3">Upload New Videos:</label>
              <input type="file" class="form-control" id="property-videos-upload" name="property-videos-upload[]" accept="video/*" multiple>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="card-footer text-end">
            <button type="submit" name="propertyUpdate" value="<?php echo $property->property_id; ?>" class="btn btn-primary ms-2">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript: Update hidden fields on deletion and mark as removed -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // When a delete button is clicked, animate the container's opacity to a lower value to indicate removal.
      document.querySelectorAll('.delete-overlay').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var container = this.closest('.file-container');
          var fileId = container.getAttribute('data-file-id');
          var type = container.getAttribute('data-type'); // image or video
          // Animate to lower opacity (e.g., 0.3) to indicate removal
          $(container).animate({
            opacity: 0.3
          }, 500, function() {
            // After animation, add a "deleted" class to disable further clicks
            $(container).addClass('deleted');
            // Update the hidden input field to mark this file as removed
            if (type === 'image') {
              updateHiddenField('existingImageIds', fileId);
            } else {
              updateHiddenField('existingVideoIds', fileId);
            }
          });
        });
      });

      function updateHiddenField(fieldId, fileIdToRemove) {
        var hiddenField = document.getElementById(fieldId);
        var ids = hiddenField.value ? hiddenField.value.split(',') : [];
        var newIds = ids.filter(function(id) {
          return id !== fileIdToRemove;
        });
        hiddenField.value = newIds.join(',');
      }
    });
  </script>
</body>

</html>