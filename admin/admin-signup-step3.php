<?php
include_once '../php-class-file/UserDetails.php';
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;
$session::delete('step');

include_once '../php-class-file/Division.php';  // Include Division class to load divisions dynamically
$divisions = getDivisions(); // Expected to return an associative array: division => [districts...]



if (isset($_POST['sign_up'])) {
  include_once '../php-class-file/User.php';
  include_once '../php-class-file/FileManager.php';
  include_once '../php-class-file/NoteManager.php';

  $user = new User();
  $temp_admin = $session::getObject('temp_admin');
  $session::copyProperties($temp_admin, $user);
  $user->user_type = "admin";
  $user->insert();

  $userDetails = new UserDetails();
  $userDetails->user_id = $user->user_id;

  $userDetails->full_name = $_POST['full-name'];
  $userDetails->contact_no = $_POST['contact_no'];
  $userDetails->division = $_POST['division'];
  $userDetails->district = $_POST['district'];
  $userDetails->address = $_POST['address'];
  $userDetails->gender = $_POST['gender'];
  $userDetails->nid_number = $_POST['nid_number'];

  $userDetails->insert();

  $file1 = new FileManager();
  $file1->file_owner_id = $user->user_id;
  $file1->file_id = $file1->insert();
  $ans = $file1->doOp($_FILES['upload-nid']);
  if ($ans == 1) {
    // echo 'NID File is uploaded <br>';
    $file1->update();
  } else {
    // echo 'NID File is not uploaded <br>';
  }

  $file2 = new FileManager();
  $file2->file_owner_id = $user->user_id;
  $file2->file_id = $file2->insert();
  $ans = $file2->doOp($_FILES['image-upload']);
  if ($ans == 1) {
    // echo 'Profile Photo' is uploaded <br>';
    $file2->update();
  } else {
    // echo 'Profile Photo' is not uploaded <br>';
  }

  // $file3 = new FileManager();
  // $file3->file_owner_id = $user->user_id;
  // $file3->file_id = $file3->insert();

  $userDetails->profile_picture_id = $file2->file_id;
  $userDetails->nid_file_id = $file1->file_id;
  // $userDetails->other_document_file_id = $file3->file_id;
  $userDetails->update();

  // echo 'All Completed'<br>
  $session::delete('temp_admin');
  $session::set('msg1', 'Please wait for Admin approval');
  // $session::set('msg1_ttl',1);
  echo "<script>window.location = 'login.php';</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Step-3</title>

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

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
  <link rel="stylesheet" href="../login.css">


  <!-- Include Font Awesome (or any icon library) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    select {
      background-color: black;
      color: white;
    }

    select option {
      background-color: black;
      color: white;
      /* Ensures text is visible */
    }
  </style>
</head>

<body>

  <section class="section1">
    <!-- HTML !-->

    <div class="container2">


      <!-- HTML !-->

      <div class="login-box">
        <!-- <div class="button-container-home">
                    <button class="button-home" onclick="location.href='index.html'">Homepage</button>
                </div> -->
        <!-- HTML !-->
        <!-- HTML !-->
        <!-- <button class="home" onclick="location.href='index.html'" role="button"><span class="text">GO TO HOMEPAGE</span></button>
<hr> -->
        <form method="post" action="" enctype="multipart/form-data">

          <h2 style="color: white;">Sign Up Here</h2>
          <hr>
          <h2>Step 3</h2>
          <p>Please provide all information to create an account.</p>
          <hr>
          <div class="image-upload-field">
            <label for="image-upload">Choose Profile Picture:</label>
            <input type="file" id="image-upload" name="image-upload" accept="image/*" required>
          </div>

          <div class="input-field">
            <label for="user-type">User Type:</label>
            <select id="user-type" name="user-type" required>
              <option value="client" id="option1">Admin</option>
              <!-- <option value="admin" id="option1">Moderator</option> -->
            </select>
          </div>
          <div class="input-field">
            <label for="fullname">Full Name:</label>
            <input type="text" name="full-name" id="fullname" placeholder="Enter your Full Name" required>
          </div>
          <!-- <div class="input-field">
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
          </div> -->
          <!-- <div class="input-field">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
          </div>
          <div class="input-field">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" name="confirm-password" id="confirmpassword" placeholder="Confirm your password"
              required>
          </div> -->
          <div class="input-field">
            <label for="contact">Contact No:</label>
            <input type="tel" name="contact_no" id="contact" placeholder="Enter your Contact No(+8801XXXXXXXXX):" pattern="^\+8801[3-9]\d{8}$" required>
          </div>

          <!-- Dynamic Division Selection -->
          <div class="input-field">
            <label for="division">Division:</label>
            <select name="division" id="division" required>
              <option value="">Select Division</option>
              <?php 
              foreach($divisions as $divName => $districts) {
                echo "<option value=\"$divName\">$divName</option>";
              }
              ?>
            </select>
          </div>

          <!-- Dynamic District Selection -->
          <div class="input-field">
            <label for="district">District:</label>
            <select name="district" id="district" required>
              <option value="">Select District</option>
            </select>
          </div>
          
          <div class="input-field">
            <label for="address">Address:</label>
            <input type="text" name="address" id="contact" placeholder="Enter your Address" required>
          </div>
          <div class="input-field gender-field">
            <label for="gender">Gender:</label>
            <div class="radio-group" required>
              <!-- <select name="gender" id="gender" class="radio-group" required> -->
              <input type="radio" id="male" name="gender" value="male" checked>
              <label for="male">Male</label>
              <input type="radio" id="female" name="gender" value="female">
              <label for="female">Female</label>
              <input type="radio" id="other" name="gender" value="other">
              <label for="other">Other</label>
            </div>
          </div>
          <div class="input-field">
            <label for="nid">NID Number:</label>
            <input type="text" name="nid_number" id="nid_number" placeholder="Enter your NID Number" required>
          </div>
          <div class="image-upload-field">
            <label for="image-upload">Choose NID File:(Scanned Copy)</label>
            <input type="file" id="image-upload" name="upload-nid" required>
          </div>
          
          <div class="button-container2">
            <button class="btn-signup" type="submit" name="sign_up" role="button">SIGN UP</button>
          </div>
          <hr>
        </form>
        <form method="post" action="login.php" enctype="multipart/form-data">


          <p class="signup-text">Already have an account? <a href="login.html">Login</a></p>
          <div class="button-container">
            <button class="button-56" onclick="location.href='login.html'" role="button">Log In</button>
          </div>


      </div>
    </div>
    </>
  </section>
  


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

  <!-- Dynamic District Population Script -->
  <script>
    const divisionsData = <?php echo json_encode($divisions); ?>;
    const divisionSelect = document.getElementById("division");
    const districtSelect = document.getElementById("district");

    divisionSelect.addEventListener("change", function() {
      const selectedDivision = this.value;
      districtSelect.innerHTML = '<option value="">Select District</option>';
      if (divisionsData[selectedDivision]) {
        divisionsData[selectedDivision].forEach(function(district) {
          let option = document.createElement("option");
          option.value = district;
          option.text = district;
          districtSelect.appendChild(option);
        });
      }
    });
  </script>

</body>

</html>