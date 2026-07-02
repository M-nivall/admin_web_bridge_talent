<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// initializing variables
$username = "";
$email   = "";
$phone = "";
$errors = array();

/* ==============================
   NEW RAILWAY DATABASE CONFIG
   ============================== */

$host = "zephyr.proxy.rlwy.net";
$user = "root";
$password = "vwukUfsZVrYOjHdkSaIJzaTvsldRwXik";
$database = "railway";
$port = 58449;

$db = mysqli_connect($host, $user, $password, $database, $port);

if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}


// REGISTER USER
if (isset($_POST['reg_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Username cannot be empty"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }

  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM admin
                       WHERE username='$username'
                       OR email='$email'
                       LIMIT 1";

  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {

    // Keeping your original behavior
    $password = md5($password_1);

    $query = "INSERT INTO admin
              (username, email, phone, password)
              VALUES
              ('$username', '$email', '$phone', '$password')";

    mysqli_query($db, $query);

    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";

    header('location: index.php');
    exit();
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }

  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {

    // EXACTLY like your old working code
    $password = $password;

    $query = "SELECT * FROM admin
              WHERE username='$username'
              AND password='$password'";

    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {

      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";

      header('location: index.php');
      exit();

    } else {
      array_push($errors, "Wrong username AND/OR password combination");
    }
  }
}
?>