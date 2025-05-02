<?php
include_once '../php-class-file/Auth.php';
auth('user');
// Include necessary PHP class files from the root/php-class-file/ directory
include_once '../php-class-file/SessionManager.php';
include_once '../php-class-file/User.php';
include_once '../php-class-file/Property.php';
include_once '../pop-up.php';

// Start session and get session user object
$session = SessionStatic::class;
$sUser = $session::getObject("user");

if ($session::get("msg1")) {
  showPopup($session::get("msg1"));
  $session::delete("msg1");
}

// If the user is not logged in, display a message and exit.
if (!$sUser) {
  echo "<p>You must be logged in to view your property history.</p>";
  exit;
}

// Create a new User object from the session object and set its user_id
$user = new User();
$user->user_id = $sUser->user_id;
$user->setValue();
// Instantiate Property class and retrieve all properties for this user.
// We assume a function in Property class like getRowsByUserIdAndStatus($userId, $status=null)
$property = new Property();
$activeProperties = $property->getByUserIdAndStatus($user->user_id, 1);
$pendingProperties = $property->getByUserIdAndStatus($user->user_id, 0);
$deletedProperties = $property->getByUserIdAndStatus($user->user_id, 2);
$pendingUpdateProperties = $property->getByUserIdAndStatus($user->user_id, 4);
$deletedPendingUpdateProperties = $property->getByUserIdAndStatus($user->user_id, 2);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard(User) - Property History</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/dashboard-user.css">
</head>

<body>
  <?php include_once 'sidebar-user.php'; ?>

  <div id="main-content" class="main-content">
    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
      <h5>Property History</h5>
      <!-- Toggle Button -->
      <button class="toggle-btn d-md-none" id="toggle-btn">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <!-- Live Posts -->
    <div class="container mt-5">
      <!-- For Sale Section -->
      <section class="mb-5">
        <div class="container mt-4">
          <div class="card__wrapper">
            <div class="card__title-wrap mb-">
              <h2 class="mb-4 text-center">Live Post(s)</h2>
            </div>
          </div>
          <div class="row">
            <?php
            if (!empty($activeProperties)) {
              foreach ($activeProperties as $prop) {
                // Load property details for the current property_id
                $singleProperty = new Property();
                $singleProperty->setProperties($prop);
                // Determine status text: 0 = Pending, 1 = Live on Site.
                $statusText = ($prop['status'] == 0) ? "Pending" : (($prop['status'] == 1) ? "Live on Site" : "Unknown");
            ?>
                <div class="col-md-4 mb-4">
                  <div class="card h-100 shadow rounded-3 d-flex flex-column">
                    <div class="card-body d-flex flex-column justify-content-between">

                      <!-- Content -->
                      <div class="mb-3">
                        <h5 class="card-title" style="text-align: justify;">
                          <strong>Property Title :</strong>
                          <?= $singleProperty->property_title ?>
                        </h5>
                        <p class="mb-1"><strong>Property ID:</strong> <?= $singleProperty->property_id ?></p>
                        <p class="mb-1"><strong>Status:</strong> <?= $statusText ?></p>
                        <?php
  $catCode = $singleProperty->property_category; // e.g. 'residential' or 'commercial'
  if ($catCode === 'residential_area') {
    $displayCat = 'Residential Area';
    $iconClass  = 'fa-home';
  } else {
    $displayCat = 'Commercial Area';
    $iconClass  = 'fa-building';
  }
  // use a grey background
  $badgeClass = 'bg-secondary text-white';
?>
<p class="mb-1">
  <strong>Category:</strong>
  <span class="badge <?= $badgeClass ?> rounded-pill py-1 px-3">
    <i class="fas <?= $iconClass ?> me-1"></i><?= htmlspecialchars($displayCat) ?>
  </span>
</p>


                      </div>

                      <!-- Actions -->
                      <div class="mt-auto">
                        <div class="d-flex justify-content-between mb-2">
                          <a href="../property-single.php?propertyId=<?= $singleProperty->property_id ?>"
                            class="btn btn-success btn-sm w-50 me-1">
                            View
                          </a>
                          <a href="edit-property.php?propertyId=<?= $singleProperty->property_id ?>"
                            class="btn btn-danger btn-sm w-50 ms-1">
                            Edit
                          </a>
                        </div>
                        <form action="delete-property.php" method="POST">
                          <input type="hidden" name="propertyId" value="<?= $singleProperty->property_id ?>">
                          <button class="btn btn-primary btn-sm w-100" type="submit" name="deletePost">
                            Delete
                          </button>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>

            <?php
              }
            } else {
              echo "<p>No properties found.</p>";
            }
            ?>
          </div>
        </div>
      </section>
    </div>

    <!-- Pending Posts -->
    <div class="container mt-5">
      <!-- For Sale Section -->
      <section class="mb-5">
        <div class="container mt-4">
          <div class="card__wrapper">
            <div class="card__title-wrap mb-">
              <h2 class="mb-4 text-center">Pending Post(s)</h2>
            </div>
          </div>
          <div class="row">
            <?php
            if (!empty($pendingProperties)) {
              foreach ($pendingProperties as $prop) {
                // Load property details for the current property_id
                $singleProperty = new Property();
                $singleProperty->setProperties($prop);
                // Determine status text: 0 = Pending, 1 = Live on Site.
                $statusText = ($prop['status'] == 0) ? "Pending" : (($prop['status'] == 1) ? "Live on Site" : "Unknown");
            ?>
                <div class="col-md-4 mb-4">
                  <div class="card h-100 shadow rounded-3 d-flex flex-column">
                    <div class="card-body d-flex flex-column justify-content-between">

                      <!-- Content -->
                      <div class="mb-3">
                        <h5 class="card-title" style="text-align: justify;">
                          <strong>Property Title :</strong>
                          <?= $singleProperty->property_title ?>
                        </h5>
                        <p class="mb-1"><strong>Property ID:</strong> <?= $singleProperty->property_id ?></p>
                        <p class="mb-1"><strong>Status:</strong> <?= $statusText ?></p>
                        <?php
  $catCode = $singleProperty->property_category; // e.g. 'residential' or 'commercial'
  if ($catCode === 'residential_area') {
    $displayCat = 'Residential Area';
    $iconClass  = 'fa-home';
  } else {
    $displayCat = 'Commercial Area';
    $iconClass  = 'fa-building';
  }
  // use a grey background
  $badgeClass = 'bg-secondary text-white';
?>
<p class="mb-1">
  <strong>Category:</strong>
  <span class="badge <?= $badgeClass ?> rounded-pill py-1 px-3">
    <i class="fas <?= $iconClass ?> me-1"></i><?= htmlspecialchars($displayCat) ?>
  </span>
</p>


                      </div>

                      <!-- Actions -->
                      <div class="mt-auto">
                        <a href="../property-single.php?propertyId=<?= $singleProperty->property_id ?>"
                          class="btn btn-success btn-sm w-100 mb-2">
                          View Details
                        </a>
                        <form action="delete-property.php" method="POST">
                          <input type="hidden" name="propertyId" value="<?= $singleProperty->property_id ?>">
                          <button class="btn btn-primary btn-sm w-100" type="submit" name="deletePost">
                            Delete
                          </button>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>

            <?php
              }
            } else {
              echo "<p>No properties found.</p>";
            }
            ?>
          </div>
        </div>
      </section>
    </div>
    <!-- end of pending posts -->

    <!-- pending update of Posts -->
    <div class="container mt-5">
      <!-- For Sale Section -->
      <section class="mb-5">
        <div class="container mt-4">
          <div class="card__wrapper">
            <div class="card__title-wrap mb-">
              <h2 class="mb-4 text-center">Pending To Update Post(s)</h2>
            </div>
          </div>
          <div class="row">
            <?php
            if (!empty($pendingUpdateProperties)) {
              foreach ($pendingUpdateProperties as $prop) {
                // Load property details for the current property_id
                $singleProperty = new Property();
                $singleProperty->setProperties($prop);
                // Determine status text: 0 = Pending, 1 = Live on Site.
                $statusText = "Pending Update";
            ?>
                <div class="col-md-4 mb-4">
                  <div class="card h-100 shadow rounded-3 d-flex flex-column justify-content-between">
                    <div class="card-body d-flex flex-column justify-content-between">
                      <!-- Content Section -->
                      <div class="mb-3">
                        <h5 class="card-title" style="text-align: justify;">
                          <strong>Property Title :</strong> <?php echo $singleProperty->property_title; ?>
                        </h5>
                        <p class="mb-1"><strong>Property ID:</strong> <?php echo $singleProperty->property_id; ?></p>
                        <p class="mb-1"><strong>Status:</strong> <?php echo $statusText; ?></p>
                        <?php
  $catCode = $singleProperty->property_category; // e.g. 'residential' or 'commercial'
  if ($catCode === 'residential_area') {
    $displayCat = 'Residential Area';
    $iconClass  = 'fa-home';
  } else {
    $displayCat = 'Commercial Area';
    $iconClass  = 'fa-building';
  }
  // use a grey background
  $badgeClass = 'bg-secondary text-white';
?>
<p class="mb-1">
  <strong>Category:</strong>
  <span class="badge <?= $badgeClass ?> rounded-pill py-1 px-3">
    <i class="fas <?= $iconClass ?> me-1"></i><?= htmlspecialchars($displayCat) ?>
  </span>
</p>

                      </div>

                      <!-- Buttons Section -->
                      <div class="mt-auto">
                        <div class="d-flex justify-content-between mb-2">
                          <a href="../property-single.php?propertyId=<?php echo $singleProperty->property_id; ?>" class="btn btn-success btn-sm w-50 me-1">Pending Edit</a>
                          <a href="../property-single.php?propertyId=<?php echo $singleProperty->parent_property_id; ?>" class="btn btn-primary btn-sm w-50 ms-1">Current Post</a>
                        </div>
                        <form action="delete-property.php" method="POST">
                          <input type="hidden" name="propertyId" value="<?php echo $singleProperty->property_id; ?>">
                          <button class="btn btn-danger btn-sm w-100" type="submit" name="deletePost">Delete Post</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

            <?php
              }
            } else {
              echo "<p>No properties found.</p>";
            }
            ?>
          </div>
        </div>
      </section>
    </div>
    <!-- end of pending update of posts -->

    <!-- Deleted or archived Posts -->
    <div class="container mt-5">
      <!-- For Sale Section -->
      <section class="mb-5">
        <div class="container mt-4">
          <div class="card__wrapper">
            <div class="card__title-wrap mb-">
              <h2 class="mb-4 text-center">Deleted Post(s)</h2>
            </div>
          </div>
          <div class="row">
            <?php
            if (!empty($deletedProperties)) {
              foreach ($deletedProperties as $prop) {
                // Load property details for the current property_id
                $singleProperty = new Property();
                $singleProperty->setProperties($prop);
                // Determine status text: 0 = Pending, 1 = Live on Site.
                $statusText = "Deleted";
            ?>
                <div class="col-md-4 mb-4">
                  <div class="card h-100 shadow rounded-3 d-flex flex-column">
                    <div class="card-body d-flex flex-column justify-content-between">

                      <!-- Content -->
                      <div class="mb-3">
                        <h5 class="card-title" style="text-align: justify;">
                          <strong>Property Title :</strong>
                          <?= $singleProperty->property_title ?>
                        </h5>
                        <p class="mb-1"><strong>Property ID:</strong> <?= $singleProperty->property_id ?></p>
                        <p class="mb-1"><strong>Status:</strong> <?= $statusText ?></p>
                        <?php
                        $catCode = $singleProperty->property_category; // e.g. 'residential' or 'commercial'
                        if ($catCode === 'residential_area') {
                          $displayCat = 'Residential Area';
                          $iconClass  = 'fa-home';
                        } else {
                          $displayCat = 'Commercial Area';
                          $iconClass  = 'fa-building';
                        }
                        // use a grey background
                        $badgeClass = 'bg-secondary text-white';
                        ?>
                        <p class="mb-1">
                          <strong>Category:</strong>
                          <span class="badge <?= $badgeClass ?> rounded-pill py-1 px-3">
                            <i class="fas <?= $iconClass ?> me-1"></i><?= htmlspecialchars($displayCat) ?>
                          </span>
                        </p>

                      </div>

                      <!-- Action -->
                      <div class="mt-auto">
                        <a href="../property-single.php?propertyId=<?= $singleProperty->property_id ?>"
                          class="btn btn-success btn-sm w-100">
                          View
                        </a>
                      </div>

                    </div>
                  </div>
                </div>

            <?php
              }
            } else {
              echo "<p>No properties found.</p>";
            }
            ?>
          </div>
          <!-- end of deleted or archived posts -->

        </div>
      </section>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
      const toggleBtn = document.getElementById("toggle-btn");
      const sidebar = document.getElementById("sidebar");
      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
      });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>