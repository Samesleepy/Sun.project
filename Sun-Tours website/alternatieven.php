
<html>
   <head>
   </head>
   <body>
     <?php
     $db = $database->connection();
     $stmt = $db->prepare("SELECT `ID`, `Land`,`Prijs`,`Plaatje`  FROM `bestemming` WHERE `Land` = '".$bestemming['Land']."' AND `ID` = '".$id."'");
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $Bestemmingen = $result;

         ?>
        <a href="boeken.php?id=<?php echo $bestemming['ID']; ?>">
           <div class="card" id="bestemmingen">
           <?php  echo '<img src="data:image/png;base64,'.base64_encode($bestemming['Plaatje']).'"/>'; ?>
              <div class="card-body">
                 <h5 class="card-title"><?php echo $bestemming['Locatie']?></h5>
                 <p class="card-text"><?php echo $bestemming['Prijs'] . " " . "Euro p.p." ?>
                <p class="card-text-right"><?php echo "Score: " . $score ?></p>
              </div>
           </div>
        </a>
     <?php
     ?>
   </body>
</html>
