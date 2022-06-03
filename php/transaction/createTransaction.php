<?php
session_start();

require "../shit/dbConnect.php";

$ok = true;
$msg = "";

if (!isset($_POST['UID']) ||
    !isset($_POST['TransactionAmount']) ||
    !isset($_POST['TransactionType'])   // '+' or '-'
    ) { exit(); }

$UID               = $_POST['UID'];
$TransactionAmount = $_POST['TransactionAmount'];
$TransactionType   = $_POST['TransactionType'] == '+' ? true : false; // true add money, false drop money

$currentDate      = new DateTime();
$timeTransactionCreated = $currentDate->format('Y-m-d H:i:s');

  $conn -> beginTransaction();
  try{
    try{
      if (!$TransactionType){
        $stmt=$conn->prepare("select balance from users where UID = $UID;");
        $stmt->execute();

        if($TransactionAmount > $stmt->fetch()[0]){
          throw new Exception("lack in balance");
        }

        $stmt=$conn->prepare("update users set balance = balance - $TransactionAmount where UID = $UID;");
        $stmt->execute();

      } else {
        $stmt=$conn->prepare("update users set balance = balance + $TransactionAmount where UID = $UID;");
        $stmt->execute();
      }

      $TID = 0;
      $s=$conn->prepare("select count(*) from transactions");
      $s->execute();
      if($s->fetch()[0]!=0){
        $s=$conn->prepare("select max(TID) from transactions");
        $s->execute();
        $TID = $s ->fetch()[0] + 1;
      }  

      $stmt=$conn->prepare("insert into transactions values ($TID, $UID, $TransactionAmount, '$timeTransactionCreated', $TransactionType);  ");
      $stmt->execute();

    } catch (PDOException $e) {
      throw new Exception($e-> getMessage());
    }
    
    if(isset($_POST['addvalue'])){
      $_SESSION['curUser']['balance']+=$TransactionAmount;
    }

    $conn->commit();

  } catch (Exception $e){
    $conn->rollBack();
    $ok = false;
    $msg = $e->getMessage();
  }
 
  echo json_encode(
    array(
        'ok'       => $ok,
        'msg'      => $msg
    )
);
?>        