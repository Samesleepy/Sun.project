<?php
include_once 'header.php';

if($User->voornaam == ""){
   header("Location: home.php");
}

$db = $database->connection();

$stmt = $db->query("SELECT `BoekingID`,`Land`,`Plaats`,`Personen`,`Vertrekdatum`,`Duur` FROM `boeking` WHERE `KlantID` = '".$User->GetUserInfo()['KlantID']."'");
$Boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <body>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="text-center" style="margin-bottom: 20px;"><h1>Eerdere boekingen</h1></div>
            <?php
            if(!$Boekingen == ""){
                foreach ($Boekingen as $key => $Boeking) {
                    $Land = $Boekingen[$key]['Land'];
                    $Plaats = $Boekingen[$key]['Plaats'];

                    $stmt = $db->query("SELECT `Plaatje`,`Beschrijving` FROM `bestemming` WHERE `Land` = '".$Land."' AND `Plaats` = '".$Plaats."'");
                    $Bestemmingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
            <a href="factuur.php?id=<?php echo $Boeking['BoekingID']; ?>" style="text-decoration: none;color: black">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-4">
                            <?php echo '<img style="height: 250px;" src="data:image/png;base64,'.base64_encode($Bestemmingen[0]['Plaatje']).'" class="img-fluid rounded-start"/>';?>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $Boeking['Plaats'].", ".$Boeking['Land']; ?></h5>
                                <p class="card-text"><?php echo $Bestemmingen[0]['Beschrijving']; ?></p>
                                <div style="float: right;margin-bottom: 15px;">
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-users"></i><?php echo " ".$Boeking['Personen']; ?></small></p>
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-clock"></i><?php echo " ".$Boeking['Duur']." Dagen"; ?></small></p>
                                </div>
                                <p class="card-text" style="margin-top: 6%;"><small class="text-muted">Vertrekdatum <i class="fas fa-calendar-alt"></i></i><?php echo " ".$Boeking['Vertrekdatum']; ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php }}else{echo "<h3 class='text-center'>Er zijn geen boekingen</h3>";} ?>
        </div>
    </body>
</html>
<?php include_once 'footer.php'; ?>
