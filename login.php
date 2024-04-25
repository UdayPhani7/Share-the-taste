 <?php
  session_start();
  require_once "config.php";
  if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
  }
  if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password). "'");
    if(!empty($result)) {
      if ($row = mysqli_fetch_array($result)) {
        $_SESSION['user_id'] = $row['uid'];
        $_SESSION['user_name'] = $row['name'];  
        $_SESSION['user_email'] = $row['email'];
        header("Location: dashboard.php");
      }
      else {
        $error_message = "Incorrect Username or Password!!!";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Share The Taste</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" style="text/css" href="style.css">
    <link rel="icon" type="text/css" href="images/img/favicon.ico">
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-dark">
      <div class="container-fluid">
        <img src="images/img/logo.png" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
          <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
              <a class="nav-link text-white" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="signup.php">Signup</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contactus.php">Contactus</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="center" style="top:400px">
        <h1 class="text-white">Login</h1>
        <div class="err-box" id="errb">
          <div class="text-danger" id="danger">
<?php 
            if (isset($error_message)){
?>
              <script>
                document.getElementById("danger").innerHTML = "<?php echo $error_message ?>";
                document.getElementById("danger").style.backgroundColor = "rgba(255,255,255,0.15)";
                document.getElementById("danger").style.border = "2px solid red";
                document.getElementById("errb").style.height = "auto";
                <?php unset($error_message) ?>
              </script>
<?php
            }
?>
          </div>
        </div>
        <form method="post">
          <div class="txt_field">
            <label class="text-white">Email</label><br><br>
            <input type="email" required name="email" placeholder="Enter Email">
            <span></span>
          </div>
          <div class="txt_field">
            <label class="text-white">Password</label><br><br>
            <input type="password" required name="password" placeholder="Enter Password">
            <span></span>
          </div>
          <input type="submit" class="done" name="login" value="Login">
          <div class="pass pt-2 text-center">
            <a href="forgot.php" class="text-white">Forgot password?</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>