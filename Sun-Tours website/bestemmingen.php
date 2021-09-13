<?php include_once 'header.php';?>


<?php
     $host = "localhost";
     $username = "root";
     $password = "";
     $databaseName = "sunproject";

     //connect to database
     $conn = mysqli_connect($host, $username, $password, $databaseName);

    if (!$conn) {
      die("Connection failed"); //: " . mysqli_connect_error());
    }

    $sql = "SELECT `Locatie`,`Prijs`,`Plaatje` FROM `bestemming`";
    $result = mysqli_query($conn, $sql);
    while($fetch = mysqli_fetch_assoc($result)){
    $Bestemmingen[] = array(
      'Locatie' => $fetch['Locatie'],
      'Prijs' => $fetch['Prijs'],
      'Plaatje' => $fetch['Plaatje']
     );
    }
    //print_r($result);

    //$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    ?>


    <!DOCTYPE html>
    <html lang="en" dir="ltr">
       <head>
          <meta charset="utf-8">
          <title>Bestemmingen</title>
          <link  rel="stylesheet" href="suntours.css" type ="text/css"/>
       </head>
       <body>
          <?php for ($i=0; $i < count($Bestemmingen); $i++) {
            //foreach ($Bestemming as $value) {
             ?>
          <div class="card" style = " width: 18.9055rem; float: left; margin-right: 10px; margin-left: 4px; margin-top: 10px" >
             <?php  echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen[$i]['Plaatje']).'"/>'; ?>
             <div class="card-body">
                <h5 class="card-title"><?php echo $Bestemmingen[$i]['Locatie'] ?></h5>
                <p class="card-text"><?php echo $Bestemmingen[$i]['Prijs'] ?></p>
             </div>
          </div>
          <?php }
        //}  ?>
       </body>
    </html>


<?php include_once 'footer.php';?>
