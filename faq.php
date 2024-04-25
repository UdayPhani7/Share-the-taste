<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share The Taste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="text/css" href="images/img/favicon.ico">
    <style>
      body{
        background: rgb(99, 39, 120)
      }
      .nav-item{
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
      }
      .accordion {
        background-color: rgb(200, 150, 200);
        color: #111;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 18px;
        transition: 0.4s;
      }
      .active, .accordion:hover {
        background-color: #aaa;
        font-family: verdana;
      }
      .accordion:after {
        content: '\002B';
        color: #000;
        font-weight: bold;
        float: right;
        margin-left: 5px;
      }
      .active:after {
        content: "\2212";
      }
      .panel {
        padding: 0 18px;
        background-color: white;
        color: black;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-out;
      }
      .panel p{
        font-family: verdana;
      }
      .navbar-toggler {
        background-color: rgba(0, 0, 0, 0.2);
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
    <div class="container mt-4 pt-5 px-5">
      <h2 class="text-white">Frequently Asked Questions</h2>
      <button class="accordion text-white">How to create a recipe?</button>
      <div class="panel">
        <p>After logging in,you will find a button named create recipe.By clicking the button create recipe page will be displayed.You can create recipie by filling the details and adding your recipe video.</p>
      </div>
      <button class="accordion text-white">How to change password?</button>
      <div class="panel">
        <p>
          1.Click on forget password.<br>
          2.Then enter your email address.<br>
          3.You will recieve an link regarding changing password to your given mail.<br>
          4.By clicking on link,it directs to change password.<br>
          5.Create your new password.
        </p>
      </div>
      <button class="accordion text-white">How to contact helpline?</button>
      <div class="panel">
        <p>In home page,you will find contact us button.You can contact us through different social media which are given in contact us page.</p>
      </div>
      <button class="accordion text-white">How to edit our profile?</button>
      <div class="panel">
        <p>In dashboard,you will find view profile button.by clicking it you can view your profile.Edit profile option will be given there.</p>
      </div>
    </div>
    <script>
      var acc = document.getElementsByClassName("accordion");
      var i;
      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          } 
        });
      }
    </script>
  </body>
</html>