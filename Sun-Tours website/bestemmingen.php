<?php include_once 'header.php';

    $stmt = $conn->prepare("SELECT `ID`, `Locatie`,`Prijs`,`Plaatje` FROM `bestemming`");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $Bestemmingen = $result;

    ?>
    <html>
       <head>
          <title>Bestemmingen</title>
          <link  rel="stylesheet" href="test.css" type ="text/css"/>
       </head>
       <body>
         <?php
            foreach ($Bestemmingen as $bestemming) {
             ?>
            <a href="boeken.php?id=<?php echo $bestemming['ID']; ?>">
               <div class="card" id="bestemmingen">
               <?php  echo '<img src="data:image/png;base64,'.base64_encode($bestemming['Plaatje']).'"/>'; ?>
                  <div class="card-body">
                     <h5 class="card-title"><?php echo $bestemming['Locatie'] ?></h5>
                     <p class="card-text"><?php echo $bestemming['Prijs'] . " " . "Euro p.p." ?></p>
                  </div>
               </div>
            </a>
         <?php }
         ?>
       </body>
    </html>


<?php include_once 'footer.php';?>
