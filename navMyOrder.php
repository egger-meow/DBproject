

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
        <li><a href="navShop.php">Shop</a></li>
        <li class="active"><a href="navMyOrder.php">My Order</a></li>
        <li><a href="navShopOrder.php">Shop Order</a></li>
        <li><a href="navTranRecord.php">Transaction Record</a></li>
    </ul>

   
</div>



<?php require "php/shit/foot.php"; ?>