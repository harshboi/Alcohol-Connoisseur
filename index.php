<?php
  //Used for maintaining sessions and ensuring that login information persists between pages and if the user decides to logout
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
	
	<script src="index.js" charset="utf-8" defer></script>
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

        <h2>Search</h2>

        <div class="filter-input-container">
          <label for="filter-text" class="filter-input-label">Title</label>
          <input type="text" name="filter-text" id="filter-text" class="filter-input">
        </div>


        <button id="filter-update-button" class="action-button">Update</button>

      </aside>

      <section id="posts">
	  
 <?php
		include 'db-password.php';  // this file includes the database password as a CONST DB_PASSWORD
        $host = 'classmysql.engr.oregonstate.edu';
        $db = 'cs340_schutfot';
        $user = 'cs340_schutfot';
        $charset = 'utf8mb4';
		
		$pass = DB_PASSWORD;

        // define database source name for accessing MariaDB
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $opt);
			// Get information about the drinks from the drink table
            $sql = "SELECT Drink.Drink_ID, Photo, Title, Description, Drink.Username, count(*) FROM Drink LEFT JOIN Likes ON Drink.Drink_ID = Likes.Drink_ID GROUP BY Drink.Drink_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
			
			//For each drink fetch all information to be displayed on homepage
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			
				$title = $row['Title'];
				$drink_id = $row['Drink_ID'];
				$photo = $row['Photo'];
				$description = $row['Description'];
				$likes = $row['count(*)'];
				$drinkcreater = $row['Username'];
				
				//If the photo doesn't exist, set as default image
				if($photo == ""){
					$photo = "cocktail.png";
				}
			
			//Place the drink in the html as a post
			echo"<div class='post' data-price='",$likes,"' data-city='",$description,"'>";
			echo"<div class='post-contents'>";
            echo"<div class='post-image-container'>";
			echo"<img src='images/",$photo,"'>";
            echo "</div>";
            echo"<div class='post-info-container'>";
			echo"<a href='drinkpage.php?did=",$drink_id,"' target='_blank' class='post-title'>",$title,"</a> <span class='post-price'>",$likes," Likes </span> <br><span class='post-city'>",$description,"</span>";
			echo"<span> <br> Created by: ",$drinkcreater,"</span>";
			echo"</div>";
			echo"</div>";
			echo"</div>";

		}
		}
		catch (\PDOException $e) {
			$error_message = $e->getMessage();
            echo "<tr><td>", $error_message, "</td></tr>\n";
		}
                
?>


      </section>

    </main>

  </body>
</html>
