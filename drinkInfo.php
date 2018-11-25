<?php
          //Used for maintaining the currently logged in user when visiting different pages
          session_start();

          //Variables to hold DB authentication information to connect to the DB and to operate on using PDO
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
                $ingredientName = array(); //Stores the queried ingredients name
                $ingredientType = array(); //Stores the queried Type
                $ingredientUnit = array(); //Stores the queried Unit
                $equipmentName = array(); //Stores the queried equipment name

                //Query all the equipment names and push them in an array
                $pdo = new PDO($dsn, $user, $pass, $opt);
                $res = $pdo->query("SELECT Name FROM Equipment");
                foreach($res as $row){
                  $equipmentName['equipment'] = array_push($equipmentName, $row['Name']);
                }

                //Query all the ingredients names and their associated type and units
                $res = $pdo->query("SELECT Name, Type, Units FROM Ingredient");
                foreach($res as $row){
                  $ingredientName['name'] = array_push($ingredientName, $row['Name']);
                  $ingredientType['type'] = array_push($ingredientType, $row['Type']);
                  $ingredientUnit['unit'] = array_push($ingredientUnit, $row['Units']);
                }



                //Concatenate all the queries into a single JSON object that is sent to an AJAX get request in order to be displayed on the create-drink page
                echo json_encode(array($equipmentName, $ingredientName, $ingredientType, $ingredientUnit));
          }
          //If any issues occurred querying for the DB display an error message.
          catch (\PDOException $e) {
                $error_message = $e->getMessage();
                echo "<tr><td>", $error_message, "</td></tr>\n";
          }
?>
