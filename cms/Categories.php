<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_POST["submit"])) {
  $link=mysqli_connect("localhost","root","");
  mysqli_select_db($link,"phpcms");
  $CurrentTime=time();
  $DateTime=strftime("%B -%d -%Y %H:%M",$CurrentTime);
  $admin=$_SESSION["Username"];
  $category=$_POST["category"];
  echo $category;
  if (empty($category)) {
    $_SESSION["ErrorMessage"]="All Field Must Be Field Out";
    Redirect_to("categories.php");
  }if (strlen($category)>99) {
    $_SESSION["ErrorMessage"]="Too Long Name For Category ";
    Redirect_to("categories.php");
  }else{
      $query="INSERT INTO category VALUES ('','$DateTime','$category','$admin')";
      if( mysqli_query($link,$query)) {
        $_SESSION["SuccessMessage"]="Category Added Succesfully";
        Redirect_to("Categories.php");
    }else {
      $_SESSION["ErrorMessage"]="Category Added Failed";
      Redirect_to("categories.php");
    }


}}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Category</title>
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
            <li class="active"><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>
            &nbsp; Categories</a></li>
            <li><a href="ManageAdmins.php"><span class="glyphicon glyphicon-user"></span>
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

          <h1>Manage Categories</h1>
          <?php echo message();
                echo SuccessMessage();
          ?>

          <div>
            <form class="" action="Categories.php" method="post">
              <fieldset>
                <div class="form-group">
                  <label for="CategoryName"> Category Name:</label>
                  <input class="form-control" type="text" name="category" id="CategoryName" value="" placeholder="Category Name">
                </div>
                <br>
                <input class="btn btn-success btn-block " type="submit" name="submit" value="Add New Category">
                <br>
              </fieldset>
            </form>
          </div>
          <div class="table-responsive">
            <?php
            $res=mysqli_query($link,"SELECT * FROM category ORDER BY id DESC");
            echo "<table class=\"table table-striped table-hover\">";
            echo "<tr>";
            echo "<th>"; echo "Sr No."; echo "</th>";
            echo "<th>"; echo "Date"; echo "</th>";
            echo "<th>"; echo "Category Name"; echo "</th>";
            echo "<th>"; echo "Creater Name"; echo "</th>";
            echo "<th>"; echo "Action"; echo "</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($res)) {
              $id=$row["id"];
            echo "<tr>";
            echo "<td>";  echo $id;; echo "</td>";
            echo "<td>";  echo $row["datetime"]; echo "</td>";
            echo "<td>";  echo $row["name"]; echo "</td>";
            echo "<td>";  echo $row["creatername"]; echo "</td>";
            echo "<td>"; echo "<a href=\"DeleteCategory.php?id=$id\"<sapn class=\"btn btn-danger\">Delete </span></a>"; echo "</td>";
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
