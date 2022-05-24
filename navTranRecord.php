

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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="true">My shop<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="navShop.php">info.</a></li>
                <li><a href="navShopOrder.php">orders</a></li>
            </ul>
        </li>
    <li><a href="navMyOrder.php">My Order</a></li>
    
    <li class="active"><a href="navTranRecord.php">Transaction Record</a></li>
</ul>


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