
<html>
   <head>
   </head>
   <body>
     <?php
     $db = $database->connection();
     $stmt = $db->prepare("SELECT `ID`, `Land`,`Plaats`,`Type`,`Prijs`,`Plaatje`  FROM `bestemming` WHERE `Type` = '".$bestemming['Type']."' AND `ID` = '".$bestemming['ID']."'");
     $stmt->execute();
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     $Alternatieven = $result;

         ?>
         <?php foreach ($Alternatieven as $Alternatief){ ?>
        <a href="boeken.php?id=<?php echo $Alternatief['ID']; ?>">
           <div class="card" id="bestemmingen">
           <?php  echo '<img src="data:image/png;base64,'.base64_encode($Alternatief['Plaatje']).'"/>'; ?>
              <div class="card-body">
                 <h5 class="card-title"><?php echo $Alternatief['Plaats'].", ".$Alternatief['Land']?></h5>
                 <p class="card-text"><?php echo $Alternatief['Prijs'] . " " . "Euro p.p." ?>
                <p class="card-text-right"><?php //echo "Score: " . $score ?></p>
              </div>
           </div>
        </a>
     <?php
   }
     ?>
   </body>
</html>
