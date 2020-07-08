<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_POST["submit"])) {
  // $link=mysqli_connect("localhost","root","");
  // mysqli_select_db($link,"phpcms");
  $UserName=$_POST["UserName"];
  $Password=$_POST["Password"];
  $ConfirmPassword=$_POST["ConfirmPassword"];
  $CurrentTime=time();
  $DateTime=strftime("%B -%d -%Y %H:%M",$CurrentTime);
  $admin=$_SESSION["Username"];
  if (empty($UserName)||empty($Password)||empty($ConfirmPassword)) {
    $_SESSION["ErrorMessage"]="All Field Must Be Field Out";
    Redirect_to("ManageAdmins.php");

  }elseif (strlen($Password)<4) {
      $_SESSION["ErrorMessage"]="Atleast 4 Characters For Password Are Required";
      Redirect_to("ManageAdmins.php");
    }elseif ($Password!==$ConfirmPassword) {
      $_SESSION["ErrorMessage"]="Password / Confirm Password Did Not Match";
      Redirect_to("ManageAdmins.php");
    }else{
      mysqli_query($link,"INSERT INTO registration VALUES ('','$DateTime','$UserName','$Password','$admin')");
      $_SESSION["SuccessMessage"]="Admin Added Succesfully";
      Redirect_to("ManageAdmins.php");
}}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Admins</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/AdminStyle.css">
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
        <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
          <li> <a href="#">HOME </a> </li>
          <li > <a href="Blog.php" target="_blank">BLOG </a> </li>
          <li> <a href="#">ABOUT US </a> </li>
          <li> <a href="#">SERVICES </a> </li>
          <li> <a href="#">CONTACT US </a> </li>
          <li> <a href="#">FEATURE </a> </li>
        </ul>
        <form class="navbar-form navbar-right " action="Blog.php">
          <div class="form-group">
            <input type="text" name="Search" placeholder="Search" class="form-control">
          </div>
          <button type="submit" name="SearchButton" class="btn btn-default">Go</button>
        </form>
      </div><!--ending of collapse navbar-collapse-->
      </div>
    </nav>
    <div style="height: 5px; background: #27aae1;" class="Line"> </div><!--ending of nav bar-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2">
          <ul id="side_menu" class="nav nav-pills nav-stacked">
            <li><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
            &nbsp; Dashboard</a></li>
            <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>
            &nbsp; Add New Post</a></li>
            <li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>
            &nbsp; Categories</a></li>
            <li class="active"><a href="ManageAdmins.php"><span class="glyphicon glyphicon-user"></span>
            &nbsp; Manage Admins</a></li>
            <li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>
            &nbsp; Comments</a></li>
            <li><a href="Blog.php" target="_blank"><span class="glyphicon glyphicon-equalizer"></span>
            &nbsp; Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>
            &nbsp; Logout</a></li>
          </ul>
        </div><!--Ending of side area -->

        <div class="col-sm-10">

          <h1>Manage Admins</h1>
          <?php echo message();
                echo SuccessMessage();
          ?>

          <div>
            <form class="" action="ManageAdmins.php" method="post">
              <fieldset>
                <div class="form-group">
                  <label for="UserName" class="FieldInfo"> Username:</label>
                  <input class="form-control" type="text" name="UserName" id="UserName" value="" placeholder="Username">
                </div>
                <div class="form-group">
                  <label for="Password" class="FieldInfo"> Password:</label>
                  <input class="form-control" type="password" name="Password" id="Password" value="" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="ConfirmPassword" class="FieldInfo">Confirm Password:</label>
                  <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" value="" placeholder="Re Enter Same Password">
                </div>
                <br>
                <input class="btn btn-success btn-block " type="submit" name="submit" value="Add New Admin">
                <br>
              </fieldset>
            </form>
          </div>
          <div class="table-responsive">
            <?php
            $res=mysqli_query($link,"SELECT * FROM registration ORDER BY id DESC");
            echo "<table class=\"table table-striped table-hover\">";
            echo "<tr>";
            echo "<th>"; echo "Sr No."; echo "</th>";
            echo "<th>"; echo "Date"; echo "</th>";
            echo "<th>"; echo "Username"; echo "</th>";
            echo "<th>"; echo "AddedBy"; echo "</th>";
            echo "<th>"; echo "Action"; echo "</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($res)) {
              $id=$row["id"];
            echo "<tr>";
            echo "<td>";  echo $id;; echo "</td>";
            echo "<td>";  echo $row["datetime"]; echo "</td>";
            echo "<td>";  echo $row["username"]; echo "</td>";
            echo "<td>";  echo $row["addedby"]; echo "</td>";
            echo "<td>"; echo "<a href=\"DeleteAdmin.php?id=$id\"<sapn class=\"btn btn-danger\">Delete </span></a>"; echo "</td>";
            echo "</tr>";
            }
            echo "</table>";
             ?>
          </div>
        </div><!--Ending of Main Area-->
      </div> <!--Ending of Row-->
    </div><!--Ending of Container-->
    <div id="footer">
      <hr><p>Theme by | Anil Salinda |&copy; 2020-2025 --- All right reserved </p>
      <hr>
    </div>
  </body>
</html>
