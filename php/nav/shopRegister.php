<?php
session_start();

$dbservername='localhost';
$dbname='acdb';
$dbusername='root';
$dbpassword='';

    $_SESSION['ok'] = true;
    $_SESSION['errMessage'] = "";

    if (!isset($_POST['longitude']) ||!isset($_POST['latitude']) ||!isset($_POST['shopname']) || !isset($_POST['category']))
    {
        exit();
    }

    $shopname = $_REQUEST['shopname'];
    $category = $_REQUEST['category'];
    $latitude = $_REQUEST['latitude'];
    $longitude = $_REQUEST['longitude'];
   
    try{
        $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
        # set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //* 店名可不可重複
        $stmt=$conn->prepare("select shopname from shops where shopname=:acc");
        $stmt->execute(array('acc' => $shopname));

        if ($stmt->rowCount()==0){
        //*/
            try{
                $stmt = $conn->prepare("select max(SID) from shops");
                $stmt->execute();
                $SID = $stmt->fetch()[0] + 1 ;
                $UID = $_SESSION['curUser']['UID'];
                $phonNum = $_SESSION['curUser']['phoneNum'];
                
                $stmt=$conn->prepare("insert into shops values ($SID ,$UID, '$shopname' ,'$category' , ST_GeomFromText('POINT($longitude $latitude)') , '$phonNum');");
                $stmt->execute();

                $stmt=$conn->prepare("update users set identity = true where UID =:UUID;");
                $stmt->execute(array('UUID' => $UID));
                $_SESSION['curUser']['identity'] = true;
                $_SESSION['curUser']['SID'] = $SID;

                $_SESSION['curUser']['shop']['shopName']  = $shopname ;
                $_SESSION['curUser']['shop']['category']  = $category ;
                $_SESSION['curUser']['shop']['latitude']  = $latitude ;
                $_SESSION['curUser']['shop']['longitude'] = $longitude;

                echo <<<EOT
                    <!DOCTYPE html>
                    <html> 
                    <body>
                    <script>
                    alert("Resgister successfully.");
                    window.location.replace("navShop.php");
                    </script> </body> </html>
                EOT;
            }
            catch(PDOException $e) {
                throw new Exception( $e->getMessage());
            }
        }
        else{
            echo "shop name existed.";
            exit();
        }
    }
    catch(PDOException $e){
        $_SESSION['ok'] = false;
        $k = $e->getMessage();
        echo "$k";
    }
/*
    echo <<<EOT
        <!DOCTYPE html>
        <html>
        <body>
        <script>
        alert("Resgister successfully.");
        window.location.replace("../../nav.php");
        </script> </body> </html>
    EOT;
        
        exit();
    */ 

    //}else
    //    throw new Exception("Logup failed.");
