<?php
include_once 'header.php';
$db = $database->connection();

$stmt = $db->query("SELECT `Land`,`Plaats`,`Prijs`,`Personen`,`Vertrekdatum`,`Duur` FROM `boeking` WHERE `KlantID` = '".$_SESSION['KlantID']."'");
$Boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <body>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <?php foreach ($Boekingen as $key => $Boeking) {
                $Land = $Boekingen[$key]['Land'];
                $Plaats = $Boekingen[$key]['Plaats'];
                
                $stmt = $db->query("SELECT `Plaatje` FROM `bestemming` WHERE `Land` = '".$Land."' AND `Plaats` = '".$Plaats."'");
                $Bestemmingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>
            <a href="#" style="text-decoration: none;color: black">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen[0]['Plaatje']).'" class="img-fluid rounded-start"/>';?>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $Boeking['Plaats'].", ".$Boeking['Land']; ?></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <div style="float: right;">
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-users"></i><?php echo " ".$Boeking['Personen']; ?></small></p>
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-clock"></i><?php echo " ".$Boeking['Duur']." Dagen"; ?></small></p>
                                    <p class="card-text"><small class="text-muted"><i class="fas fa-calendar-alt"></i></i><?php echo " ".$Boeking['Vertrekdatum']; ?></small></p>
                                </div>
                                <p class="card-text" style="margin-top: 6%;"><small class="text-muted">Boekingsdatum</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
    </body>
</html>
<?php include_once 'footer.php'; ?>