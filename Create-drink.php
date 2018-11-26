<?php
  //Used for maintaining sessions and ensuring that login information persists between pages and if the user decides to logout

  include('server.php');
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['verify'] = "You must log in first";
  	header('location: log-in.php');
  }

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
        <a style="float:right" id = "test">Welcome <?php echo $_SESSION['username']; ?></a>
        <a style="float:right" href="index.php?logout='1'">Logout</a>
      <?php endif ?>
      <a href="About.php">About</a>
    </div>

<div class = "Create_drink">
  <h1>Upload your drink</h1>
  <h3>Fill out the form below</h3>
    <form action = "Create-drink.php" method = "post" enctype="multipart/form-data">
      <label for="fname">Title</label>
      <input type="text" id="fname" name="firstname" placeholder="Title" required>

      <label for="Description">Description</label>
      <textarea id="Description" name="Description" placeholder="Description (optional)"></textarea>

      <div id="Steps_Div">
        <label for="Steps">Steps</label>
        <br><br>
      </div>
      <input type="button" id = "addstep" value="Add Step">
      <input type="button" id = "removeStep" value="Remove Step">

      <br><br>
      <div id="Equipment_Div">
        <label for="Equipment">Equipment</label>
        <br><br>
      </div>
        <input type="button" id = "addEquip"value="Add Equipment">
        <input type="button" id = "removeEquip" value="Remove Equipment">

      <br><br>
      <div id="Ingredients_Div">
        <label for="Ingredients">Ingredients</label>
        <br><br>
      </div>
        <input type="button" id = "addIngr" value="Add Ingredient">
        <input type="button" id = "removeIngr" value="Remove Ingredient">

      <br><br>
      <label for="pic">Image</label>
      <input id = "pic" type="file" name="pic" accept="image/*" placeholder="image">

    <input type = "submit" value = "Submit" name = "create_drink">
</div>



  </body>

  <script src="drink.js" charset="utf-8"></script>
</html>
