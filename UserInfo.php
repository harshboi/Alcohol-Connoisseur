  <?php
            //Used for maintaining the currently logged in user when visiting different pages
            include 'db-password.php';
            session_start();

            //Variables to hold DB authentication information to connect to the DB and to operate on using PDO
            $host = 'classmysql.engr.oregonstate.edu';
            $db = 'cs340_schutfot';
            $user = 'cs340_schutfot';
            $charset = 'utf8mb4';
            $pass = DB_PASSWORD;
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            ];
            //When the user visits their account all information regarding the drinks created, comments, likes, account information will be queried
            //And sent to an AJAX request to be displayed on the webpage
            try {
                  $data = array(); //This will hold information of the user's drink title that they have created
                  $description = array(); //This will hold information of the user's drink description that they have created
                  $comment = array(); //This will hold the comments that the user has created
                  $drink = array(); //This will hold the drink title that has the user's comments
                  $dusername = array(); //This will hold the username for the drink that the user has commented on
                  $likeTitle = array(); //This will hold the drink title for the drink the user has liked
                  $likeUser = array(); //This will hold the username for the drink that the user has liked
                  $bday = array(); //This will hold the user's birthday
                  $first = array(); //This will hold the user's first name
                  $last = array(); //This will hold the user's last name
                  $email = array(); //This will hold the user's email
                  $drinkID = array(); //This will hold the drink ID for the drinks that the user has created

                  //Query the drinks that the currently logged in user has created
                  $username = $_SESSION['username'];
                  $pdo = new PDO($dsn, $user, $pass, $opt);
                  $res = $pdo->prepare("SELECT Drink_ID, Title, Description FROM Drink WHERE Username = ?");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $data['drinks'] = array_push($data, $title['Title']);
                    $description['description'] = array_push($description, $title['Description']);
                    $drinkID['drinkid'] = array_push($drinkID, $title['Drink_ID']);
                  }

                  //Query the comment text that was created for a drink that a particular user has created
                  $res = $pdo->prepare("SELECT Comment.Text, Drink.Title, Drink.Username FROM User, Drink, Comment WHERE User.Username = ? AND User.Username = Comment.Username AND Drink.Drink_ID = Comment.Drink_ID");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $comment['comments'] = array_push($comment, $title['Text']);
                    $drink['drinks'] = array_push($drink, $title['Title']);
                    $dusername['username'] = array_push($dusername, $title['Username']);
                  }

                  //Query all the user's likes that correspond to a drink created by a particular user
                  $res = $pdo->prepare("SELECT Drink.Title, Drink.Username FROM User, Drink, Likes WHERE User.Username = ? AND User.Username = Likes.Username AND Drink.Drink_ID = Likes.Drink_ID");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $likeUser['username'] = array_push($likeUser, $title['Username']);
                    $likeTitle['drinks'] = array_push($likeTitle, $title['Title']);
                  }

                  //Query the user's birthday, firstname, lastname and email
                  $res = $pdo->prepare("SELECT Birthday, First, Last, Email FROM User WHERE Username = ?");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $bday['birthday'] = array_push($bday, $title['Birthday']);
                    $first['first'] = array_push($first, $title['First']);
                    $last['last'] = array_push($last, $title['Last']);
                    $email['email'] = array_push($email, $title['Email']);
                  }

                  //Concatenate all the queries into a single JSON object that is sent to an AJAX get request in order to be displayed on the account page
                  echo json_encode(array($data, $description, $comment, $drink, $dusername, $likeUser, $likeTitle, $bday, $first, $last, $email, $drinkID));
            }
            //If any issues occurred querying for the DB display an error message.
            catch (\PDOException $e) {
                  $error_message = $e->getMessage();
                  echo "<tr><td>", $error_message, "</td></tr>\n";
            }
  ?>
