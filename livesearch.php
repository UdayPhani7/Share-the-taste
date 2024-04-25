<html>
	<body>
		<div>
			<h4 style="font-weight:bold;">Search Result: </h4>
        	<ul style="list-style-type: none;">
<?php
				session_start();
				require_once "config.php";
				if(isset($_POST['input'])) {
					$input = $_POST['input'];
					$uid = $_SESSION['user_id'];
					$query = "SELECT * FROM recipe where rid in (SELECT rid FROM connect where uid != '{$uid}') and rname like '%{$input}%' ORDER BY rid DESC LIMIT 10";
					$result = mysqli_query($conn,  $query);
					if (mysqli_num_rows($result) > 0) {
			            while ($images = mysqli_fetch_assoc($result)) {  
			             	$sql = "SELECT * FROM users where uid in (SELECT uid FROM connect where rid = " . $images['rid'] .");";
			            	$user = mysqli_fetch_assoc(mysqli_query($conn,$sql));
?>
			            	<a href="viewrecipe.php?id=<?php echo $images['rid'] ?>&u=<?php echo $user['uid'] ?>"><li class="rbox"><img src="images/<?=$images['image_url'] ?>" width="180px" height="180px"><br>
			            	<span><b><u><?php echo $images['rname'] ?></u></b></span><br>
			            	<span><small><?php echo"-by ".$user['name'] ?></small></span></li></a>
<?php
			            } 
			        }
				}
?>
			</ul>
		</div>
	</body>
</html>