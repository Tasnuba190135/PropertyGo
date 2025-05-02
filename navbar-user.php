<?php
include_once 'php-class-file/SessionManager.php';
$session = SessionStatic::class;

$loggedIn = false;
if ($session::get('user')) {
    $loggedIn = true;
}

// Dynamically determine the directory of this navbar file.
$navbarDir = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__FILE__)) . '/';

// if the logout button pressed
if (isset($_GET['logout']) == 1) {
    // Include the SessionManager class from the correct directory
    include_once $_SERVER['DOCUMENT_ROOT'] . '/php-class-file/SessionManager.php';

    // Create an instance of SessionManager and destroy the session.
    $session = SessionStatic::class;
    $session::destroy();

    unset($_GET['logout']);

    // Redirect to the homepage using JavaScript.
    echo '<script type="text/javascript">
            window.location.href = "index.php?logoutMsg=2";
          </script>';
    exit;
}


?>

<header>
    <!-- nav start -->
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
                aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </a>

            <a class="navbar-brand text-brand" href="index.html">PROPERTY<span class="color-b"> GO</span></a>

            <div class="navbar-collapse collapse justify-content-lg-end" id="navbarDefault">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $navbarDir ?>index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $navbarDir ?>add-property.php">Post Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $navbarDir ?>property-list.php">Explore Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $navbarDir ?>about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $navbarDir ?>contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- LOG IN button inside the navbar collapse -->
            <div class="navbar-collapse collapse justify-content-xl-end" id="navbarDefault">
                <?php if ($loggedIn == false) { ?>
                    <button class="button-85 ml-auto" onclick="location.href='login.php'" role="button">LOG IN</button>
                <?php } else { ?>
                    <div class="ml-auto w-20">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto m-0 p-0">
                                <li class="nav-item dropdown">
                                    <a href="" class="button-24 ml-auto dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <!-- <a class="dropdown-item" href="Admin Dashboard/Dashbaord.html">View Profile</a> -->
                                        <a class="dropdown-item" href="user/dashboard.php">View Dashboard</a>
                                        <a class="dropdown-item" href="?logout=1"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </nav>

                        <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right">
                            <span class="icon-menu h3"></span>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>


    </nav>
    <!--/ Nav End /-->
</header>