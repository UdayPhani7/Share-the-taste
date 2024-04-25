<?php
    session_start();
    require_once "config.php";
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
    $uid = $_SESSION['user_id'];
    $query1=mysqli_query($conn,"SELECT * FROM users where uid='$uid'") or die(mysqli_error());
    $row=mysqli_fetch_array($query1);
    if (isset($_POST['saveprofile']))
    {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
		$flag=0;
        if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$name_error = "Name must contain only alphabets and space";
			$flag=1;
		}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$email_error = "Please Enter Valid Email ID";
			$flag=1;
		}
        if($flag == 0 &&mysqli_query($conn,"UPDATE users SET name = '" . $name . "', phone = '" . $phone . "', email = '" . $email . "', bio = '" . $bio . "' where uid = '" . $uid . "';")) {
?>
            <script>
                window.location.replace("profile.php");
                alert("<?php echo "Saved Profile"?>");
            </script>
<?php
        }
    }
?>
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="icon" type="text/css" href="images/img/favicon.ico">
        <title>Share The Taste</title>
        <style>
            body {
                background: rgb(99, 39, 120)
            }
            .form-control:focus {
                box-shadow: none;
                border-color: #BA68C8
            }
            .labels {
                font-size: 15px
            }
            .nav-item{
                background: rgba(255, 255, 255, 0.3);
                border-radius: 10px;
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
        <div class="container rounded bg-white mt-4 mb-5">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="images/img/profilepic.png"><br>
                        <span class="font-weight-bold"><?php echo $row['name']; ?></span><br>
                        <span class="text-black-50"><?php echo $row['email']; ?></span>
                            <span></span>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4><hr>
                        </div>
                        <p class="text-danger" id="danger">
<?php
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
                        <form method="post">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo $row['name']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="<?php echo $row['phone']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email ID</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter email-id" value="<?php echo $row['email']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Bio</label>
                                    <input type="text" name="bio" class="form-control" placeholder="About you" value="<?php echo $row['bio']; ?>">
                                </div>
                                <div class="mt-5 text-center">
                                    <input type="submit" name="saveprofile" value="Save Profile">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container recipes rounded bg-white mt-5 mb-5">
            <h3>Your Recipes</h3>
            <div>
                <br>
                <ul style="list-style-type: none;">
<?php
                        $query2 = "SELECT * FROM recipe where rid in (SELECT rid FROM connect where uid = '$uid')";
                        $res = mysqli_query($conn,  $query2);
                        if (mysqli_num_rows($res) > 0) {
                            while ($images = mysqli_fetch_assoc($res)) {  
?>
                                <a href="viewrecipe.php?id=<?php echo $images['rid'] ?>&u=<?php echo $row['uid'] ?>"><li class="rbox"><img src="images/<?=$images['image_url']?>" width="180px" height="180px">
                                <?php echo "<br>".$images['rname'];?></li></a>
<?php
                            } 
                        }
?>
                </ul>
                <br>
            </div>
        </div>
    </body>
</html>