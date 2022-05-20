<?php
session_start();

$account=$_SESSION['curUser']['account'];
$dbservername='localhost';
$dbname='acdb';
$dbusername='root';
$dbpassword='';


  if (!isset($_POST['lon']) || !isset($_POST['lat']))
  {
    //header("Content-Disposition:attachment;filename=test.pdf");
    header("Location: ../../nav.php");   
  }

  $latitude=$_POST['lat'];
  $longitude=$_POST['lon'];

  $conn = new PDO('mysql:host=localhost;dbname=acdb', $dbusername, $dbpassword);
# set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt=$conn->prepare("update users set location=ST_GeomFromText('POINT($longitude $latitude)') where account='$account'");
  $account=$_SESSION['curUser']['longitude'] = $longitude ;
  $account=$_SESSION['curUser']['latitude'] = $latitude ;

  $stmt->execute();
  echo <<<EOT
  <!DOCTYPE html>
  <html>
  <script>
  window.location.replace("../../nav.php");
  </script> </html>
  EOT;


?>