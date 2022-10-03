<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap-5.0.2/dist/css/backend.css">
  <link rel="stylesheet" href="css/fontawesome-icons/css/all.css">
  <link rel="stylesheet" href="css/bootstrap-5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-5.0.2/dist/css/backend.css">
  <link rel="stylesheet" href="css/fontawesome-icons/css/fontawesome.min.css">
  <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="css/karla/static/Karla-Bold.ttf">
  <link rel="stylesheet" href="slideshow.css">
  <title>Welcome to bazaar shopping online</title>
</head>

<body>
  <!----------------------------header page title and search bar------------------->
  <div class="topnav">
    <a class="active"><strong>Bazaar shop</strong></a>
    <div class="search-container">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>
  </div>
  <!------------------------------end of header page title and search bar------------>

  <!------------------------------drop down menu profile with logout----------------->
  <div class="action">
    <div class="profile" onclick="menuToggle();">
      <img src="assets/icons/profile.png" />
    </div>
    <div class="menu">
      <ul>
        <li>
          <img src="assets/icons/edit.png" /><a href="reset-password.php">Edit profile</a>
        </li>
        <li>
          <img src="assets/icons/log-out.png" /><a href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
  <script>
    function menuToggle() {
      const toggleMenu = document.querySelector(".menu");
      toggleMenu.classList.toggle("active");
    }
  </script>
  <!---------------------------------end of drop down menu profile with logout------------->

  <div class="">
    <div class="">

    </div>
  </div>


  <!---------------------------------side bar menu categories------------------------------>
  <div class="side-form">
    <ul>
      <li><a href="#"><i class="fas fa-couch"></i>Furniture</a></li>
      <li><a href="#"><i class="fa fa-television"></i>Appliances</a></li>
      <li><a href="#"><i class="fas fa-stopwatch"></i>Accessories</a></li>
      <li><a href="#"><i class="fa fa-camera-retro"></i>Electronics</a></li>
      <li><a href="#"><i class="fas fa-guitar"></i>Instruments</a></li>
    </ul>
  </div>
  <div class="slideshow">
    <!-- Advertisement -->

  </div>
  <!-- <marquee>Bazaar ads</marquee> -->


</body>

</html>