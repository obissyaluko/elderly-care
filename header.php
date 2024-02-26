<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elderly Care</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/mobile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</head>

<body <?= (isset($_SESSION['userid']) && basename($_SERVER['PHP_SELF']) == 'chat.php') ? 'onload="loadDoc();"' : ''; ?>>

    <!-- Top-Header-Section -->

    <!--Header-Section -->
    <div class="home-header-section">
        <header class="header">
            <div class="main-header">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a class="navbar-brand mr-0" href="index.php"><img src="./assets/images/logo.png" alt=""
                                class="img-fluid"></a>
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
                            <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
                            <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown sancare-li-color active">
                                    <a href='index.php' class="nav-link active text-white">Home</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-decoration-none navbar-text-color index2-navlink "
                                        href="about.php">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-decoration-none navbar-text-color index2-navlink "
                                        href="contact.php">Contact</a>
                                </li>
                                <?php
                                if(isset($_SESSION['userid']) && $_SESSION['Role'] == "Elderly Person"){
                                ?>
                                <li class="nav-item dropdown sancare-li-color">
                                    <a class="nav-link dropdown-toggle  index3-pages" href="#" id="navbarDropdown2"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">My Account</a>
                                    <div class="dropdown-menu sancare-drop-down">
                                        <ul class="list-unstyled">
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="profile.php">Profile</a></li>
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="notifications.php">Notifications</a></li>
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="schedule-meetings.php">Schedule Meetings</a></li>
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="my-carers.php">Carers Relationship</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                                <?php
                                if(isset($_SESSION['userid']) && $_SESSION['Role'] == "Carer"){
                                ?>
                                <li class="nav-item dropdown sancare-li-color">
                                    <a class="nav-link dropdown-toggle  index3-pages" href="#" id="navbarDropdown2"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">My Account</a>
                                    <div class="dropdown-menu sancare-drop-down">
                                        <ul class="list-unstyled">
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="profile.php">Profile</a></li>
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="c-notifications.php">Notifications</a></li>
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="carer-schedule-meetings.php">Schedule Meetings</a></li>
                                            <li class="nav-item"> <a class="dropdown-item nav-link"
                                                    href="my-elder-persons.php">Elder Relationship</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                                <?php
                                if(isset($_SESSION['userid'])){
                                ?>
                                <li class="nav-item list-unstyled  btn-talk nav-btn2"><a class="nav-link contact"
                                        href="logout.php">LOGOUT</a></li>
                                        <?php
                                }
                                else{
                                ?>
                                <li class="nav-item list-unstyled  btn-talk nav-btn2"><a class="nav-link contact"
                                        href="login.php">GET STARTED</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>