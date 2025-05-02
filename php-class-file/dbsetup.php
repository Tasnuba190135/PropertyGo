<?php
include_once 'DbConnector.php';
include_once 'User.php';
include_once 'UserDetails.php';
include_once 'Property.php';
include_once 'FileManager.php';
include_once 'NoteManager.php';
include_once 'PostLimit.php';
include_once 'Admin.php';


// session 1
// $db = new DbConnector();
// $db->createDatabase();
// echo "Database created successfully";
// echo "<br><br><br>";

// $user = new User();
// $user->createTableMinimal();
// $user->alterTableAddColumns();
// echo "Table created successfully";
// echo "<br><br><br>";

// $userDetails = new UserDetails();
// $userDetails->createTableMinimal();
// $userDetails->alterTableAddColumns();
// echo "Table created successfully";
// echo "<br><br><br>";

// $property = new Property();
// $property->createTableMinimal();
// $property->alterTableAddColumns();
// echo "Table created successfully";
// echo "<br><br><br>";

// $fileManager = new FileManager();
// $fileManager->createTableMinimal();
// $fileManager->alterTableAddColumns();
// echo "Table created successfully";
// echo "<br><br><br>";

// $noteManager = new NoteManager();
// $noteManager->createTableMinimal();
// $noteManager->alterTableAddColumns();
// echo "Table created successfully";
// echo "<br><br><br>";

// $postLimit = new PostLimit();
// $postLimit->createTableMinimal();
// $postLimit->alterTableAddColumns();
// echo "Table created successfully";
// echo "<br><br><br>";

// $admin = new Admin();
// $admin->createSuperAdmin();
// echo "Super Admin record inserted successfully";
// echo "<br><br><br>";

// // session 2

// $property = new Property();
// $property->alterTableAddColumns([21]);

// function get_time($timezone = 'Asia/Dhaka') {
//     $date = new DateTime('now', new DateTimeZone($timezone));
//     return $date->format('Y-m-d H:i:s');
// }

// echo date_default_timezone_get();
// echo "<br>";
// echo get_time('Asia/Dhaka');
// echo "<br>";
// echo date('Y-m-d H:i:s');

// add default admin
// $admin = new Admin();
// $admin->insertAdmin();
// echo "Admin record inserted successfully";
// $admin->email="super@admin";
// $admin->user_type="super-admin";
// $admin->insertAdmin();
// echo "<br><br><br>";



?>

<!-- end -->