<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `boeking` ORDER BY `boeking`.`BoekingID` DESC LIMIT 3;");
$stmt->execute();
$Boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT COUNT(*) FROM `klant`;");
$stmt->execute();
$countKlanten = $stmt->fetch();
$aantalKlanten = $countKlanten[0];

$stmt = $db->prepare("SELECT * FROM `contact` WHERE `Afgehandeld` = 'N' ORDER BY `contact`.`VraagID` ASC LIMIT 3;");
$stmt->execute();
$Vragen = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT COUNT(*) FROM `klant` WHERE `Land` = 'Netherlands';");
$stmt->execute();
$countKlantenNL = $stmt->fetch();
$aantalKlantenNL = $countKlantenNL[0];

$stmt = $db->prepare("SELECT COUNT(*) FROM `klant` WHERE NOT `Land` = 'Netherlands';");
$stmt->execute();
$countKlantenNotNL = $stmt->fetch();
$aantalKlantenNotNL = $countKlantenNotNL[0];

$db = NULL;

?>

<div class="container py-4">
    <h1 class="text-center">Dashboard</h1>
    <br>
    <div class="row">
        <div class="col-sm">
            <div class="card bg-dark" style="height: 250px">
                <div class="card-header text-white text-center"><b>Recente boekingen</b></div>
                <div class="card-body text-white">
                    <table class="table table-sm text-white">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Klant</th>
                                <th>Locatie</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($Boekingen as $key => $boeking) {
                            echo "<tr>";
                                echo "<th>". $boeking['BoekingID'] ."</th>";
                                echo "<td>". $boeking['KlantID'] ."</td>";
                                echo "<td>". $boeking['Land'].", ". $boeking['Plaats'] ."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <a href="admin-boekingen-index.php" class="btn btn-primary align-bottom">Alle boekingen</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card bg-dark" style="height: 250px">
                <div class="card-header text-white text-center"><b>Recent klanten</b></div>
                <div class="card-body text-white">
                    <div style="display: flex; justify-content: space-between;" class="mt-1">
                        <p>Aantal geregistreerde klanten:</p>
                        <p><span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php echo $aantalKlanten ?></span></p>
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="mt-1">
                        <p>Aantal klanten uit Nederland:</p>
                        <p><span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php echo $aantalKlantenNL ?></span></p>
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="mt-1">
                        <p>Aantal niet Nederlanders:</p>
                        <p><span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php echo $aantalKlantenNotNL ?></span></p>
                    </div>
                    <a href="admin-klanten-index.php" class="btn btn-primary align-bottom">Alle klanten</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card bg-dark" style="height: 250px">
                <div class="card-header text-white text-center"><b>Recente onafgehandelde Vragen</b></div>
                <div class="card-body text-white">
                    <?php if(!empty($Vragen)){ ?>
                    <table class="table table-sm text-white">
                        <thead>
                            <tr>
                                <th>Klant</th>
                                <th>Vraag</th>
                                <th>Beantwoord</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($Vragen as $key => $vraag) {
                            echo "<tr>";
                                echo "<th>". $vraag['KlantID'] ."</th>";
                                echo "<td>". $vraag['Onderwerp'] ."</td>";
                                echo "<td>". $vraag['Afgehandeld'] ."ee</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php }else{ ?>
                        <p>Alle vragen zijn afgehandeld :)<p>
                    <?php } ?>
                    <a href="admin-vragen-index.php" class="btn btn-primary">Alle vragen</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once('admin-footer.php');
?>
