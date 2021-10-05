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
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen[0]['Plaatje']).'" class="img-fluid rounded-start"/>';?>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $Boeking['Plaats'].", ".$Boeking['Land']; ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-users"></i><?php echo " ".$Boeking['Personen']; ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </body>
</html>
<?php include_once 'footer.php'; ?>