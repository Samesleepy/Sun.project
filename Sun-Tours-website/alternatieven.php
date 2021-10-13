<?php
$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.ID, bestemming.Land, bestemming.Plaats, bestemming.Type, bestemming.Prijs, bestemming.Beschrijving, bestemming.Limiet, bestemming.Plaatje, tableA.totalRes, tableB.avgRev from bestemming LEFT JOIN ( SELECT BestemmingID, SUM(personen) AS totalRes FROM boeking GROUP BY BestemmingID ) tableA ON bestemming.id = tableA.BestemmingID LEFT JOIN ( SELECT BestemmingID, AVG(score) AS avgRev FROM review GROUP BY BestemmingID ) tableB ON bestemming.id = tableB.BestemmingID WHERE `Type` = '".$Bestemminginfo['Type']."' AND NOT `ID` = '".$Bestemminginfo['ID']."';");
$stmt->execute();
$bestemmingresult = $stmt->fetchAll();



$Bestemmingen = array();
foreach ($bestemmingresult as $key => $bestemming) {
   $Bestemming = new Bestemming($bestemming['ID'], $bestemming['Land'], $bestemming['Plaats'],$bestemming['Type'], $bestemming['Prijs'], $bestemming['Beschrijving'], $bestemming['Limiet'], $bestemming['Plaatje'], $bestemming['avgRev'], $bestemming['totalRes']);
   $Bestemmingen[$key] = $Bestemming;
}
?>
<h2 class="my-3 mx-1">Alternatieven</h2>
<div class="row">
<?php foreach ($Bestemmingen as $bestemming) { ?>
   <div class="col" style="max-width: 320px;">
      <?php $bestemming->ShowBestemming(); ?>
   </div>   
<?php } ?>
</div>
