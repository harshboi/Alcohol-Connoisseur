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

 
      <section id="drinkpage">

	  
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
		$currentUser = $_SESSION['username'];
		//echo "current user ",$currentUser;
		
		$removeLike = 0;
		
		$pdo2 = new PDO($dsn, $user, $pass, $opt);
			
		// See if user is logged in so they can like the drink				
		$sql2 = "SELECT * From User WHERE Username='$currentUser'";
		$stmt2 = $pdo2->prepare($sql2);
		$stmt2->execute();
			
		if ($stmt2->rowCount() < 1) {
			echo "You must be logged in to like";
			// echo "Current User: ",$currentUser;
			$removeLike = 1;
		}
		$DrinkID = $_GET["did"];			
  
		// See if user already liked the drink   
        $sql = "SELECT * From Likes WHERE Drink_ID = '$DrinkID' AND Username='$currentUser'";
        $stmt = $pdo2->prepare($sql);
        $stmt->execute();

		if ($stmt->rowCount() > 0) {
			// username already liked the drink
			$removeLike = 1;
			echo "You already liked the drink<br>";
		}
		
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// this code block is executed when the user likes a drink

		
		$errormsg="";  // no error messages
		$DrinkID = $_GET["did"];			
		// See if user already likes the drink
        $sql = "SELECT * From Likes WHERE Drink_ID = '$DrinkID' AND Username='$currentUser'";
        $stmt = $pdo2->prepare($sql);
        $stmt->execute();

		if ($stmt->rowCount() > 0) {
			// username already liked the drink
			$removeLike = 1;
			echo "You already liked the drink<br>";
		} else {

			// prepare the insertion of the values into the database to prevent injections
				
			$stmt2 = $pdo2->prepare('INSERT INTO Likes (Drink_ID, Username) VALUES (?, ?)');
			$stmt2->bindParam(1, $DrinkID, PDO::PARAM_INT);
			$stmt2->bindParam(2, $currentUser, PDO::PARAM_STR);
			$stmt2->execute();
					
			if ($stmt2->rowCount() == 1) {
				echo "You Liked it! <p>";
				$removeLike = 1;
			} else {
				echo "Error liking ";
			}
			
		}
	
	}
	
        try {
			$DrinkID = $_GET["did"];
			
            $pdo = new PDO($dsn, $user, $pass, $opt);
			// Get information about the drinks from the drink table
           // $sql = "SELECT Photo, Title, Description, Username FROM Drink WHERE Drink_ID = '$DrinkID'";
		   
           $sql = "SELECT Photo, Title, Description, Drink.Username, count(*) FROM Drink LEFT JOIN Likes ON Drink.Drink_ID = Likes.Drink_ID GROUP BY Drink.Drink_ID HAVING Drink_ID = '$DrinkID'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
					
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			
				$title = $row['Title'];
				$photo = $row['Photo'];
				$description = $row['Description'];
				$drinkcreater = $row['Username'];
				$likes = $row['count(*)'];
				
				// The like button 
				if ( $removeLike == 0) {
					echo" <form method='post'>";
					//echo"<label>Like the drink ";
					echo"<input type = 'submit'  value = 'Like it' />";
				}
				echo"<div class='post-image-container'>";
				echo"<img src='images/",$photo,"'>";
				echo"</div>";
				echo "<p> Title: ";
				echo $title;
				echo "</a> <span class='post-price'>",$likes," Likes </span>";
				echo "<p> Description: "; 
				echo $description;
				echo "<p> Created by: "; 
				echo $drinkcreater;	
				echo "<p>";
				echo "<p>";
		
			}
			
			// List the Ingredients
		    $sql2 = "SELECT Ingredient.Name, Contain.Amount, Ingredient.Units From Ingredient, Contain WHERE Ingredient.Ingredient_ID = Contain.Ingredient_ID and Contain.Drink_ID ='$DrinkID'";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute();
			
			echo"<h2> Ingredients </h2>";
            echo" <table >";
			echo"<th>Name </th><th>Amount</th><th>Units</th>";				
           
			while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
					echo "<tr>";
					// build html table row by row
					foreach ($row as $cell) {	
							echo "<td>", $cell, "</td>";
						}
					echo "</tr>\n";
			}             
			echo"</table>";
			echo "<p>";
			echo "<p>";
			
			// List the Steps in the recipe
		    $sql3 = "SELECT Step_Number, Instructions From Steps WHERE Drink_ID ='$DrinkID'";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->execute();
			
			echo"<h3> Steps </h3>";
            echo" <table >";
		
           
			while($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
					echo "<tr>";
					// build html table row by row
					foreach ($row as $cell) {	
							echo "<td>", $cell, "</td>";
						}
					echo "</tr>\n";
			}             
			echo"</table>";
			echo "<p>";
			echo "<p>";	
			
			// List Equipment
		    $sql4 = "SELECT Name From Equipment, Uses WHERE Equipment.Equipment_ID = Uses.Equipment_ID AND Drink_ID ='$DrinkID'";
            $stmt4 = $pdo->prepare($sql4);
            $stmt4->execute();
			
			echo"<h3> Equipment </h3>";				
			while($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
					foreach ($row as $cell) {	
							echo $cell, "<br>";
						}
			}             
			echo "<p>";		
			
			
			// List the comments
		    $sql5 = "SELECT Text, Username From Comment WHERE Drink_ID ='$DrinkID'";
            $stmt5 = $pdo->prepare($sql5);
            $stmt5->execute();
			
			echo"<h3> Comments </h3>";
            echo" <table >";
		
           
			while($row = $stmt5->fetch(PDO::FETCH_ASSOC)){
				$commenter = $row['Username'];
				$commentText = $row['Text'];
				echo "Commenter :",$commenter," -- ";
				echo $commentText;
				echo"<p>";
			}             
			echo"</table>";
			echo "<p>";
			echo "<p>";	

			
		}
		catch (\PDOException $e) {
			$error_message = $e->getMessage();
            echo "<tr><td>", $error_message, "</td></tr>\n";
		}
                
?>


      </section>



  </body>

  <script src="index.js" charset="utf-8"></script>
</html>
