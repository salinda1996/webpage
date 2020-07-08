<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_GET['id'])) {

  $CommentIDFromURL=$_GET['id'];
  mysqli_query($link,"DELETE FROM category WHERE id='$CommentIDFromURL'");
  $_SESSION["SuccessMessage"]="Category Delete Succesfully";
  Redirect_to("Categories.php");

}


 ?>
