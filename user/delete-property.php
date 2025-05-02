<?php
include_once '../php-class-file/SessionManager.php';
$session = SessionStatic::class;
include_once '../php-class-file/Property.php';

$property = new Property();
$property_id = isset($_POST['propertyId']) ? $_POST['propertyId'] : null;

if ($property_id) {
    $property->property_id = $property_id;
    $property->setValue();
    $property->status = 2; // Assuming 2 is the status for archived
    $property->update();

    $session::set("msg1", "Property has been archived (Deleted). Property ID: $property_id");
    echo '<script type="text/javascript"> window.location.href = "property-history.php"; </script>';
    exit;
}


?>

<!-- end of file -->