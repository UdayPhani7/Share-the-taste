<?php
  require_once "config.php";
  session_start();
  if(!isset($_SESSION['user_id'])){
      header("Location: login.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="text/css" href="images/img/favicon.ico">
    <style type="text/css">
      body {
        background-image: url('images/img/bgfood.jpg');
      }
      .nav-item{
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
      }
      .navbar-toggler {
        background-color: rgba(0, 0, 0, 0.2);
      }
      .head{
        font-family: Century Gothic
      }
      .h11{
        text-align: center;
        font-size: 25px;
      }
      .search-box{
        position: absolute;
        top: 22%;
        left: 47%;
        transform: translate(-50%,-50%);
        background: #2f3640;
        height: 40px;
        border-radius: 40px;
        padding: 10px;
      }
      .search-box:hover > .search-txt{
        width: 240px;
        padding: 0 6px;
      }
      .search-box:hover > .search_btn{
        display: none;
      }
      .search-txt{
        border: none;
        background: none;
        outline: none;
        float: left;
        padding: 0;
        color: whitesmoke;
        font-size: 16px;
        transition: 0.4s;
        line-height: 20px;
        width: 0;
      }
      .search_btn{
        background: none;
        border: none;
      }
      .recipes{
        position: absolute;
        top: 28%;
        left: 10%;
        background: rgba(0, 0, 0, 0.1);
        width: 80%;
        border: 1px solid none;
        border-radius: 25px;
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
              <a class="nav-link text-dark" href="dashboard.php">Home<br><label>&nbsp;</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="profile.php">View Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="recipe.php">Create Recipe</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" href="faq.php">FAQ<br><label>&nbsp;</label></a>
            </li>
            <a href="logout.php" class="log-out" style="background: rgba(255, 255, 255, 0.3);border-radius: 10px;"><li class="nav-item">
              <img src="images/img/log-out.png" class="logout my-3" alt="logout">
            </li></a>
          </ul>
        </div>
      </div>
    </nav>
    <form>
      <div class="h11">
        <h1 style="font-family: 'Montserrat', sans-serif;">Search your recipes here</h1>
      </div>
      <div class="search-box" style="top: 280px; left: 50%;">
        <input class="search-txt" name="search_text" type="text" id="live-search" placeholder="Search...">
        <button type="submit" name="search" class="search_btn">
          <img src="images/img/search.png" width="20px" height="20px">
        </button>
      </div>
    </form>
    <div class="container recipes" id="con" style="top: 45%">
      <div>
        <ul style="list-style-type: none;">
          <h4 style="font-weight: bold;">Suggestions : </h4>
<?php
          $query2 = "SELECT * FROM recipe where rid in (SELECT rid FROM connect where uid != " . $_SESSION['user_id'] . ") ORDER BY rid DESC LIMIT 10;";
          $res = mysqli_query($conn,  $query2);
          if (mysqli_num_rows($res) > 0) {
            while ($images = mysqli_fetch_assoc($res)) {  
              $sql = "SELECT * FROM users where uid in (SELECT uid FROM connect where rid = " . $images['rid'] .");";
              $user = mysqli_fetch_assoc(mysqli_query($conn,$sql));
?>
              <a href="viewrecipe.php?id=<?php echo $images['rid'] ?>&u=<?php echo $user['uid'] ?>"><li class="rbox"><img src="images/<?=$images['image_url'] ?>" width="180px" height="180px"><br>
              <span><b><u><?php echo $images['rname'] ?></u></b></span><br>
              <span><small><?php echo"-by ".$user['name'] ?></small></span></li></a>
<?php
            } 
          }
?><br>
        </ul>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#live-search").keyup(function(){
          var input = $(this).val();
          if(input != ""){
            $.ajax({
              url:"livesearch.php",
              method:"POST",
              data:{input:input},
              success:function(data){
                $("#con").html(data);
              }
            });
          }else{
            $("#con").html($("#con"));
          }
        });
      });
    </script>
  </body>
</html>