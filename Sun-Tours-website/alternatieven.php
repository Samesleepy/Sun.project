<?php
//maakt database connection aan
$db = $database->connection();
//selecteerd alles van de bestemmingen
$stmt = $db->prepare("SELECT bestemming.ID, bestemming.Land, bestemming.Plaats, bestemming.Type, bestemming.Prijs, bestemming.Beschrijving, bestemming.Limiet, bestemming.Plaatje, tableA.totalRes, tableB.avgRev from bestemming LEFT JOIN ( SELECT BestemmingID, SUM(personen) AS totalRes FROM boeking GROUP BY BestemmingID ) tableA ON bestemming.id = tableA.BestemmingID LEFT JOIN ( SELECT BestemmingID, AVG(score) AS avgRev FROM review GROUP BY BestemmingID ) tableB ON bestemming.id = tableB.BestemmingID WHERE `Type` = '".$Bestemminginfo['Type']."' AND NOT `ID` = '".$Bestemminginfo['ID']."';");
//haal bestemmingen uit database waar het type hetzelfde is als de gekozen bestemming en id anders
$stmt->execute();
//pakt alle regels van het resultaat
$bestemmingresult = $stmt->fetchAll();



//maakt een array aan met de naam Bestemmingen
$Bestemmingen = array();
//laat alle bestemmingen zien
foreach ($bestemmingresult as $key => $bestemming) {
   $Bestemming = new Bestemming($bestemming['ID'], $bestemming['Land'], $bestemming['Plaats'],$bestemming['Type'], $bestemming['Prijs'], $bestemming['Beschrijving'], $bestemming['Limiet'], $bestemming['Plaatje'], $bestemming['avgRev'], $bestemming['totalRes']);
   $Bestemmingen[$key] = $Bestemming;
}
?>
<h2 class="my-3 mx-1"><?=  $text[$_SESSION['lang']]['alternatieven'][1] ?></h2>
<div class="row">
<?php
   //laat de bestemmingen zien
   foreach ($Bestemmingen as $bestemming) { ?>
   <div class="col" style="max-width: 320px;">
      <?php $bestemming->ShowBestemming(300); ?>
   </div>
<?php } ?>
</div>
