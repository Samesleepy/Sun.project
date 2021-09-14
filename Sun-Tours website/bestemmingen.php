<?php include_once 'header.php';?>

<?php

    $sql = "SELECT `Locatie`,`Prijs`,`Plaatje` FROM `bestemming`";
    $result = mysqli_query($conn, $sql);
    while($fetch = mysqli_fetch_assoc($result)){
    $Bestemmingen[] = array(
      'Locatie' => $fetch['Locatie'],
      'Prijs' => $fetch['Prijs'],
      'Plaatje' => $fetch['Plaatje']
     );
    }

    ?>

    <html lang="en" dir="ltr">
       <head>
          <meta charset="utf-8">
          <title>Bestemmingen</title>
          <link  rel="stylesheet" href="test.css" type ="text/css"/>
       </head>
       <body>
          <?php //for ($i=0; $i < count($Bestemmingen); $i++) {
            foreach ($Bestemmingen as $bestemming) {
             ?>
            <div class="card" id="bestemmingen">
             <?php  echo '<img src="data:image/png;base64,'.base64_encode($bestemming['Plaatje']).'"/>'; ?>
             <div class="card-body">
                <h5 class="card-title"><?php echo $bestemming['Locatie'] ?></h5>
                <p class="card-text"><?php echo $bestemming['Prijs'] . " " . "Euro p.p." ?></p>
             </div>
          </div>
          <?php }
        //}  ?>
       </body>
    </html>


<?php include_once 'footer.php';?>
