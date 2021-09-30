<?php include_once 'header.php';
   $db = $database->connection();
   $stmt = $db->prepare("SELECT `ID`, `Land`, `Plaats`, `Type`, `Prijs`,`Limiet`,`Plaatje` FROM `bestemming`");
   $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $Bestemmingen = $result;
?>
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
            <h5 class="card-title"><?php echo $bestemming['Plaats'].", ".$bestemming['Land']?></h5>
            <a class="card-link" style="text-decoration: none;"><?php echo $bestemming['Prijs'] . " " . "Euro p.p." ?></a>
            <a class="card-link" style="text-decoration: none;     margin-left: 5rem;"><?php if(isset($score)){echo "Score: " . $score;} ?></a>
         </div>
      </div>
   </a>
<?php } ?>
</body>

<?php include_once 'footer.php';?>
