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
      <h1>Have an account?</h1>
        <form action = "log-in.php" method = "post">
          <?php
            include('errors.php');
          ?>
          <?php if(isset($_SESSION['verify'])) : ?>
            <div class="error">
                <p>Need to log in before uploading a drink</p>
            </div>
          <?php endif ?>
          <?php if(isset($_SESSION['newpass'])) : ?>
            <div class="error">
                <p>Password changed login again</p>
            </div>
          <?php endif ?>
          <?php unset($_SESSION['verify']); unset($_SESSION['newpass']);?>
          <br>
          <input type="text" name="Username" placeholder="Username" required>
          <br><br>
          <input type="password" name="Password" placeholder="Password" required>
          <br><br>
      	<input type = "submit" name ="login" value = "Log in">
        <input type="button" value="Sign Up" onclick="signup()">
    </div>



  </body>

  <script src="drink.js" charset="utf-8"></script>
</html>
