<?php

  session_start();

  $username = "";
  $errors = array();
  $errorsDelete = array();

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

  if(isset($_POST['register'])){
    $userVerify = 0;
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Username FROM User WHERE Username = ?");
    $res->execute([$_POST["Username"]]);
    $user = $res->fetch();
    if($_POST["Username"] === $user['Username']){
      array_push($errors, "Username already exists");
      $userVerify = 1;
    }
    if($_POST["Password"] != $_POST['Repass']){
      array_push($errors, "Passwords dont match");
      $userVerify = 1;
    }
    if($userVerify == 0){
      $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO User(Username, Birthday, First, Last, PasswordHash, Email) VALUES (?,?,?,?,?,?)');
      $stmt->execute([$_POST["Username"], $_POST["Birthday"], $_POST["FirstName"], $_POST["LastName"], $password, $_POST["Email"]]);
      $lower = strtolower($_POST["Username"]);
      $_SESSION['username'] = ucfirst($lower);
      header('location: index.php');
    }

  }

  if(isset($_POST['login'])){
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Username, PasswordHash FROM User WHERE Username = ?");
    $res->execute([$_POST["Username"]]);
    $user = $res->fetch();
    if(password_verify($_POST["Password"], $user['PasswordHash'])){
      $lower = strtolower($_POST["Username"]);
      $_SESSION['username'] = ucfirst($lower);
      header('location: index.php');
    }
    else{
      array_push($errors, "Wrong username or password");
    }
  }

  if(isset($_POST['update'])){
    $birthday;
    $email;
    $first;
    $last;
    $password;
    $redirect;
    $verify = 0;
    $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
    $res = $pdo->prepare("SELECT Username, Birthday, Email, First, Last, PasswordHash FROM User WHERE Username = ?");
    $res->execute([$_SESSION['username']]);
    $user = $res->fetch();
    $birthday = $user['Birthday'];
    $email = $user['Email'];
    $first = $user['First'];
    $last = $user['Last'];
<<<<<<< HEAD
    $password = $user['PasswordHash'];
=======
    $password = $user['Password'];
>>>>>>> 3f28a614755c80007c6ab4d05237f11cb03edd72
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
    if($_POST["Password"] != $_POST['Repass']){
      array_push($errors, "Passwords dont match");
      $verify = 1;
    }
    if($verify == 0){
      $res = $pdo->prepare("UPDATE User SET Birthday = ?, Email = ?, First = ?, Last = ?, PasswordHash = ? WHERE Username = ?");
      $res->execute([$birthday, $email, $first, $last, $password, $_SESSION['username']]);
      $user = $res->fetch();
      if($redirect == 1){
        $_SESSION['newpass'] = 1;
        header('location: log-in.php');
      }
    }
  }

<<<<<<< HEAD
  if(isset($_POST['deleteD'])){
    if(isset($_POST['verify'])){
      $selectOption = $_POST["drinksDelete"];
      $pdo = new PDO($dsn, $user, $pass, $opt); //Uses database information for the PDO
      $res = $pdo->prepare("DELETE FROM Drink WHERE Drink_ID = ?");
      $res->execute([$selectOption]);
      $user = $res->fetch();
    }
    else{
      array_push($errorsDelete, "Need to verify checkbox");
    }
  }

=======
>>>>>>> 3f28a614755c80007c6ab4d05237f11cb03edd72



?>
