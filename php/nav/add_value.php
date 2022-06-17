<?php
session_start();
$_SESSION['Authenticated']=false;
$account=$_SESSION['curUser']['account'];
  include("../shit/dbConnect.php");


# set the PDO error mode to exception
  
  $stmt=$conn->prepare("select balance from users where account='$account'");
  $stmt->execute();
  $balance=$stmt->fetch()[0];
  $stmt=$conn->prepare("update users set balance=$balance+$addvalue where account='$account'");
  $stmt->execute();
  $_SESSION['curUser']['balance']=$balance+$addvalue;
  echo <<<EOT
  <!DOCTYPE html>
  <html>
  <script>
  alert("add value success!")
  window.location.replace("../../nav.php");
  </script> </html>
  EOT;
?>