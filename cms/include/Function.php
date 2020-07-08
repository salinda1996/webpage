<?php require_once ("include/DB.php"); ?>
<?php require_once ("include/Session.php"); ?>

<?php
Function Redirect_to($NewLocation){
  header("location:$NewLocation");
  exit;
}

// Function Login_Attempt($UserName,$Password){
//   $query="SELECT * FROM registration WHERE UserName='$UserName' AND Password='$Password'";
// //  mysqli_query($link,"SELECT * FROM registration WHERE UserName='$UserName' AND Password='$Password'");
//   $execute=mysqli_query($link,$query);
//   if ($admin=mysqli_fetch_assoc($execute)) {
//       return $admin;
//   }else {
//     return null;
//   }
// }
Function Login(){
  if (isset($_SESSION["User_ID"])) {
    return true;
  }
}
Function ConfirmLogin(){
  if (!Login()) {
    $_SESSION["ErrorMessage"]="Login Required";
    Redirect_to("Login.php");
  }
}
 ?>
