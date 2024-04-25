<?php
	require_once "config.php";
	if(isset($_SESSION['user_id'])!="") {
		header("Location: dashboard.php");
	}
	if (isset($_POST['signup'])) {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']); 
		$flag=0;
		if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$name_error = "Name must contain only alphabets and space";
			$flag=1;
		}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$email_error = "Please Enter Valid Email ID";
			$flag=1;
		}
		if(strlen($password) < 8) {
			$password_error = "Password must be minimum of 8 characters";
			$flag=1;
		}       
		if($password != $cpassword) {
			$cpassword_error = "Password and Confirm Password doesn't match";
			$flag=1;
		}
		if($flag==0){
			$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "'");
			if(mysqli_num_rows($result) > 0){
?>
				<script>
					window.location.replace("login.php");
	                alert("<?php echo "Error : User Already Existing"?>");
				</script>
<?php
			}else {
				if(mysqli_query($conn, "INSERT INTO users(name, email, password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")){
					header("Location: login.php");
					exit();
				} else {
?>
					<script>
						window.location.replace("signup.php");
		                alert("<?php echo "Error : Unable to SignUp"?>");
					</script>
<?php
				}
			}
			mysqli_close($conn);
		}
	}
?>
<!DOCTYPE html>
	<head><title>Share The Taste</title>
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
			              	<a class="nav-link text-white" href="login.php">Login</a>
			            </li>
			            <li class="nav-item">
			              	<a class="nav-link active" href="#">Signup</a>
			            </li>
			            <li class="nav-item">
			            	<a class="nav-link text-white" href="contactus.php">Contactus</a>
			            </li>
			        </ul>
		        </div>
      		</div>
    	</nav>
    	<div class="container">
			<div class="center" style="top:490px">
				<h1 class="text-white mt-2">Signup</h1>
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
							<?php unset($cpassword)?>;
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
							<?php unset($password)?>;
						</script>
<?php
					}
					if (isset($email_error)){
?>
						<script>
							document.getElementById("danger").innerHTML = "<?php echo $email_error ?>";
							document.getElementById("danger").style.backgroundColor = "rgba(255,255,255,0.15)";
							document.getElementById("danger").style.border = "2px solid red";
							document.getElementById("errb").style.height = "auto";
							<?php unset($email)?>;
						</script>
<?php
					}

					if (isset($name_error)){
?>
						<script>
							document.getElementById("danger").innerHTML = "<?php echo $name_error ?>";
							document.getElementById("danger").style.backgroundColor = "rgba(255,255,255,0.15)";
							document.getElementById("danger").style.border = "2px solid red";
							document.getElementById("errb").style.height = "auto";
							<?php unset($name)?>;
						</script>
<?php
					}
?>
					</p>
				</div>
				<form method="post">
					<div class="txt_field">
						<label class="text-white">Username</label><br><br>
						<input type="text" required name="name" id="name" placeholder="Enter Username" value="<?php if(isset($name)) echo $name?>">
						<span></span>
					</div>
					<div class="txt_field">
						<label class="text-white">Email ID</label><br><br>
						<input type="text" required name="email" id="email" placeholder="Enter Email Id" value="<?php if(isset($email)) echo $email?>">
						<span></span>
					</div>
					<div class="txt_field">
						<label class="text-white">Password</label><br><br>
						<input type="password"required name="password" id="password" placeholder="Enter Password" value="<?php if(isset($password)) echo $password?>">
						<span></span>
					</div>
					<div class="txt_field">
						<label class="text-white">Confirm Password</label><br><br>
						<input type="password" required name="cpassword" id="cpassword" placeholder="Confirm Password" value="<?php if(isset($cpassword)) echo $cpassword?>">
						<span></span>
					</div>
					<input type="submit" class="done" name="signup" value="Signup">
					<div>
						<a href="login.php" class="text-white mt-2">Existing User?</a>
					</div>
				</form>	
			</div>
		</div>
	</body>
</html>