<?php
	session_start();
	require_once "config.php";
	if(!isset($_SESSION['user_id'])){
	    header("Location: login.php");
	}
	if (isset($_POST['submit']) && isset($_FILES['ifile'])) {
		$rname = mysqli_real_escape_string($conn, $_POST['recipename']);
		$rtype = mysqli_real_escape_string($conn, $_POST['rtype']);
		$preptime= mysqli_real_escape_string($conn, $_POST['preptime']);
		$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']); 
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$img_name = $_FILES['ifile']['name'];
		$itmp_name = $_FILES['ifile']['tmp_name'];
		$error = $_FILES['ifile']['error'];
		$vid_name = $_FILES['vfile']['name'];
		$vtmp_name = $_FILES['vfile']['tmp_name'];
		if($error === 0) {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$vid_ex = pathinfo($vid_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
			$vid_ex_lc = strtolower($vid_ex);
			$allowed_exs = array("jpg", "jpeg", "png"); 
			if (in_array($img_ex_lc, $allowed_exs) && $vid_ex_lc == "mp4") {
				$i_dest = 'images/'.$img_name;
				$v_dest = "videos/".$vid_name;
				move_uploaded_file($itmp_name, $i_dest);
				move_uploaded_file($vtmp_name, $v_dest);
				if(mysqli_query($conn, "INSERT INTO recipe(rname, rtype, preptime,ingredients,description,image_url,video_url) VALUES('" . $rname . "', '" . $rtype . "', '" . $preptime . "', '" . $ingredients . "', '" . $description . "', '" . $img_name . "', '" . $vid_name ."')")){
					$last_id = mysqli_insert_id($conn);
					if(mysqli_query($conn, "INSERT INTO connect(uid, rid) VALUES('" . $_SESSION['user_id'] . "', '" . $last_id . "')")){
?>
						<script>
							window.location.replace("dashboard.php");
			                alert("<?php echo "Recipe Created"?>");
						</script>
<?php
					}else{
						echo "Error : mysqli_error($error)";
					}				
				} else {
?>
					<script>
						window.location.replace("recipe.php");
		                alert("<?php echo "Error: Failed to Create the Recipe"?>");
					</script>
<?php
				}
			}else {
?>
				<script>
					window.location.replace("recipe.php");
	                alert("<?php echo "You can't upload files of this type"?>");
				</script>
<?php
			}
		}else {
?>
			<script>
				window.location.replace("recipe.php");
                alert("<?php echo "Unknown Error Occurred!"; ?>");
			</script>
<?php
		}
		mysqli_close($conn);
	}
?>
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
			body{
                background: rgba(99, 39, 120, 0.9);
                font-weight: bold;
				overflow-x: hidden;
			}
			.nav-item{
                background: rgba(255, 255, 255, 0.3);
                border-radius: 10px;
            }
			input[type=text], input[type=number], select, textarea{
				border: 2px solid red;
			    border-radius: 4px;
			    background: none;
			}
			input[type=file]::-webkit-file-upload-button{
				font-family: times new roman;
				font-weight: bold;
				background: whitesmoke;
				border-radius: 30px;
			}
			input[type=file]{
				color: whitesmoke;
			}
			h1{
				font-family: 'Koulen', cursive;
				text-decoration: underline;
			}
			form{
				background: rgba(235, 235, 235, 0.5);
				width: 500px;
				border-radius: 10%;
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
		<div class="container text-center">
			<form method="post" class="mx-auto" enctype="multipart/form-data">
				<h1>Create Recipe</h1>
				<div class="recipeform" style="top: 300px">
					<label for="name">Recipe name&nbsp;&nbsp;</label>
					<input type="text" name="recipename" id="name" required><br><br>
					<label for="type">Choose your type&nbsp;&nbsp;</label>
					<select name="rtype" id="type">
						<option value="Veg">Veg</option>
						<option value="Non-Veg">Non-Veg</option>
					</select><br><br>
					<label for="time">preparation time&nbsp;&nbsp;</label>
					<input type="number" name="preptime" id="time" required><br><br>
					<label>Ingredients </label><br><textarea name="ingredients" rows="4" cols="50" required></textarea><br><br>
					<label>Description </label><br><textarea name="description" rows="7" cols="50" required></textarea><br><br>
					<label>Upload Image&nbsp;</label><input type="file" name="ifile" required><br>
					<label class="mt-3">Upload Video&nbsp;</label><input type="file" name="vfile" required><br><br>
				</div>
				<div class="btns">
					<input type="submit" name="submit" value="Create" style="padding: 8px; margin: 3px; border-radius: 5px;">
				</div>	
			</form>
		</div>
	</body>
</html>