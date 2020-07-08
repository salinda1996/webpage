<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
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
            <li class="active"><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
            &nbsp; Dashboard</a></li>
            <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>
            &nbsp; Add New Post</a></li>
            <li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>
            &nbsp; Categories</a></li>
            <li><a href="ManageAdmins.php"><span class="glyphicon glyphicon-user"></span>
            &nbsp; Manage Admins</a></li>
            <li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>
            &nbsp; Comments <?php

            $QueryTotal=mysqli_query($link,"SELECT COUNT(*) FROM comments WHERE status='OFF'");
            $RowsTotal = mysqli_fetch_array($QueryTotal, MYSQLI_NUM);
            $TotalDisApproved=array_shift($RowsTotal);


            if ($TotalDisApproved>0) {
               echo "<span class=\"label pull-right label-warning\">"; echo $TotalDisApproved;   echo "</span>";
            }
            ?>

            </a></li>
            <li><a href="Blog.php" target="_blank"><span class="glyphicon glyphicon-equalizer"></span>
            &nbsp; Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>
            &nbsp; Logout</a></li>
          </ul>
        </div><!--Ending of side area -->

                  <div class="col-sm-10">

                    <h1>Admin Dashboard</h1>
                    <?php echo message();
                          echo SuccessMessage();
                    ?>
                    <div class="table-responsive">
                        <?php
                        $res=mysqli_query($link,"SELECT * FROM admin_panel ORDER BY id DESC ");
                        echo "<table class=\"table table-striped table-hover\">";
                        echo "<tr>";
                        echo "<th>"; echo "No."; echo "</th>";
                        echo "<th>"; echo "Post Title"; echo "</th>";
                        echo "<th>"; echo "Date & Time"; echo "</th>";
                        echo "<th>"; echo "Author"; echo "</th>";
                        echo "<th>"; echo "Category "; echo "</th>";
                        echo "<th>"; echo "Banner"; echo "</th>";
                        echo "<th>"; echo "Comments"; echo "</th>";
                        echo "<th>"; echo "Action"; echo "</th>";
                        echo "<th>"; echo "Details"; echo "</th>";
                        echo "</tr>";
                        $srNo=0;
                        while ($row=mysqli_fetch_array($res)) {
                          $srNo++;
                          echo "<tr>";
                          //Sr No
                          echo "<td>"; echo $srNo; echo "</td>";
                          //Titlr
                          $title=$row["title"];
                          if (strlen($title)>20) {$title=substr($title,0,20)."...";}
                          echo "<td style=\" color: #5e5eff;\">"; echo $title; echo "</td>";
                          //datetime
                          $datetime=$row["datetime"];
                          if (strlen($title)>11) {$title=substr($title,0,11)."...";}
                          echo "<td>"; echo $datetime; echo "</td>";
                          //author
                          $author=$row["author"];
                          if (strlen($title)>6) {$title=substr($title,0,6)."...";}
                          echo "<td>"; echo $author; echo "</td>";
                          ///category
                          $category=$row["category"];
                          if (strlen($title)>8) {$title=substr($title,0,8)."...";}
                          echo "<td>"; echo $category; echo "</td>";
                          //image
                          $image=$row["image"];
                          echo "<td>"; echo "<img src=\"upload/$image\" width=100px; height=50px;"; echo "</td>";


                          //comment
                          echo "<div>";
                          echo "<td>";
                          $id=$row["id"];
                          $QueryDisApproved=mysqli_query($link,"SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='OFF'");
                          $RowsDisApproved = mysqli_fetch_array($QueryDisApproved, MYSQLI_NUM);
                          $TotalDisApproved=array_shift($RowsDisApproved);


                          if ($TotalDisApproved>0) {
                             echo "<span class=\"label pull-left label-danger\">"; echo $TotalDisApproved;   echo "</span>";
                          }

                          $QueryApproved=mysqli_query($link,"SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='ON'");
                          $RowsApproved = mysqli_fetch_array($QueryApproved, MYSQLI_NUM);
                          $TotalApproved=array_shift($RowsApproved);
                          if ($TotalApproved>0) {

                            echo "<span class=\"label pull-right label-success\">"; echo $TotalApproved; echo "</span>";
                          }
                          echo "</td>";
                          echo "</div>";

                          //action
                          $id=$row["id"];
                          echo "<td>"; echo "<a href=\"EditPost.php?Edit=$id;\" target=\"_blank\"><span class=\"btn btn-warning\">Edit </span></a>
                          <a href=\"DeletePost.php?Delete=$id;\"><span class=\"btn btn-danger\">Delete </sapn></a>"; echo "</td>";
                          //details
                          echo "<td>"; echo "<a href=\"FullBlog.php?id=$id\" target=\"_blank\"><span class=\" btn btn-primary\">Live Preview</span></a>"; echo "</td>";
                          echo "</tr>";

                        }
                         ?>
                      </table>
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
