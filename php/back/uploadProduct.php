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
  //$imagePath   = $_REQUEST['myFile'] ;
  //開啟圖片檔
  $file = fopen($_FILES["upfile"]["tmp_name"], "rb");
  // 讀入圖片檔資料
  $fileContents = fread($file, filesize($_FILES["upfile"]["tmp_name"])); 
  //關閉圖片檔
  fclose($file);
  //讀取出來的圖片資料必須使用base64_encode()函數加以編碼：圖片檔案資料編碼
  $fileContents = base64_encode($fileContents);


  print_r($_FILES);
 // exit();
  $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", 
  $dbusername, $dbpassword);
  # set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, 
  PDO::ERRMODE_EXCEPTION);
  try{
    $s=$conn->prepare("select count(*) from productimage");
    $s->execute();
    $k = $s ->fetch();
    if((int)$k[0]!=0){
      $s=$conn->prepare("select max(PID) from productimage");
      $s->execute();
      $k = $s ->fetch();
    }  

    $PICID = (string)((int)$k[0] + 1);
    $imgType=$_FILES["upfile"]["type"];
    




    $stmt=$conn->prepare("select SID from shops where UID=:user");
    $stmt->execute(array('user' => $_SESSION['curUser']['UID']));
    $SID = $stmt->fetch()[0];

    $stmt=$conn->prepare("select * from products where name = '$productName' and SID = $SID");
    $stmt->execute();
    if ($stmt->rowCount()!=0){
      $PID = $stmt->fetch()['PID'];
      $q = $stmt->fetch()['quantity'];

      $sql="insert INTO productimage values ($PICID,$PID,'$fileContents','$imgType')";
      $stmt=$conn->prepare("update products SET price = $price, quantity = $quantity+$q  where name = '$productName' and SID = $SID ");
      $stmt->execute();
      $stmt=$conn->prepare($sql);
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
      $stmt=$conn->prepare("insert into products values ($PID, $SID ,'$productName' ,$price ,$quantity);");       
      $stmt->execute();
      $stmt=$conn->prepare("insert INTO productimage values ($PICID,$PID,'$fileContents','$imgType');");
      $stmt->execute();
    }
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("add product success!" )
        //window.location.replace(../../nav.php#menu1)
        </script> </body> </html>
    EOT;
    
    exit();
  }
  catch(PDOException $e){
    $msg = $e->getMessage();
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("add product failed! error: $msg" )

        </script> </body> </html>
    EOT;
  }
}
catch(Exception $e){
  $msg = $e->getMessage();
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("add product failed! error: $msg" )
 
        </script> </body> </html>
    EOT;
}
