<?php
	require_once "config.php";
	session_start();
	if(!isset($_SESSION['user_id'])){
	    header("Location: login.php");
	}
	if(isset($_GET['id']) && isset($_GET['u'])) {
		$rec = mysqli_query($conn, "SELECT * FROM recipe where rid = '" . $_GET['id'] . "';");
	    $dish = mysqli_fetch_assoc($rec);
	    $user = mysqli_query($conn, "SELECT * FROM users where uid = '" . $_GET['u'] . "';");
	    $row = mysqli_fetch_assoc($user);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
    	<link rel="icon" type="text/css" href="images/img/favicon.ico">
		<title>Share The Taste</title>
		<style type="text/css">
			body {
		       	background: linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0)), url(images/img/fdo1.jpg);
		    }
		    .nav-item{
		        background: rgba(0, 0, 0, 0.5);
		        border-radius: 10px;
		    }
	    	.des,.ing{
	    		max-height: 220px;
	    		overflow: scroll;
	    	}
	    	.navbar-toggler {
				background-color: rgba(0, 0, 0, 0.3);
	    	}
	    	.des::-webkit-scrollbar{
    			width: 0px;
			}
			.ing::-webkit-scrollbar{
    			width: 0px;
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
	              				<a class="nav-link text-white" href="dashboard.php">Dashboard<br><label>&nbsp;</label></a>
	            			</li>
	        			    	<li class="nav-item">
	              				<a class="nav-link text-white" href="profile.php">View Profile</a>
	            			</li>
	            			<li class="nav-item">
	              				<a class="nav-link text-white" href="recipe.php">Create Recipe</a>
	            			</li>
	            			<li class="nav-item">
	              				<a class="nav-link text-white" href="faq.php">FAQ<br><label>&nbsp;</label></a>
	            			</li>
	          			</ul>
	        		</div>
	      	</div>
	    	</nav>
	    	<div class="row">
	    		<div class="col-md-3 ps-4">
	    			<img src="images/<?=$dish['image_url'] ?>" class="image" width="280px" height="280px">
	    		</div>
	    		<div class="col-md-4 ps-4">
		    		<h2 class="recipe"><?php echo $dish['rname'] ?></h2>
		    		<h3 class="preptime">Preparation Time : <?php echo $dish['preptime'] ?>m</h3>
		    		<h3 class="type"><?php echo $dish['rtype'] ?></h3>
		    		<div class="creator row align-bottom ps-3">
<?php
	    				if($_SESSION['user_id'] === $_GET['u']) {
?>
	        				<a href="profile.php" class="col-sm-3"><img src="images/img/user.png" width="100px" height="100px"></a>
<?php
	      			}else {
?>
	        				<a href="other.php?id=<?php echo $_GET['u'] ?>" class="col-sm-3"><img src="images/img/user.png" width="100px" height="100px"></a>
<?php
					}
?>
		    			<span class="col-sm-9  pt-2 ps-2">
		    				<h5>by - </h5>
		    				<h3><?php echo $row['name'] ?></h3>
		    			</span>
		    		</div>
		    	</div>
		    	<div class="col-md-5 ps-4">
		    		<h1>INGREDIENTS</h1>
		    		<p class="ing container-fluid"><?php echo $dish['ingredients'] ?></p>
		    	</div>
	    	</div>
	    	<div class="row px-5 mt-3">
	    		<div class="col-md-6">
	    			<h1>DESCRIPTION</h1>
	    			<p class="des container-fluid"><?php echo $dish['description'] ?></p>
	    		</div>
	    		<div class="vid col-md-6 px-5">
			        <video width="500" height="300" controls>
			            <source src="videos/<?=$dish['video_url'] ?>" type="video/mp4">
			            Your browser does not support the video tag.
			        </video>
	    		</div>
	    	</div>
	</body>
</html>