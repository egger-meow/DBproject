<?php
 include("../shit/dbConnect.php");

$msg = "";

try {
   
 
    $account   = $_REQUEST['acc'] ;


    $stmt=$conn->prepare("select username from users where account=:acc");
    $stmt->execute(array('acc' => $account));
    if ($stmt->rowCount()!=0){
        throw new Exception("Account used.");
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