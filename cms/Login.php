<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php

if (isset($_POST["submit"])) {
  $UserName=$_POST["UserName"];
  $Password=$_POST["Password"];
  if (empty($UserName)||empty($Password)) {
    $_SESSION["ErrorMessage"]="All Field Must Be Field Out";
    Redirect_to("login.php");

  }else{
    $count=0;
    $res=mysqli_query($link,"SELECT * FROM registration WHERE UserName='$UserName' AND Password='$Password'");
    $count=mysqli_num_rows($res);
    while ($row=mysqli_fetch_array($res)) {
      $id=$row["id"];
    }

    if ($count==0) {
      $_SESSION["ErrorMessage"]="Invalid Username or Password";
      Redirect_to("login.php");
    }else {
      $_SESSION["SuccessMessage"]="Welcome $UserName";
      $_SESSION["User_ID"]=$id;
      $_SESSION["Username"]=$UserName;
      Redirect_to("Dashboard.php");
    }
}}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/AdminStyle.css">
    <style media="screen">
      body{
        background-color: #ffffff;
      }
    </style>
  </head>
  <body>
    <div style="height: 5px; background: #27aae1;"> </div><!--hr-->
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="blog.php">
            <!-- <img src="image/a.png" style="margin-top: -5px" width=200px; height=30px;> -->
          </a>
        </div>
      </div>
    </nav>
    <div style="height: 5px; background: #27aae1;" class="Line"> </div><!--ending of nav bar-->``
    <div class="container-fluid">
      <div class="row">
        <br><br><br><br>
        <div class="col-sm-offset-4 col-sm-4">

          <h2>Welcome Back !</h2>
          <?php echo message();
                echo SuccessMessage();
          ?>

          <div>
            <form class="" action="#" method="post">
              <fieldset>
                <div class="form-group">
                  <label for="UserName" class="FieldInfo"> Username:</label>
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-envelope text-info"></span>
                    </span>
                  <input class="form-control" type="text" name="UserName" id="UserName" value="" placeholder="Username">
                </div>
                </div>
                <div class="form-group">
                  <label for="Password" class="FieldInfo"> Password:</label>
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-lock text-info"></span>
                    </span>
                  <input class="form-control" type="password" name="Password" id="Password" value="" placeholder="Password">
                </div>
                </div>
                <br>
                <input class="btn btn-info btn-block btn-lg" type="submit" name="submit" value="Add New Admin">
                <br>
              </fieldset>
            </form>
          </div>

        </div><!--Ending of Main Area-->
      </div> <!--Ending of Row-->
    </div><!--Ending of Container-->
    <br><br><br><br>
    <div id="footer">
      <hr><p>Theme by | Anil Salinda |&copy; 2020-2025 --- All right reserved </p>
      <hr>
    </div>
  </body>
</html>
