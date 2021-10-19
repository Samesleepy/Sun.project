<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `boeking` ORDER BY `boeking`.`Boekingsdatum` DESC LIMIT 3;");
$stmt->execute();
$resultBoekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM `klant` ORDER BY `klant`.`KlantID` ASC LIMIT 3;");
$stmt->execute();
$resultKlanten = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM `contact` ORDER BY `contact`.`VraagID` ASC LIMIT 3;");
$stmt->execute();
$resultContacten = $stmt->fetchAll(PDO::FETCH_ASSOC);

$db = NULL;


?>

<div class="container py-4">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">Boekingen</div>
                <div class="card-body">
                    Hier komt een kleine lijst met de meest recente boekingen.
                    <br><br>
                    <a href="admin-boekingen.php" class="btn btn-primary">Alle boekingen</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">Klanten</div>
                <div class="card-body">
                    Hier komt een kleine lijst met de meest nieuwe klanten.
                    <br><br>
                    <a href="admin-klanten.php" class="btn btn-primary">Alle klanten</a>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">Vragen</div>
                <div class="card-body">
                    Hier komt een kleine lijst met de meest nieuwe vragen of klachten.
                    <br><br>
                    <a href="admin-vragen.php" class="btn btn-primary">Alle vragen</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once('admin-footer.php');
?>
