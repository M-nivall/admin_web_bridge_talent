<?php
include('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bridge Talent</title>

  <!-- Base CSS -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/coolinglogo.png" />

  <!-- Custom Styles -->
  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c 0%, #928dab 100%);
      font-family: 'Poppins', sans-serif;
    }

    .auth {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .auth-form-light {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      padding: 40px 35px;
    }

    .brand-logo img {
      width: 80px;
      height: 80px;
      object-fit: contain;
    }

    h4 {
      color: #333;
      font-weight: 600;
      margin-top: 15px;
    }

    h6 {
      color: #6c757d;
      font-size: 15px;
      margin-bottom: 30px;
    }

    .form-control {
      border-radius: 10px;
      height: 50px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      font-size: 15px;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
    }

    .auth-form-btn {
      background: #007bff;
      border-radius: 10px;
      transition: 0.3s ease-in-out;
      font-weight: 600;
    }

    .auth-form-btn:hover {
      background: #0056b3;
      transform: translateY(-2px);
    }

    .error-msg {
      color: red;
      background: #ffe5e5;
      border-left: 4px solid red;
      padding: 10px;
      border-radius: 8px;
      font-size: 14px;
      margin-bottom: 15px;
    }

    @media (max-width: 767px) {
      .auth-form-light {
        padding: 30px 25px;
      }
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper auth bg-transparent">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-center py-5 px-4 px-sm-5">
            <div class="brand-logo d-flex justify-content-center align-items-center">
              <img src="images/coolinglogo.png" alt="logo">
            </div>
            <h4>Admin Login</h4>
            <h6>Sign in to continue</h6>

            <form class="pt-3" action="login.php" method="post">
              <?php include('errors.php'); ?>

              <div class="form-group text-left">
                <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" required>
              </div>

              <div class="form-group text-left">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
              </div>

              <div class="mt-4">
                <button class="btn btn-block btn-primary btn-lg auth-form-btn" name="login_user" type="submit">SIGN IN</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
  </div>

  <!-- JS Plugins -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
</body>

</html>
