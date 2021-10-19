<?php
include_once 'header.php';
$db = $database->connection();

$stmt = $db->prepare("SELECT `Land`,`Plaats`,`Duur`,`Personen`,`Hotel`,`Vervoer`,`Vertrekdatum`,`Boekingsdatum`,`Prijs` FROM `boeking` WHERE `BoekingID` = '".$_GET['id']."'");
$stmt->execute();
$Boekingen = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <h1 class="text-center">Factuur</h1>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Land</label>
                <input name="woonplaats" class="form-control" value="<?php echo $Boekingen['Land']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Plaats</label>
                <input name="postcode" class="form-control" value="<?php echo $Boekingen['Plaats']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Duur</label>
                <input name="woonplaats" class="form-control" value="<?php echo $Boekingen['Duur']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Personen</label>
                <input name="postcode" class="form-control" value="<?php echo $Boekingen['Personen']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Hotel</label>
                <input name="woonplaats" class="form-control" value="<?php if(!$Boekingen['Hotel'] == ""){echo $Boekingen['Hotel'];}else{echo "Geen hotel";} ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Vervoer</label>
                <input name="postcode" class="form-control" value="<?php if(!$Boekingen['Vervoer'] == ""){echo $Boekingen['Vervoer'];}else{echo "Geen vervoer";} ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Vertrekdatum</label>
                <input name="woonplaats" class="form-control" value="<?php echo $Boekingen['Vertrekdatum']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Boekingsdatum</label>
                <input name="postcode" class="form-control" value="<?php echo $Boekingen['Boekingsdatum']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2" style="width:48.75%;">
                <label for="woonplaats" class="form-label">Prijs</label>
                <input name="woonplaats" class="form-control" value="<?php echo $Boekingen['Prijs']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
</body>

<?php
include_once 'footer.php';
?>
