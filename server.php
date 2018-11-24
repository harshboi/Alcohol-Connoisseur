<?php
  //This is the main server for the website where it will take care of all POST requests from the various forms on the website

  //Creating sessions to allow for login information to be preserved when visiting different webpages
  session_start();

  //Variables used for holding the currently logged in user for sessions and for holding possible errors that can occur from the input forms
  $username = "";
  $errors = array();
  $errorsDelete = array();

  //PDO setup to prevent SQL injection as well as variables to hold DB connection information in order to properly authenticate and operate on the database
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

  //If the user wants to register a new user (Enters information in the sign-up page) error check for invalid information and then insert into the DB
  if(isset($_POST['register'])){
    $userVerify = 0;
    //Query for the username that matches the username inputted by the user
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Username FROM User WHERE Username = ?");
    $res->execute([$_POST["Username"]]);
    $user = $res->fetch();

    //If the username is already in the DB tell the user the username already exists
    if($_POST["Username"] === $user['Username']){
      array_push($errors, "Username already exists");
      $userVerify = 1;
    }

    //Verify that both the initial password and password verification input textboxes are the same before inserting their information
    if($_POST["Password"] != $_POST['Repass']){
      array_push($errors, "Passwords dont match");
      $userVerify = 1;
    }

    //If no erros have occurred then proceed to insert information to the DB using prepare statements and PDO to prevent SQL injections
    if($userVerify == 0){
      //Use an insert statement to store user information from form
      $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO User(Username, Birthday, First, Last, PasswordHash, Email) VALUES (?,?,?,?,?,?)');
      $stmt->execute([$_POST["Username"], $_POST["Birthday"], $_POST["FirstName"], $_POST["LastName"], $password, $_POST["Email"]]);

      //Once they signed up automatically log them in based on the username they provided and create a session for their username
      $lower = strtolower($_POST["Username"]);
      $_SESSION['username'] = ucfirst($lower);
      header('location: index.php');
    }
  }

  //If the user enters the login button from the log-in page verify their credentials match the information in the DB and then log them in
  if(isset($_POST['login'])){

    //First query the username and passwordhash from the DB based on the inputted username
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Username, PasswordHash FROM User WHERE Username = ?");
    $res->execute([$_POST["Username"]]);
    $user = $res->fetch();

    //If the password that the user has inputted matches the passwordhash in the DB then send them to the homepage and create a new user session
    if(password_verify($_POST["Password"], $user['PasswordHash'])){
      $lower = strtolower($_POST["Username"]);
      $_SESSION['username'] = ucfirst($lower);
      header('location: index.php');
    }
    //If there are any problems with the authentication then display an error message to the user
    else{
      array_push($errors, "Wrong username or password");
    }
  }

  //If the user decided to change their account information
  if(isset($_POST['update'])){
    //Variables to hold user information (birthday, email, firstname, lastname, password)
    $birthday;
    $email;
    $first;
    $last;
    $password;

    //Variables used for proper authentication and error handling
    $redirect;
    $verify = 0;

    //First query for the user information based on the currently signed in user
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Username, Birthday, Email, First, Last, PasswordHash FROM User WHERE Username = ?");
    $res->execute([$_SESSION['username']]);
    $user = $res->fetch();
    $birthday = $user['Birthday'];
    $email = $user['Email'];
    $first = $user['First'];
    $last = $user['Last'];
    $password = $user['PasswordHash'];

    //If any textboxes are empty when they try to change their account information, keep the original account info and don't update
    if($_POST["FirstName"] != ""){
      $first = $_POST["FirstName"];
    }
    if($_POST["LastName"] != ""){
      $last = $_POST["LastName"];
    }
    if($_POST["Birthday"] != ""){
      $birthday = $_POST["Birthday"];
    }
    if($_POST["Email"] != ""){
      $email = $_POST["Email"];
    }
    if($_POST["Password"] != ""){
      $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
      $redirect = 1;
    }

    //Verify that the new password matches the second entry for the new password
    if($_POST["Password"] != $_POST['Repass']){
      array_push($errors, "Passwords dont match");
      $verify = 1;
    }

    //If there are no errors when updating the account information insert updated information if changed to the DB
    if($verify == 0){
      $res = $pdo->prepare("UPDATE User SET Birthday = ?, Email = ?, First = ?, Last = ?, PasswordHash = ? WHERE Username = ?");
      $res->execute([$birthday, $email, $first, $last, $password, $_SESSION['username']]);
      $user = $res->fetch();

      //If user changed their password, redirect them to the login page to login with their new password
      if($redirect == 1){
        $_SESSION['newpass'] = 1;
        header('location: log-in.php');
      }
    }
  }

  //If the user decides to delete one of the drinks they created
  if(isset($_POST['deleteD'])){
    //Once they verified they want to delete the drink they have selected use a DELETE statement to delete the drink with a certain DRINK_ID
    if(isset($_POST['verify'])){
      $selectOption = $_POST["drinksDelete"];
      $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
      $res = $pdo->prepare("DELETE FROM Drink WHERE Drink_ID = ?");
      $res->execute([$selectOption]);
      $user = $res->fetch();
    }
    //If they didn't verify they want to delete the drink, send an error message to the user
    else{
      array_push($errorsDelete, "Need to verify checkbox");
    }
  }

  //If the user wants to update the title, description or photo of any drinks
  if(isset($_POST['updateDrink'])){

    //Variables to hold the drink they have selected, and the current photo, title and description from the DB
    $selectOption = $_POST["drinksUpdate"];
    $photo;
    $title;
    $description;

    //First query for old information based on the drink the user wants to change
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Photo, Title, Description FROM Drink WHERE Drink_ID = ?");
    $res->execute([$selectOption]);
    $user = $res->fetch();


    $photo = $user['Photo'];
    $title = $user['Title'];
    $description = $user['Description'];

    //If any of the input text boxes are empty then keep current information for any empty input boxes, else update
    if($_POST["pic"] != ""){
      $photo = $_POST["pic"];
    }
    if($_POST["Title"] != ""){
      $title = $_POST["Title"];
    }
    if($_POST["Description"] != ""){
      $description = $_POST["Description"];
    }

    //Update drink information if the user has changed any information
    $res = $pdo->prepare("UPDATE Drink SET Photo = ?, Title = ?, Description = ? WHERE Drink_ID = ?");
    $res->execute([$photo, $title, $description, $selectOption]);
  }




?>
