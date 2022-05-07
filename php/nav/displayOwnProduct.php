<?php

$dbservername='localhost';
$dbname='acdb';
$dbusername='jonhou1203';
$dbpassword='pass9704';
session_start();
  $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", 
  $dbusername, $dbpassword);
  # set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, 
  PDO::ERRMODE_EXCEPTION);

  try{
    $s=$conn->prepare("select * from products where SID =:sid");
    $s->execute(array('Acc' => $$_SESSION['curUser']['SID']));
    foreach($s->fetchAll() as $product){



    }

   



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
  }


?>


                            <tr>
                                <th scope="row">1</th>
                                <td><img src="Picture/1.jpg" with="50" heigh="10" alt="Hamburger"></td>
                                <td>Hamburger</td>

                                <td>80 </td>
                                <td>20 </td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Hamburger-1">
                                        Edit
                                    </button></td>
                                <!-- Modal -->
                                <div class="modal fade" id="Hamburger-1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Hamburger Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="ex71">price</label>
                                                        <input class="form-control" id="ex71" type="text">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="ex41">quantity</label>
                                                        <input class="form-control" id="ex41" type="text">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td><img src="Picture/2.jpg" with="10" heigh="10" alt="coffee"></td>
                                <td>coffee</td>

                                <td>50 </td>
                                <td>20</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#coffee-1">
                                        Edit
                                    </button></td>
                                <!-- Modal -->
                                <div class="modal fade" id="coffee-1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">coffee Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="ex72">price</label>
                                                        <input class="form-control" id="ex72" type="text">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="ex42">quantity</label>
                                                        <input class="form-control" id="ex42" type="text">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tr>
