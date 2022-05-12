















<?php require "php/shit/head2.php"; ?>
<?php
    session_start();
    $_SESSION['ok'] = true;
    /*
    $account = $_SESSION['account'];
    $conn = new PDO('mysql:host=localhost;dbname=acdb', 'root', '');
    $stmt=$conn->prepare("select * from users where account=:acc");
    $stmt->execute(array('acc' => $account));
    $row = $stmt->fetch();
    $stmt=$conn->prepare("select ST_AsText(location) from users where account=:acc");
    $stmt->execute(array('acc' => $account));
    //找location
    $geoloca = $stmt->fetch()["ST_AsText(location)"];
    $geoloca = substr($geoloca, 6, strlen($geoloca)-6-1);
    $loca = explode(" ",$geoloca);
    */
    
?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand " href="#">DJJs</a>
        </div>

    </div>
</nav>
<div class="container">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Home</a></li>
        <li><a href="#menu1">shop</a></li>


    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>Profile</h3>
            <div class="row">
                <div class="col-xs-12">
                
                    Accouont: <?php echo $_SESSION['curUser']['account']; ?>, user: <?php echo $_SESSION['curUser']['username'];?>, PhoneNumber: <?php echo $_SESSION['curUser']['phoneNum']; ?>, location: <?php echo $_SESSION['curUser']['latitude'],',',$_SESSION['curUser']['longitude']; ?>

                    <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal" data-target="#location">edit location</button>
                    <!--  -->
                    
                    
                    
                    <div class="modal fade" id="location" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <div class="modal-content">
                                <form action="php/nav/edit_location.php" class="fh5co-form animate-box" data-animate-effect="fadeIn" method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">edit location</h4>
                                </div>
                                <div class="modal-body">
                                    <label class="control-label " for="latitude">latitude</label>
                                    <input name= lat type="text" class="form-control" id="latitude" placeholder="enter latitude" required="required>
                                    <br>
                                    <label class="control-label " for="longitude">longitude</label>
                                    <input name= lon type="text" class="form-control" id="longitude" placeholder="enter longitude" required="required>
                                </div>
                
                                <div class="modal-footer">
                                    <input type="submit" value="Edit" class="btn btn-primary">
                                   <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button> -->
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                   
                    
                    
                    <!--  -->
                    walletbalance: <?php echo $_SESSION['curUser']['balance']; ?>
                    <!-- Modal -->
                    <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal" data-target="#myModal">Add value</button>
                    <div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <div class="modal-content">
                            <form action="php/nav/add_value.php" class="fh5co-form animate-box" data-animate-effect="fadeIn" method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add value</h4>
                                </div>
                                <div class="modal-body">
                                    <input name="add_value" type="text" class="form-control" id="value" placeholder="enter add value" required="required>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Add" class="btn btn-primary">
                                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Add</button>-->
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 
                
             -->
            <h3>Search</h3>
            <div class=" row  col-xs-8">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="Shop">Shop</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" placeholder="Enter Shop name">
                        </div>
                        <label class="control-label col-sm-1" for="distance">distance</label>
                        <div class="col-sm-5">


                            <select class="form-control" id="sel1">
                                <option>near</option>
                                <option>medium </option>
                                <option>far</option>

                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-sm-1" for="Price">Price</label>
                        <div class="col-sm-2">

                            <input type="text" class="form-control">

                        </div>
                        <label class="control-label col-sm-1" for="~">~</label>
                        <div class="col-sm-2">

                            <input type="text" class="form-control">

                        </div>
                        <label class="control-label col-sm-1" for="Meal">Meal</label>
                        <div class="col-sm-5">
                            <input type="text" list="Meals" class="form-control" id="Meal" placeholder="Enter Meal">
                            <datalist id="Meals">
                                <option value="Hamburger">
                                <option value="coffee">
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="category"> category</label>


                        <div class="col-sm-5">
                            <input type="text" list="categorys" class="form-control" id="category" placeholder="Enter shop category">
                            <datalist id="categorys">
                                <option value="fast food">

                            </datalist>
                        </div>
                        <button type="submit" style="margin-left: 18px;" class="btn btn-primary">Search</button>

                    </div>
                </form>
            </div>
            <div class="row">
                <div class="  col-xs-8">
                    <table class="table" style=" margin-top: 15px;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>

                                <th scope="col">shop name</th>
                                <th scope="col">shop category</th>
                                <th scope="col">Distance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>

                                <td>macdonald</td>
                                <td>fast food</td>

                                <td>near </td>
                                <td> <button type="button" class="btn btn-info " data-toggle="modal" data-target="#macdonald">Open menu</button></td>

                            </tr>


                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="macdonald" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">menu</h4>
                                </div>
                                <div class="modal-body">
                                    <!--  -->

                                    <div class="row">
                                        <div class="  col-xs-12">
                                            <table class="table" style=" margin-top: 15px;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Picture</th>

                                                        <th scope="col">meal name</th>

                                                        <th scope="col">price</th>
                                                        <th scope="col">Quantity</th>

                                                        <th scope="col">Order check</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td><img src="Picture/1.jpg" with="50" heigh="10" alt="Hamburger"></td>

                                                        <td>Hamburger</td>

                                                        <td>80 </td>
                                                        <td>20 </td>

                                                        <td> <input type="checkbox" id="cbox1" value="Hamburger"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td><img src="Picture/2.jpg" with="10" heigh="10" alt="coffee"></td>

                                                        <td>coffee</td>

                                                        <td>50 </td>
                                                        <td>20</td>

                                                        <td><input type="checkbox" id="cbox2" value="coffee"></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <!--  -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Order</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div id="menu1" class="tab-pane fade">
        
            <h3> Start a business </h3>

            <script>
                
                if(<?php echo $_SESSION['curUser']['identity']?>){
                    //alert("shop register success!");
                    //document.getElementById('shopResSubmit').disabled = true ;
                }

                $(document).ready(function() {
                    $("#shopResForm").submit( function(event) {
                        event.preventDefault();
                        var shopname = $("#exshopname").val();
                        var category = $("#excategory").val();
                        var latitude = $("#exlatitude").val();
                        var longitude = $("#exlongitude").val();
                        $("#shopResErrMsg").load("php/nav/shopRegister.php", {
                            shopname :shopname,
                            category :category,
                            latitude :latitude,
                            longitude :longitude
                        });
                        //checkResShop();
                    });   
                });

                
            </script>

            <form action="php/nav/shopRegister.php" class="fh5co-form animate-box" data-animate-effect="fadeIn" method="post"  target="nm_iframe" id="shopResForm">

            <div class="form-group ">
                <div class="row">
                    <div class="col-xs-2">
                        <label for="ex5">shop name</label>
                        <input name="shopname" class="form-control" id="exshopname" placeholder="macdonald" type="text" required="required">
                    </div>
                    <div class="col-xs-2">
                        <label for="ex5">shop category</label>
                        <input name="category" class="form-control" id="excategory" placeholder="fast food" type="text" required="required">
                    </div>
                        <label for="ex6">latitude</label>
                        <input name="latitude" class="form-control" id="exlatitude" placeholder="121.00028167648875" type="text" required="required">
                    </div>
                    <div class="col-xs-2">
                        <label for="ex8">longitude</label>
                        <input name="longitude" class="form-control" id="exlongitude" placeholder="24.78472733371133" type="text" required="required">
                    </div>
                </div>
            </div>
            <p id = "shopResErrMsg" style="color:red">
            </p>
            <div class=" row" style=" margin-top: 25px;">
                <div class=" col-xs-3">
                    <input type="submit" value="register" class="btn btn-primary" id="shopResSubmit">
                    <!-- <button type="button" class="btn btn-primary">register</button> -->
                </div>
            </div>

            </form>
            <iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>
            <hr>
            <h3>ADD</h3>
            <script>
                
               

                
                
            </script>
            <form class="form-group " method="post" action="php/back/uploadProduct.php" Enctype="multipart/form-data" id= "addProForm">
                <div class="row">

                    <div class="col-xs-6">
                        <label for="ex3">meal name</label>
                        <input class="form-control" id="pname" type="text" name="pname"  required>
                    </div>
                </div>
                <div class="row" style=" margin-top: 15px;">
                    <div class="col-xs-3">
                        <label for="ex7">price</label>
                        <input class="form-control" id="price" name="price" pattern="^[0-9]+$"type="text" required>
                    </div>
                    <div class="col-xs-3">
                        <label for="ex4">quantity</label>
                        <input class="form-control" id="quantity"  name="quantity" pattern="^[0-9]+$"type="text" required>
                    </div>
                </div>


                <p id="addproErrMsg" style="color :red "></p>

                <div class="row" style=" margin-top: 25px;">

                    <div class=" col-xs-3">
                        <label for="ex12">上傳圖片</label>
                        <input id="myFile" type="file" name="upfile" multiple class="file-loading" required>

                    </div>
                    <div class=" col-xs-3">

                        <button id="fuck" style=" margin-top: 15px;" type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>

            <script>
               
                function handleResponse (responseObject) {
                    if (responseObject.msg=="") {
                        alert("add product success!" )
                        window.location.replace("nav.php#menu1");
                       
                    } else {
                        alert(responseObject.msg)
                    }
                }
            </script>

            <div class="row">
                <div class="  col-xs-8">
                    <table class="table" style=" margin-top: 15px;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Picture</th>
                                <th scope="col">meal name</th>

                                <th scope="col">price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <iframe name="dummyframe" id="dummyframe" style="display: none;"><?php require "php/nav/displayOwnProduct.php"; ?></iframe>
                        <?php require "php/nav/displayOwnProduct.php"; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



    </div>
</div>
<button id="logout" style=" margin-top: 15px;" type="button" class="btn btn-primary">logout</button>

<!-- Option 1: Bootstrap Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function() {
        $("#logout").click(function() {
            <?php echo $_SESSION['Authenticated']=false;?>
            window.location.replace("index.php");
        });
    });
    $(document).ready(function() {
        $(".nav-tabs a").click(function() {
            $(this).tab('show');
        });
    });
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
<?php require "php/shit/foot.php"; ?>