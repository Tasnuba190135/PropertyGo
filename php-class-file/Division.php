<?php

/**
 * Get all divisions of Bangladesh with their districts
 */
function getDivisions()
{
    $divisions = array(
        "Barishal" => array(
            "Barguna",
            "Barishal",
            "Bhola",
            "Jhalakathi",
            "Patuakhali",
            "Pirojpur"
        ),
        "Chattogram" => array(
            "Bandarban",
            "Brahmanbaria",
            "Chandpur",
            "Chattogram",
            "Cumilla",
            "Cox’s Bazar",
            "Feni",
            "Khagrachhari",
            "Lakshmipur",
            "Noakhali",
            "Rangamati"
        ),
        "Dhaka" => array(
            "Dhaka",
            "Faridpur",
            "Gazipur",
            "Gopalganj",
            "Kishoreganj",
            "Madaripur",
            "Manikganj",
            "Munshiganj",
            "Narayanganj",
            "Narsingdi",
            "Rajbari",
            "Shariyatpur",
            "Tangail"
        ),
        "Khulna" => array(
            "Bagerhat",
            "Chuadanga",
            "Jashore",
            "Jhenaidah",
            "Khulna",
            "Kushtia",
            "Magura",
            "Meherpur",
            "Narail",
            "Satkhira"
        ),
        "Rajshahi" => array(
            "Bogura",
            "Chapai Nawabganj",
            "Joypurhat",
            "Naogaon",
            "Natore",
            "Pabna",
            "Rajshahi",
            "Sirajganj"
        ),
        "Rangpur" => array(
            "Dinajpur",
            "Gaibandha",
            "Kurigram",
            "Lalmonirhat",
            "Nilphamari",
            "Panchagarh",
            "Rangpur",
            "Thakurgaon"
        ),
        "Mymensingh" => array(
            "Jamalpur",
            "Mymensingh",
            "Netrokona",
            "Sherpur"
        ),
        "Sylhet" => array(
            "Habiganj",
            "Moulvibazar",
            "Sunamganj",
            "Sylhet"
        )
    );
    
    return $divisions;
}

?>
<!-- end -->