

<?php

session_start();
require "php/shit/head2.php";

if(!$_SESSION['Authenticated']){
  header('Location: index.php');
} 

require "php/shit/dbConnect.php";

?>

<nav class="navbar navbar-inverse">
<div class="container-fluid">
  <div class="navbar-header ">
    <a class="navbar-brand " href="#">DJJs</a>    
  </div>
  <div class="navbar-footer">
    <a class="navbar-brand nav" href="index.php" style="float: right;display: block;">logout</a>
  </div>
</div>  
</nav>

<div class="container">

  <ul class="nav nav-tabs">
    <li><a href="nav.php">Home</a></li>
    <li class="dropdown">
        <a href="navShop.php" class="dropdown-toggle" data-toggle="dropdown" role="button"
          aria-haspopup="true" aria-expanded="true">My shop<span class="caret"></span></a>
        <ul class="dropdown-menu">
        
          <li><a href="navShop.php">info.</a></li>
          <li><a href="navShopOrder.php">orders</a></li>
        </ul>
      </li>
    <li><a href="navMyOrder.php">My Order</a></li>
    
    <li class="active"><a href="navTranRecord.php">Transaction Record</a></li>
  </ul>

  <div class="tab-content">   
    <div id="menu1" class="tab-pane fade in active">
      <div class="row">
        <div class="  col-xs-8">
          <table class="table" style=" margin-top: 15px;">

            <thead>
              <tr>
                <th scope="col">Record ID</th>
                <th scope="col">Action</th>
                <th scope="col">Time</th>
                <th scope="col">Trader</th>
                <th scope="col">Amount change</th>

              </tr>
            </thead>

            <tbody>

<?php
  foreach ( $conn -> query('select * from transactions') as $id => $tra ) {
    $UID = $tra['UID']; 
    $trader = "";
    if ($tra['TransactionType'] == 'receive') {
      $stmt=$conn->prepare("select shopName from shops where UID = $UID;");
      $stmt->execute();
      $trader = $stmt->fetch()[0];

    } else {
      $stmt=$conn->prepare("select account from users where UID = $UID");
      $stmt->execute();
      $trader = $stmt->fetch()[0];
    }
   
    $sign = $tra['TransactionType'] == 'payment' ? '-' : '+'
?> 
            <tr>
              <td><?=$id+1?></td> 
              <td><?=$tra['TransactionType']?></td> 
              <td><?=$tra['timeTransaction']?></td>
              <td><?=$trader?></td>
              <td><?=$sign?><?=$tra['TransactionAmount']?></td> 
            </tr>
<?php
  }
?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

    $('li.dropdown').mouseover(function () {

      if ($(document).width() > 767)
          $(this).addClass('open');

    }).mouseout(function () {
      if ($(document).width() > 767)
        $(this).removeClass('open');
    });

</script>


<?php require "php/shit/foot.php"; ?>