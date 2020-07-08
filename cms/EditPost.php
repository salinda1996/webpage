<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_POST["submit"])) {
  $CurrentTime=time();
  $DateTime=strftime("%B -%d -%Y %H:%M",$CurrentTime);
  $title=$_POST["Title"];
  $category=$_POST["category"];
  $admin=$_SESSION["Username"];
  $image=$_FILES["Image"]["name"];
  $target="upload/".basename($image);
  $post=$_POST["Post"];


  if (empty($title)) {
    $_SESSION["ErrorMessage"]="All Field Must Be Field Out";
    Redirect_to("categories.php");
    }else{
      $EditFromUrl=$_GET['Edit'];
      mysqli_query($link,"UPDATE admin_panel SET datetime='$DateTime', title='$title', category='$category', author='$admin',
        image='$image', post='$post' WHERE id='$EditFromUrl'");
      move_uploaded_file($_FILES["Image"]["tmp_name"],$target);
    $_SESSION["SuccessMessage"]="Post Updated Succesfully";
    Redirect_to("Dashboard.php");
}}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Post</title>
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
            <li class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>
            &nbsp; Add New Post</a></li>
            <li ><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>
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
          <h1>Update Post</h1>
          <?php echo message();
                echo SuccessMessage();
          ?>
          <div>
            <?php
            $EditQueryParamiter=$_GET['Edit'];
            $res=mysqli_query($link,"SELECT * FROM admin_panel WHERE id='$EditQueryParamiter' ");
            while ($row=mysqli_fetch_array($res)) {
              $TitleToBeUpdated=$row["title"];
              $CategoryToBeUpdated=$row["category"];
              $admin=$row["author"];
              $ImageToBeUpdated=$row["image"];
              $PostToBeUpdated=$row["post"];
            }
             ?>
            <form action="EditPost.php?Edit=<?php echo $EditQueryParamiter; ?>" method="post" enctype="multipart/form-data">
              <fieldset>
                <div class="form-group">
                  <label for="Tile"> Title:</label>
                  <input class="form-control" type="text" name="Title" id="title" value="<?php echo $TitleToBeUpdated ?>" placeholder="Title">
                </div>
                <div class="form-group">
                  <span> Existing Category</span>
                  <?php echo $CategoryToBeUpdated ?>
                  <br>
                  <label for="categoryselect"> Category:</label>
                  <select class="form-control" name="category" id="categoryselect">
                    <?php
                    $res=mysqli_query($link,"SELECT * FROM category ORDER BY id DESC");
                    while ($row=mysqli_fetch_array($res)) {
                    echo "<option>";
                    echo $row["name"];;
                    echo "</option>";
                  }
                     ?>
                  </select>
                </div>
                <div class="form-group">
                  <span> Existing Image</span>
                  <img src="upload/<?php echo $ImageToBeUpdated;?>" width=130px; height=70px;>
                  <br>
                  <label for="imageselect"> Select Image:</label>
                  <input type="file" name="Image" id="imageselect" class="form-control">
                </div>
                <div class="form-group">
                  <label for="postarea"> Post: </label>
                  <textarea name="Post" id="postarea" class="form-control" rows="8" cols="80" ><?php echo $PostToBeUpdated ?>"</textarea>
                </div>
                <br>
                <input class="btn btn-success btn-block " type="submit" name="submit" value="Update Post">
                <br>
              </fieldset>
            </form>
          </div>
          <div class="table-responsive">

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
