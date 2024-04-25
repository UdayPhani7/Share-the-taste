<?php 
  if(isset($_POST["recover"])){
    include('config.php');
    $email = $_POST["email"];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    mysqli_close($conn);
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql) <= 0){
?>
      <script>
        alert("<?php  echo "Sorry, no emails exists "?>");
      </script>
<?php
    }else{
      $token = bin2hex(random_bytes(50));
      session_start ();
      $_SESSION['token'] = $token;
      $_SESSION['email'] = $email;
      require "Mail/phpmailer/PHPMailerAutoload.php";
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->Host='smtp.gmail.com';
      $mail->Port=587;
      $mail->SMTPAuth=true;
      $mail->SMTPSecure='tls';
      $mail->Username='pphanindra.19.cse@anits.edu.in';
      $mail->Password='anits123*';
      $mail->setFrom('pphanindra.19.cse@anits.edu.in', 'Password Reset');
      $mail->addAddress($_POST["email"]);
      $mail->isHTML(true);
      $mail->Subject="Recover your password";
      $mail->Body="<b>Dear User</b>
      <h3>We received a request to reset your password.</h3>
      <p>Kindly click the below link to reset your password</p>
      http://localhost/STT/reset_psw.php
      <br><br>
      <p>With regrads,</p>
      <b>Share The Taste</b>";
      if(!$mail->send()){
?>
        <script>
          alert("<?php echo " Invalid Email "?>");
        </script>
<?php
      }else{
?>
        <script>
          
          window.location.replace("notification.php");
        </script>
<?php
      }
    }
  }
?>
<!DOCTYPE html>
  <head>
    <title>Share The Taste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" style="text/css" href="style.css">
    <link rel="icon" type="text/css" href="images/img/favicon.ico">
    <style>
      pre a:link {
        color: blue;
      }
      pre a:visited {
        color: white;
      }
      pre a:hover {
        color: red;
      }
      pre a:active {
        color: yellow;
      }
      pre{
        margin-top: 3px;
      }
      </style>
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
              <a class="nav-link text-white" href="login.php">Login</a>
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
      <div class="center" style="top: 400px; width: 410px;">
        <h1 class="text-white">Account Recovery</h1>
        <form class="text-white" method="post">
          <small>We'll never share your Email with anyone else.</small><br>
          <pre style="overflow: none;">Follow the below steps to recieve a mail
1. Login to your mail account
2. Open <a href="https://myaccount.google.com/">https://myaccount.google.com/</a> link
3. Goto Security settings
4. 'ON' the <b>Less Secure App Access</b> Setting</pre>
          <div class="txt_field">
            <label>Email ID</label><br><br>
            <input type="text" required name="email" placeholder="Enter Email Id">
            <span></span>
          </div>
          <input type="submit" class="done" name="recover" value="Submit">
          <label>   &nbsp;</label>
        </form>
      </div>
    </div>
  </body>
</html>