<?php
include('server.php');
session_start();

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: index.php");
}


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Alcohol Connoisseur</title>

    <!-- This is a 3rd-party stylesheet to make available the font families to be used for this page. -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab:100" rel="stylesheet">

    <!-- This is a 3rd-party stylesheet to include Font Awesome icons: http://fontawesome.io/ -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="screen">

    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <header>

      <div class="header-image-container">
        <img src="cocktail.png" alt="cocktail" width="200" height="200">
      </div>

      <h1 class="site-title"><a href="#">Alcohol Connoisseur</a></h1>

    </header>

    <div class="navbar">
      <a href="index.php">Home</a>
      <div class="dropdown">
        <button class="dropbtn">Account
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="log-in.php">Log in</a>
          <a href="sign-up.php">Sign Up</a>
          <?php if(isset($_SESSION['username'])) : ?>
            <a href="my-account.php">My Account</a>
          <?php endif ?>
        </div>
      </div>
      <a href="Create-drink.php">Create Drink</a>
      <?php if(isset($_SESSION['username'])) : ?>
        <a style="float:right" href="my-account.php">Welcome <?php echo $_SESSION['username']; ?></a>
        <a style="float:right" href="index.php?logout='1'">Logout</a>
      <?php endif ?>
      <a href="About.php">About</a>
    </div>

    <div class = "login">
      <h1>Create your account</h1>
        <form action = "sign-up.php" method = "post">
          <?php include('errors.php'); ?>
          <br>
          <input type="text" name="Username" placeholder="Username" required>
          <br>
          <input type="text" name="FirstName" placeholder="First Name (optional)">
          <br>
          <input type="text" name="LastName" placeholder="Last Name (optional)">
          <br>
          <input type="text" name="Email" placeholder="Email" required>
          <br>
          <input type="date" name="Birthday" placeholder="Birthday (optional)">
          <br>
          <input type="password" name="Password" placeholder="Password" required>
          <br><br>
        <input type = "submit" name ="register" value = "Sign up">
        <input type="button" value="Log In" onclick="login()">
    </div>



  </body>

  <script src="drink.js" charset="utf-8"></script>
</html>
