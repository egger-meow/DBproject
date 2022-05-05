
<?php
session_start();
$_SESSION['Authenticated']=false;
$_SESSION['username'] = "";
$dbservername='localhost';
$dbname='acdb';
$dbusername='jonhou1203';
$dbpassword='pass9704';
//echo 'alert("ffd")';//

$ok = true;
$msg = "";
$us  = "";
try{
  
  if (!isset($_POST['acc']) || !isset($_POST['pwd']))
  {
    //header("Content-Disposition:attachment;filename=test.pdf");
    header("Location: ../../index.php");   
  }

  if (empty($_POST['acc']) || empty($_POST['pwd']))
    throw new Exception('Please input account and password.');

  $account=$_POST['acc'];
  $pwd=$_POST['pwd'];

  $conn = new PDO('mysql:host=localhost;dbname=acdb', $dbusername, $dbpassword);
# set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt=$conn->prepare("select * from users where account=:username");
  $stmt->execute(array('username' => $account));
  if ($stmt->rowCount()==1){
    $row = $stmt->fetch();
    $fuck = hash('sha256',$row['salt'].$pwd);
    if ($row['password']==hash('sha256',$row['salt'].$pwd)){
    
      $_SESSION['Authenticated']=true;
      $_SESSION['curUser']['account'] = $row['account'];
      $_SESSION['curUser']['username'] = $row['username'];
      $_SESSION['curUser']['password'] = $pwd;

      $geoloca = $row['ST_AsText(location)'];
      $geoloca = substr($geoloca, 6, strlen($geoloca)-6-1);
      $loca = explode(" ",$geoloca);

      $_SESSION['curUser']['latitude'] = $loca[0];
      $_SESSION['curUser']['longitude'] = $loca[1];
      $_SESSION['curUser']['balance'] = $row['balance'];
      $_SESSION['curUser']['identity'] = $row['identity'];
      $us = $row['username']; 
        
    }
    else{    
      throw new Exception('wrong password.');

    }
      
  }
  else
    throw new Exception('account not exist.');

  }

catch(Exception $e){
  $ok = false ;
  $msg = $e->getMessage();
  session_unset(); 
  session_destroy(); 
}
echo json_encode(
  array(
      'ok'       => $ok,
      'msg'      => $msg,
      'username' => $us 
  )
);



?>
