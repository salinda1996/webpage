<?php
if (isset($_POST["submit"])) {
  $name=$_POST["name"];
  $link=mysqli_connect("localhost","root","");
  mysqli_select_db($link,"test");
  mysqli_query($link,"INSERT INTO test VALUES ('','$name')");
    ?>
      <script type="text/javascript">
       alert("added success");
       </script>
       <?php
       echo $name;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
  </head>
  <body>
    <div class="">
      <form class="" action="DB.php" method="post">
        <label for="test">name:</label>
        <input class="form-control" type="text" name="name" id="name" value="">
      <br>
      <input class="btn btn-success btn-block " type="submit" name="submit" value="Add New Category">
      <br>
      </form>
    </div>
  </body>
</html>
