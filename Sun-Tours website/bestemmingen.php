<?php include_once 'header.php';
    $db = $database->connection();
    $stmt = $db->prepare("SELECT `ID`, `Locatie`,`Prijs`,`Plaatje` FROM `bestemming`");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $Bestemmingen = $result;

    ?>
    <html>
       <head>
          <title>Bestemmingen</title>
       </head>
       <body>
         <?php
            foreach ($Bestemmingen as $bestemming) {

              $stmt = $db->prepare("SELECT `Score` FROM `review` WHERE `BestemmingID` = '".$bestemming['ID']."'");
              $stmt->execute();
              $results = array();
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($results, $row['Score']);
              }
              $results = array_filter($results);
              if(count($results)) {
                  $score = array_sum($results)/count($results);
              }

             ?>
            <a href="boeken.php?id=<?php echo $bestemming['ID']; ?>">
               <div class="card" id="bestemmingen">
               <?php  echo '<img src="data:image/png;base64,'.base64_encode($bestemming['Plaatje']).'"/>'; ?>
                  <div class="card-body">
                     <h5 class="card-title"><?php echo $bestemming['Locatie'] . " Score: " . $score ?></h5>
                     <p class="card-text"><?php echo $bestemming['Prijs'] . " " . "Euro p.p." ?></p>
                  </div>
               </div>
            </a>
         <?php }
         ?>
       </body>
    </html>


<?php include_once 'footer.php';?>
