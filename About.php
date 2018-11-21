<?php
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
        </div>
      </div>
      <a href="Create-drink.php">Create Drink</a>
      <?php if(isset($_SESSION['username'])) : ?>
        <a style="float:right" id = "test">Welcome <?php echo $_SESSION['username']; ?></a>
        <a style="float:right" href="index.php?logout='1'">Logout</a>
      <?php endif ?>
      <a href="About.php">About</a>
    </div>

<div class = "about">
    <h1>About Us</h1>
    <h3 class="header">Welcome to the website where amateurs, veterans and connoiseeurs can all enjoy new drinks created by you!</h3>

    <p class="prose">This website was developed in order for people who enjoy drinks to try out the creations of others. We believe
      the best drinks are created by everyday people and not by large corporations. We encourage people to communicate and share their experience with their
      favorite drinks. We don't support underage drinking and we prohibit any users under 21 from making an account. Thanks for visiting us and enjoy the website!</p>

    <h1>Any Questions or Bugs?</h1>
    <h3 class="header">Contact the developers</h3>
    <p class="prose">Sachin Sakthivel: Sakthisa@oregonstate.edu</p>
    <p class="prose">Harshvardhan Singh: Singhhar@oregonstate.edu</p>
    <p class="prose">Theodor Schutfort: Schutfot@oregonstate.edu</p>
</div>



  </body>

</html>
