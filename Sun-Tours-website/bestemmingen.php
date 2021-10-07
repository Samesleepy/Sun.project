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
      //dubbel limiet
      $score = GetScore($bestemming['ID'],$db);
      $countlimit = CheckLimit($bestemming['Plaats'],$db);
      ?>
   <a href="boeken.php?id=<?php echo $bestemming['ID']; ?>" style="text-decoration: none;color: black">
      <div class="card" id="bestemmingen">
      <?php  echo '<img src="data:image/png;base64,'.base64_encode($bestemming['Plaatje']).'"/>'; ?>
         <div class="card-body">
            <h5 class="card-title"><?php echo $bestemming['Plaats'].", ".$bestemming['Land']?></h5>
            <a class="card-text" style="text-decoration: none;color: black"><?php if($countlimit >= $bestemming['Limiet']){echo "Volgeboekt";}else{ echo $bestemming['Prijs'] . " " . "Euro p.p.";} ?></a>
            <a class="card-text" style="text-decoration: none;color: black"><?php if(isset($score)){echo "Score: " . $score;}else{echo "Geen score";} ?></a>
         </div>
      </div>
   </a>
<?php } ?>
</body>

<?php include_once 'footer.php';?>
