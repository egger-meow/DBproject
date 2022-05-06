<?php

$dbservername='localhost';
$dbname='acdb';
$dbusername='jonhou1203';
$dbpassword='pass9704';
session_start();

$msg = "";
try {
   
 
  $productName = $_REQUEST['pname'] ;
  $price       = $_REQUEST['price'] ;
  $quantity    = $_REQUEST['quantity'] ;



  
  $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", 
  $dbusername, $dbpassword);
  # set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, 
  PDO::ERRMODE_EXCEPTION);
  try{
    $stmt=$conn->prepare("select SID from shops where UID=:user");
    $stmt->execute(array('user' => $_SESSION['curUser']['UID']));
    $SID = $stmt->fetch()[0];

    $stmt=$conn->prepare("select * from products where name=$productName and SID=$SID");
    $stmt->execute();
    if ($stmt->rowCount()!=0){
      $q = $stmt->fetch()['quantity'];
      $stmt=$conn->prepare("update products SET price = $price, quantity = $quantity+$q where name=$productName and SID=$SID");
      $stmt->execute();
    }
    else{
      $s=$conn->prepare("select count(*) from products");
      $s->execute();
      $k = $s ->fetch();
      if((int)$k[0]!=0){
        $s=$conn->prepare("select max(PID) from products");
        $s->execute();
        $k = $s ->fetch();
      }  
      $PID = (string)((int)$k[0] + 1);
      $stmt=$conn->prepare("insert into product values ('$PID', '$SID' ,'$productName' ,'$price' ,'$quantity')");       
      $stmt->execute();
    }
  }
  catch(PDOException $e){
      throw $e;
  }
}
catch(Exception $e){
  $msg=$e->getMessage();
}
echo json_encode(
  array(
      'msg'      => $msg
  )
);