<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>
<?php require_once ("include/Function.php"); ?>
<?php ConfirmLogin(); ?>
<?php
if (isset($_GET['id'])) {

  $AdminIDFromURL=$_GET['id'];
  mysqli_query($link,"DELETE FROM registration WHERE id='$AdminIDFromURL'");
  $_SESSION["SuccessMessage"]="Admin Delete Succesfully";
  Redirect_to("ManageAdmins.php");

}


 ?>
