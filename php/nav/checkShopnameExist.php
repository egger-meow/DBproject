<?php
session_start();
$_SESSION['Authenticated']=false;
$dbservername='localhost';
$dbname='acdb';
$dbusername='root';
$dbpassword='';

$ok = true;
$msg = "";
    if (!isset($_POST['shopname'])||empty($_POST['shopname']))
    {
        exit();
    }

    $shopname = $_REQUEST['shopname'];
   
    try{
        $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
        # set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //* 店名可不可重複
        $stmt=$conn->prepare("select shopname from shops where shopname=:acc");
        $stmt->execute(array('acc' => $shopname));

        if ($stmt->rowCount()!=0){

            $ok = false;
            $msg = "shop name existed.";


        }
      
    }
    catch(PDOException $e){
        $_SESSION['ok'] = false;
        $k = $e->getMessage();
        echo "$k";
    }
    echo json_encode(
        array(
            'ok'       => $ok,
            'msg'      => $msg
        )
    );
?>        