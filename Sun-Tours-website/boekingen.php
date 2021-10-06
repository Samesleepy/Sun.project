<?php
include_once 'header.php';
$db = $database->connection();

$stmt = $db->query("SELECT `Land`,`Plaats`,`Prijs`,`Personen`,`Vertrekdatum`,`Boekingsdatum`,`Duur` FROM `boeking` WHERE `KlantID` = '".$_SESSION['KlantID']."'");
$Boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <body>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <?php
            if(!$Boekingen == ""){
                foreach ($Boekingen as $key => $Boeking) {
                    $Land = $Boekingen[$key]['Land'];
                    $Plaats = $Boekingen[$key]['Plaats'];
                    
                    $stmt = $db->query("SELECT `Plaatje`,`Beschrijving` FROM `bestemming` WHERE `Land` = '".$Land."' AND `Plaats` = '".$Plaats."'");
                    $Bestemmingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
            <a href="#" style="text-decoration: none;color: black">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-4">
                            <?php echo '<img style="height: 100%;" src="data:image/png;base64,'.base64_encode($Bestemmingen[0]['Plaatje']).'" class="img-fluid rounded-start"/>';?>
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $Boeking['Plaats'].", ".$Boeking['Land']; ?></h5>
                                <p class="card-text"><?php echo $Bestemmingen[0]['Beschrijving']; ?></p>
                                <div style="float: right;margin-bottom: 15px;">
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-users"></i><?php echo " ".$Boeking['Personen']; ?></small></p>
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-clock"></i><?php echo " ".$Boeking['Duur']." Dagen"; ?></small></p>
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-calendar-alt"></i></i><?php echo " ".$Boeking['Vertrekdatum']; ?></small></p>
                                </div>
                                <p class="card-text" style="margin-top: 6%;"><small class="text-muted"><?php echo $Boeking['Boekingsdatum']; ?></small></p>
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