<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Comments</title>
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
            <li><a href="ManageAdmins.php"><span class="glyphicon glyphicon-user"></span>
            &nbsp; Manage Admins</a></li>
            <li class="active"><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>
            &nbsp; Comments</a></li>
            <li><a href="Blog.php" target="_blank"><span class="glyphicon glyphicon-equalizer"></span>
            &nbsp; Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>
            &nbsp; Logout</a></li>
          </ul>
        </div><!--Ending of side area -->

          <div class="col-sm-10">
                    <h1>Un-Approved Comments</h1>
                    <?php echo message();
                          echo SuccessMessage();
                    ?>
                      <?php
                      $srNo=0;
                      $res=mysqli_query($link,"SELECT * FROM comments WHERE status='OFF' ORDER BY datetime DESC");
                      echo "<table class=\"table table-striped table-hover\">";
                      echo "<tr>";
                      echo "<th>"; echo "No."; echo "</th>";
                      echo "<th>"; echo "Name"; echo "</th>";
                      echo "<th>"; echo "Date "; echo "</th>";
                      echo "<th>"; echo "Comment"; echo "</th>";
                      echo "<th>"; echo "Approve "; echo "</th>";
                      echo "<th>"; echo "Delete Comment"; echo "</th>";
                      echo "<th>"; echo "Details"; echo "</th>";
                      echo "</tr>";
                      while ($row=mysqli_fetch_array($res)) {
                        $srNo++;
                        $admin_panel_id=$row["admin_panel_id"];
                        $CommentId=$row["id"];
                        $personName=$row["name"];
                        if (strlen($personName)>18) {$personName=substr($personName,0,18).'...';}
                        $comment=$row["comment"];
                        if (strlen($comment)>10) {$comment=substr($comment,0,10).'...';}
                        echo "<tr>";
                        echo "<td>"; echo $srNo; echo "</td>";
                        echo "<td>"; echo $personName; echo "</td>";
                        echo "<td>"; echo $row["datetime"]; echo "</td>";
                        echo "<td>"; echo $comment; echo "</td>";
                        echo "<td>"; echo "<a href=\"ApproveComment.php?id=$CommentId\"><span class=\"btn btn-success\" >Approve</span></a>"; echo "</td>";
                        echo "<td>"; echo "<a href=\"Delete.php?id=$CommentId\"><span class=\"btn btn-danger\" >Delete</span></a>"; echo "</td>";
                        echo "<td>"; echo "<a href=\"FullBlog.php?id=$admin_panel_id\" target=\"_blank\"><span class=\"btn btn-primary\" >Live Preview</span></a>"; echo "</td>";
                        echo "</tr>";

                      }
                        echo "</table>";
                       ?>

                       <h1>Approved Comments</h1>
                         <?php
                         $srNo=0;
                         $res=mysqli_query($link,"SELECT * FROM comments WHERE status='ON' ORDER BY datetime DESC");
                         echo "<table class=\"table table-striped table-hover\">";
                         echo "<tr>";
                         echo "<th>"; echo "No."; echo "</th>";
                         echo "<th>"; echo "Name"; echo "</th>";
                         echo "<th>"; echo "Date "; echo "</th>";
                         echo "<th>"; echo "Comment"; echo "</th>";
                         echo "<th>"; echo "Approve By"; echo "</th>";
                         echo "<th>"; echo "Revert Approve "; echo "</th>";
                         echo "<th>"; echo "Delete Comment"; echo "</th>";
                         echo "<th>"; echo "Details"; echo "</th>";
                         echo "</tr>";
                         while ($row=mysqli_fetch_array($res)) {
                           $Admin=$row["approvedby"];
                           $srNo++;
                           $admin_panel_id=$row["admin_panel_id"];
                           $CommentId=$row["id"];
                           $personName=$row["name"];
                           if (strlen($personName)>18) {$personName=substr($personName,0,18).'...';}
                           $comment=$row["comment"];
                           if (strlen($comment)>10) {$comment=substr($comment,0,10).'...';}
                           echo "<tr>";
                           echo "<td>"; echo $srNo; echo "</td>";
                           echo "<td>"; echo $personName; echo "</td>";
                           echo "<td>"; echo $row["datetime"]; echo "</td>";
                           echo "<td>"; echo $comment; echo "</td>";
                           echo "<td>"; echo $Admin; echo "</td>";
                           echo "<td>"; echo "<a href=\"Un-ApproveComment.php?id=$CommentId\"><span class=\"btn btn-warning\" >Dis-Approve</span></a>"; echo "</td>";
                           echo "<td>"; echo "<a href=\"Delete.php?id=$CommentId\"><span class=\"btn btn-danger\" >Delete</span></a>"; echo "</td>";
                           echo "<td>"; echo "<a href=\"FullBlog.php?id=$admin_panel_id\" target=\"_blank\"><span class=\"btn btn-primary\" >Live Preview</span></a>"; echo "</td>";
                           echo "</tr>";

                         }
                           echo "</table>";
                          ?>
          </div><!--Ending of Main Area-->
      </div> <!--Ending of Row-->
    </div><!--Ending of Container-->
    <div id="footer">
      <hr><p>Theme by | Anil Salinda |&copy; 2020-2025 --- All right reserved </p>
      <hr>
    </div>
  </body>
</html>
