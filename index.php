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
        <img src="cocktail.png" alt="cocktail">
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


    <main class="content">
      <aside class="filter-container">

        <h2>Filters</h2>

        <div class="filter-input-container">
          <label for="filter-text" class="filter-input-label">Text</label>
          <input type="text" name="filter-text" id="filter-text" class="filter-input">
        </div>

        <div class="filter-input-container">
          <label for="filter-min-price" class="filter-input-label">Price</label>
          <input type="number" name="filter-min-price" id="filter-min-price" class="filter-input" placeholder="min">
          <input type="number" name="filter-max-price" id="filter-max-price" class="filter-input" placeholder="max">
        </div>

        <div class="filter-input-container">
          <label for="filter-city">City</label>
          <select id="filter-city" class="filter-input" name="filter-city">
            <option selected value="">Any</option>
            <option>Corvallis</option>
            <option>Albany</option>
            <option>Eugene</option>
            <option>Portland</option>
            <option>Salem</option>
            <option>Bend</option>
          </select>
        </div>

        <div class="filter-input-container">
          <fieldset id="filter-condition" class="filter-fieldset">
            <legend>Condition</legend>
            <div>
              <input type="checkbox" name="filter-condition" id="filter-condition-new" value="new">
              <label for="filter-condition-new">New</label>
            </div>
            <div>
              <input type="checkbox" name="filter-condition" id="filter-condition-excellent" value="excellent">
              <label for="filter-condition-excellent">Excellent</label>
            </div>
            <div>
              <input type="checkbox" name="filter-condition" id="filter-condition-good" value="good">
              <label for="filter-condition-good">Good</label>
            </div>
            <div>
              <input type="checkbox" name="filter-condition" id="filter-condition-fair" value="fair">
              <label for="filter-condition-fair">Fair</label>
            </div>
            <div>
              <input type="checkbox" name="filter-condition" id="filter-condition-poor" value="poor">
              <label for="filter-condition-poor">Poor</label>
            </div>
          </fieldset>
        </div>

        <button id="filter-update-button" class="action-button">Update</button>

      </aside>

      <section id="posts">

        <div class="post" data-price="500" data-city="Eugene" data-condition="poor">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="https://cnet4.cbsistatic.com/img/xTXdUEQEBqoDx74pbwCcpUc1XFQ=/fit-in/370x0/2017/01/18/c68ae3ac-6795-4d38-91e9-ec3e4fbffd6c/9401078c315052fc72a74b.jpg" alt="Super nice laptop">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Super nice laptop</a> <span class="post-price">$500</span> <span class="post-city">(Eugene)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="20" data-city="Corvallis" data-condition="excellent">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="http://www.bendbulletin.com/csp/mediapool/sites/dt.common.streams.StreamServer.cls?STREAMOID=nT08h69xtGPI_1rYp2vMZ8$daE2N3K4ZzOUsqbU5sYvcgrKwveORUjiMjWvNLIHiWCsjLu883Ygn4B49Lvm9bPe2QeMKQdVeZmXF$9l$4uCZ8QDXhaHEp3rvzXRJFdy0KqPHLoMevcTLo3h8xh70Y6N_U_CryOsw6FTOdKL_jpQ-&CONTENTTYPE=image/jpeg" alt="Platypus Trophy">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Platypus Trophy</a> <span class="post-price">$20</span> <span class="post-city">(Corvallis)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="100" data-city="Portland" data-condition="new">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="http://static-21.sinclairstoryline.com/resources/media/9e359e52-2d79-4aa6-a43b-2ba534b9db0c-large16x9_378b19aa394049a4a9ca7101e4e75be4voodoodoughnutrecord660.jpg?1463527394583" alt="Very large pile of interesting donuts">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Very large pile of interesting donuts</a> <span class="post-price">$100</span> <span class="post-city">(Portland)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="250" data-city="Salem" data-condition="fair">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="http://static.legalsolutions.thomsonreuters.com/product_photos/p40307624-141728L.jpg" alt="Oregon laws">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Oregon laws</a> <span class="post-price">$250</span> <span class="post-city">(Salem)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="1" data-city="Bend" data-condition="new">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="http://i.huffpost.com/gen/1573833/images/o-SUNSHINE-facebook.jpg" alt="Sunshine">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Sunshine</a> <span class="post-price">$1</span> <span class="post-city">(Bend)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="99" data-city="Portland" data-condition="fair">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="https://az616578.vo.msecnd.net/files/2016/05/21/6359939006070313161632155840_hipsters.jpg" alt="Hipsters">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Hipsters</a> <span class="post-price">$99</span> <span class="post-city">(Portland)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="20000000" data-city="Eugene" data-condition="good">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/102707-Oregon-AutzenStadium-ext.jpg/1200px-102707-Oregon-AutzenStadium-ext.jpg" alt="Football stadium (we kind of want to build a new one)">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Football stadium (we kind of want to build a new one)</a> <span class="post-price">$20000000</span> <span class="post-city">(Eugene)</span>
            </div>
          </div>
        </div>

        <div class="post" data-price="10000" data-city="Corvallis" data-condition="excellent">
          <div class="post-contents">
            <div class="post-image-container">
              <img src="https://farm2.staticflickr.com/1258/1366422925_25663f44c8_z.jpg" alt="Very nice farmer's market">
            </div>
            <div class="post-info-container">
              <a href="#" class="post-title">Very nice farmer's market</a> <span class="post-price">$10000</span> <span class="post-city">(Corvallis)</span>
            </div>
          </div>
        </div>

      </section>

    </main>

  </body>

  <script src="index.js" charset="utf-8"></script>
</html>
