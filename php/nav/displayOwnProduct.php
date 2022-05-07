<?php

$dbservername='localhost';
$dbname='acdb';
$dbusername='jonhou1203';
$dbpassword='pass9704';
//session_start();
  $conn = new PDO("mysql:host=$dbservername; dbname=$dbname", 
  $dbusername, $dbpassword);
  # set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, 
  PDO::ERRMODE_EXCEPTION);

  try{
    $s=$conn->prepare("select * from products where SID =:sid");
    $s->execute(array('sid' => $_SESSION['curUser']['SID']));
    $count = 1;
    foreach($s->fetchAll() as $product){

      $PID = $product['PID'];
      $productName = $product['name'];
      $price = $product['price'];
      $quantity	 = $product['quantity'];

      $sql="select * FROM productimage WHERE PID=$PID";
      $result = $conn->prepare($sql);
    
      
      //查詢結果
      $imageDisplay = "";
      if ($result->rowCount()>0) {
        $row = $result->fetch();
        $img=$row['image'];
        $logodata = $img;
        $imageDisplay = '<img  with="50" heigh="10" src="data:'.$row['imgType'].';base64,' . $logodata . '" />';  
      }

      echo <<<EOT
        <tr>
            <th scope="row">$count</th>
            <td>$imageDisplay</td>
            <td>$productName</td>

            <td>$price </td>
            <td>$quantity </td>
            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#$productName-1">
                    Edit
                </button></td>
            <!-- Modal -->
            <div class="modal fade" id="$productName-1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">$productName Edit</h5>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit$productName">Edit</button>

                        </div>
                    </div>
                </div>
            </div>
            <td><button type="button" class="btn btn-danger delete" id="del$productName">Delete</button></td>
        </tr>
      EOT;
      $count ++;

    }

   



 
  }
  catch(PDOException $e){
    $MSG = $e ->getMessage();
    echo <<<EOT
    <script> 
    alert("$MSG");
    </script> 
    EOT; 
  }





                            
                          