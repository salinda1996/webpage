<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_GET['id'])) {

  $CommentIDFromURL=$_GET['id'];
  $admin=$_SESSION["Username"];
  mysqli_query($link,"UPDATE comments SET status='ON', approvedby='$admin'  WHERE ID='$CommentIDFromURL'");
  $_SESSION["SuccessMessage"]="Approved Comment Succesfully";
  Redirect_to("Comments.php");

}


 ?>
