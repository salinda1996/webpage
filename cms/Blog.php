<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/PublicStyle.css">
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
          <li class="active"> <a href="Blog.php">BLOG </a> </li>
          <li> <a href="#">ABOUT US </a> </li>
          <li> <a href="#">SERVICES </a> </li>
          <li> <a href="#">CONTACT US </a> </li>
          <li> <a href="#">FEATURE </a> </li>
        </ul>
        <form class="navbar-form navbar-right " action="blog.php">
          <div class="form-group">
            <input type="text" name="Search" placeholder="Search" class="form-control">
          </div>
          <button type="submit" name="SearchButton" class="btn btn-default">Go</button>
        </form>
      </div><!--ending of collapse navbar-collapse-->
      </div>
    </nav>
    <div style="height: 5px; background: #27aae1;" class="Line"> </div><!--hr-->
<div class="container">
<div class="blog-header">
  <h1>The Complete Resposive CMS Blog</h1>
  <p>The Complete blog using php by Anil Salinda  </p>
</div><!--ending blog-header-->
  <div class="row">
      <div class="col-sm-8"><!--begining of side bar-->
        <?php
        if (isset($_GET["SearchButton"])) {
          $search=$_GET["Search"];
          $res=mysqli_query($link,"SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR
          title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'");
        }else{
        $res=mysqli_query($link,"SELECT * FROM admin_panel ORDER BY datetime DESC LIMIT 0,5");}

        while ($row=mysqli_fetch_array($res)) {
          $postid=$row["id"];
          $datetime=$row["datetime"];
          $title=$row["title"];
          $category=$row["category"];
          $admin=$row["author"];
          $image=$row["image"];
          $post=$row["post"];
          ?>
          <div class="blogpost thumbnail">
            <img class="img-responsive img-rounded" src="upload/<?php echo $image; ?>" >
            <div class="caption">
                <h1 id="heading"><?php echo htmlentities($title); ?></h1>
                <p id="description">Category: <?php echo htmlentities($category); ?> &nbsp Published On: <?php echo htmlentities($datetime); ?></p>
                <p><?php
                    if (strlen($post)>150) {
                      $post=substr($post,0,150).'...';
                    }

                echo $post;
                ?></p>
            </div>
            <a href="FullBlog.php?id=<?php echo $postid; ?>"><span class="btn btn-info"> Read More &rsaquo; &rsaquo; </span>
          </div>

      <?php  } ?>

      </div>
      <div class="col-sm-offset-1 col-sm-3">
        <h1>Test</h1>
      </div>
  </div>
</div><!--ending container-->


<div id="footer">
  <hr><p>Theme by | Anil Salinda |&copy; 2020-2025 --- All right reserved </p>
  <hr>
</div>
  </body>
</html>
