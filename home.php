<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Share the Taste</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="icon" type="text/css" href="images/img/favicon.ico">
		<style type="text/css">
			.title h1{
				color: whitesmoke;
				font-size: 70px;
				font-family: new times roman;
				text-shadow: 2px 2px 8px #FF0000;
			}
			.title h2{
				color: whitesmoke;
				font-size: 50px;
				text-shadow: 1px 1px 1px whitesmoke;
			}
			.title h4{
				color: whitesmoke;
				font-size: 30px;
				text-shadow: 1px 1px 1px whitesmoke;
			}
			.button{
				position: absolute;
				left: 50%;
				transform: translate(-50%,-50%);
			}
			.btn{
				border: 1px solid whitesmoke;
				padding: 10px 30px;
				color: whitesmoke;
				text-decoration: none;
				transition: 0.3s ease;

			}
			.btn:hover{
				background-color: whitesmoke;
				color: black;
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
		              		<a class="nav-link active" href="#">Home</a>
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
		<div class="title container-fluid text-center">
			<h1><u>SHARE THE TASTE</u></h1>
			<h2>Learn.Cook.Share.<br>
			Cooking Made Easy.</h2>
			<h4>Say good bye to long frustating <br>
			food blogs and recipe videos. Access <br>our recipe cards to prepare any dish in minutes</h4><br>
		</div>
		<div class="button">
			<a href="signup.php" class="btn">GET STARTED</a>
		</div>
		<div class="pt-5">
			<label>&nbsp;</label>
		</div>
	</body>
</html>