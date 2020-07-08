<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_GET['id'])) {

  $CommentIDFromURL=$_GET['id'];
  mysqli_query($link,"DELETE FROM comments  WHERE ID='$CommentIDFromURL'");
  $_SESSION["SuccessMessage"]="Comments Delete Succesfully";
  Redirect_to("Comments.php");

}


 ?>
