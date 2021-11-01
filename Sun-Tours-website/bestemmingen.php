<?php
include_once 'header.php';
$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.ID, bestemming.Land, bestemming.Plaats, bestemming.Type, bestemming.Prijs, bestemming.Beschrijving, bestemming.Limiet, bestemming.Plaatje, tableA.totalRes, tableB.avgRev from bestemming LEFT JOIN ( SELECT BestemmingID, SUM(personen) AS totalRes FROM boeking GROUP BY BestemmingID ) tableA ON bestemming.id = tableA.BestemmingID LEFT JOIN ( SELECT BestemmingID, AVG(score) AS avgRev FROM review GROUP BY BestemmingID ) tableB ON bestemming.id = tableB.BestemmingID;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Haal alle bestemmingen uit de database met hun info, haal daarbij ook de gemiddelde score van reviews op
$Bestemmingresult = $result;

foreach ($Bestemmingresult as $bestemming) { //Voor elke individuele bestemming die opgehaalt is
  $Bestemmingen[] = new Bestemming($bestemming['ID'], $bestemming['Land'], $bestemming['Plaats'], $bestemming['Type'], $bestemming['Prijs'], $bestemming['Beschrijving'], $bestemming['Limiet'], $bestemming['Plaatje'], $bestemming['avgRev'], $bestemming['totalRes']);
}//Maak instance bestemming aan in array met bijbehorende info uit de database

?>


<body>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="text-center mb-5"><h1>Bestemmingen</h1></div>
  <?php
    foreach ($Bestemmingen as $bestemming) {//haal individuele bestemmingen uit de array Bestemmingen, je hebt nu een bestemming
      $bestemming->ShowBestemming(300);//laat bestemming zien in html-bootstrap card
    }
  ?>
  </div>
</body>


<?php include_once 'footer.php';?>