<?php 
    session_start() ;
    include('config.php');
    if(isset($_POST["reset"])){
        include('config.php');
        $psw = $_POST["password"];
        $cpsw = $_POST["cpassword"];
        $flag = 0;
        if(strlen($psw) < 8) {
            $password_error = "Password must be minimum of 8 characters";
            $flag = 1;
        }
        if($psw != $cpsw) {
            $cpassword_error = "Password and Confirm Password doesn't match";
            $flag = 1;
        }
        if($flag == 0){
            $Email = $_SESSION['email'];
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$Email'");
            $query = mysqli_num_rows($sql);
            $fetch = mysqli_fetch_assoc($sql);
            if($Email){
                $new_pass = md5($psw);
                mysqli_query($conn, "UPDATE users SET password='$new_pass' WHERE email='$Email'");
                unset($_SESSION['token']);
                session_destroy();
?>
                <script>
                    window.location.replace("login.php");
                    alert("<?php echo "your password has been succesful reset"?>");
                </script>
<?php
            }else{
?>
                <script>
                    window.location.replace("forgot.php");
                    alert("<?php echo "Please try again"?>");
                </script>
<?php
            }
            mysqli_close($conn);   
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
  </head>
  <body>
    <img src="images/img/logo.png" class="logo">
    <div class="container">
      <div class="center" style="top: 370px">
        <h1 class="text-white">Change Password</h1>
        <div class="err-box" id="errb">
          <p class="text-danger" id="danger">
<?php
            if (isset($cpassword_error)){
?>
              <script>
                document.getElementById("danger").innerHTML = "<?php echo $cpassword_error ?>";
                document.getElementById("danger").style.backgroundColor = "rgba(255,255,255,0.15)";
                document.getElementById("danger").style.border = "2px solid red";
                document.getElementById("errb").style.height = "auto";
                <?php unset($cpsw)?>;
              </script>
<?php
            }
            if (isset($password_error)){
?>
              <script>
                document.getElementById("danger").innerHTML = "<?php echo $password_error ?>";
                document.getElementById("danger").style.backgroundColor = "rgba(255,255,255,0.15)";
                document.getElementById("danger").style.border = "2px solid red";
                document.getElementById("errb").style.height = "auto";
                <?php unset($psw)?>;
              </script>
<?php
            }
?>
          </p>
        </div>
        <form method="post">
          <div class="txt_field">
            <label class="text-white">New Password</label><br><br>
            <input type="password" required name="password" id="password" placeholder="Enter New Password" value="<?php if(isset($psw)) echo $psw?>">
            <span></span>
          </div>
          <div class="txt_field">
            <label class="text-white">Confirm Password</label><br><br>
            <input type="password" required name="cpassword" id="cpassword" placeholder="Confirm Password" value="<?php if(isset($cpsw)) echo $cpsw?>">
            <span></span>
          </div>
          <input type="submit" class="done" name="reset" value="Change">
          <label>   &nbsp;</label>
        </form>
      </div>
    </div>
  </body>
</html>