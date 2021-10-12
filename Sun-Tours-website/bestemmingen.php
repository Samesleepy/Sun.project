<?php include_once 'header.php';
$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.`ID`, bestemming.`Land`, bestemming.`Plaats`, `Type`, bestemming.`Beschrijving`, bestemming.`Prijs`,`Limiet`,`Plaatje`,
AVG(`Score`), SUM(`Personen`)
FROM `bestemming`
LEFT JOIN review
ON bestemming.ID = review.BestemmingID
LEFT JOIN boeking
ON bestemming.ID = boeking.BoekingID
GROUP BY bestemming.ID;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$Bestemmingresult = $result;

foreach ($Bestemmingresult as $bestemming) {
  $Bestemmingen[] = new Bestemming($bestemming['ID'], $bestemming['Land'], $bestemming['Plaats'], $bestemming['Type'], $bestemming['Prijs'], $bestemming['Beschrijving'], $bestemming['Limiet'], $bestemming['Plaatje'], $bestemming['AVG(`Score`)'], $bestemming['SUM(`Personen`)']);
 }

?>
<body>
<?php
   foreach ($Bestemmingen as $bestemming) {
        $bestemming->ShowBestemming();
      }
        ?>
</body>

<?php include_once 'footer.php';?>
