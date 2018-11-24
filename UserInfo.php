  <?php
            session_start();
            $host = 'classmysql.engr.oregonstate.edu';
            $db = 'cs340_schutfot';
            $user = 'cs340_schutfot';
            $charset = 'utf8mb4';
            $pass = 'Obama08';
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            ];
            try {
                  $data = array();
                  $description = array();
                  $comment = array();
                  $drink = array();
                  $dusername = array();
                  $likeTitle = array();
                  $likeUser = array();
                  $bday = array();
                  $first = array();
                  $last = array();
                  $email = array();
                  $drinkID = array();
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
                  $res = $pdo->prepare("SELECT Comment.Text, Drink.Title, Drink.Username FROM User, Drink, Comment WHERE User.Username = ? AND User.Username = Comment.Username AND Drink.Drink_ID = Comment.Drink_ID");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $comment['comments'] = array_push($comment, $title['Text']);
                    $drink['drinks'] = array_push($drink, $title['Title']);
                    $dusername['username'] = array_push($dusername, $title['Username']);
                  }
                  $res = $pdo->prepare("SELECT Drink.Title, Drink.Username FROM User, Drink, Likes WHERE User.Username = ? AND User.Username = Likes.Username AND Drink.Drink_ID = Likes.Drink_ID");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $likeUser['username'] = array_push($likeUser, $title['Username']);
                    $likeTitle['drinks'] = array_push($likeTitle, $title['Title']);
                  }
                  $res = $pdo->prepare("SELECT Birthday, First, Last, Email FROM User WHERE Username = ?");
                  $res->execute([$username]);
                  $user = $res->fetchAll(PDO::FETCH_ASSOC);
                  foreach($user as $title){
                    $bday['birthday'] = array_push($bday, $title['Birthday']);
                    $first['first'] = array_push($first, $title['First']);
                    $last['last'] = array_push($last, $title['Last']);
                    $email['email'] = array_push($email, $title['Email']);
                  }
                  echo json_encode(array($data, $description, $comment, $drink, $dusername, $likeUser, $likeTitle, $bday, $first, $last, $email, $drinkID));
            } catch (\PDOException $e) {
                  $error_message = $e->getMessage();
                  echo "<tr><td>", $error_message, "</td></tr>\n";
            }
            //SELECT Birthday, First, Last, Email FROM User WHERE Username = 'sakthisa'
  ?>
