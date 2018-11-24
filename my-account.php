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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

<div class = "account">
    <h1><?php echo $_SESSION['username']; ?>'s Account</h1>
    <div class = "drinks" style="display:none">
      <h2>Drinks Created</h2>
    </div>
    <div class = "Comments" style="display:none">
      <h2>Comments Created</h2>
    </div>
    <div class = "Likes" style="display:none">
      <h2>Drinks Liked</h2>
    </div>
    <div class = "info">
      <h2>Account Information</h2>
    </div>
    <!-- <div class = "Update"> -->
      <h2>Update Account Information</h2>
      <?php
        include('errors.php');
      ?>
        <form action = "my-account.php" method = "post">
          <br>
          <input type="text" name="FirstName" placeholder="First Name">
          <br>
          <input type="text" name="LastName" placeholder="Last Name">
          <br>
          <input type="email" name="Email" placeholder="Email">
          <br>
          <input type="date" name="Birthday" placeholder="Birthday">
          <br>
          <input type="password" name="Password" placeholder="New Password">
          <br>
          <input type="password" name="Repass" placeholder="Enter New Password again">
          <br><br>
        <input type = "submit" name ="update" value = "Change">
    <hr>
    <!-- </div> -->
    <div class = "delete" style="display:none">
      <h2>Delete Drinks</h2>
      <?php
        include('errorsDelete.php');
      ?>
      <form action = 'my-account.php' method = 'post'>
        <br>
        <label for="drinksDelete">Drink List</label>
          <select id="drinksDelete" class="drinksDelete" name="drinksDelete">

          </select>
          Are you sure?:
          <input type="checkbox" id="verify" name="verify">
          <br><br>
       <input type = "submit" name ="deleteD" value = "Delete">
    </div>
</div>



  </body>
    <script src="myaccount.js" charset="utf-8"></script>
</html>
