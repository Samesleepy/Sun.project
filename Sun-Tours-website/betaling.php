<?php
include_once 'header.php';

if(isset($_POST['submit'])){

    $boekingsdatum = Date("Y-m-d");
    //Maak instance boeking met info van de pagina en andere classes
    $Boeking = new Boeking($_SESSION['id'], $_SESSION['KlantID'], $_SESSION['Land'], $_SESSION['Plaats'], $_SESSION['Prijs'], $_SESSION['personen'], $_SESSION['vertrekdatum'], $_SESSION['boekingsdatum'], $_SESSION['duur'], $_SESSION['hotel'], $_SESSION['vervoer']);

    $Boeking->Boeken($database); //Boekt de reis, stuurt naar database en return BoekingID om zo factuur te kunnen laten zien
    unset($_SESSION['id'], $_SESSION['KlantID'], $_SESSION['Land'], $_SESSION['Plaats'], $_SESSION['Prijs'], $_SESSION['personen'], $_SESSION['vertrekdatum'], $_SESSION['boekingsdatum'], $_SESSION['duur'], $_SESSION['hotel'], $_SESSION['vervoer']);
}
 ?>

<body>
    <h1 class="text-center">Factuur</h1>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Land</label>
                <input name="woonplaats" class="form-control" value="<?php echo $_SESSION['Land']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Plaats</label>
                <input name="postcode" class="form-control" value="<?php echo $_SESSION['Plaats']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Duur</label>
                <input name="woonplaats" class="form-control" value="<?php echo $_SESSION['duur']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Personen</label>
                <input name="postcode" class="form-control" value="<?php echo $_SESSION['personen']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Hotel</label>
                <input name="woonplaats" class="form-control" value="<?php if(!$_SESSION['hotel'] == ""){echo $_SESSION['hotel'];}else{echo "Geen hotel";} ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Vervoer</label>
                <input name="postcode" class="form-control" value="<?php if(!$_SESSION['vervoer'] == ""){echo $_SESSION['vervoer'];}else{echo "Geen vervoer";} ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="woonplaats" class="form-label">Vertrekdatum</label>
                <input name="woonplaats" class="form-control" value="<?php echo $_SESSION['vertrekdatum']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="postcode" class="form-label">Boekingsdatum</label>
                <input name="postcode" class="form-control" value="<?php echo $_SESSION['boekingsdatum']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2" style="width:48.75%;">
                <label for="woonplaats" class="form-label">Prijs</label>
                <input name="woonplaats" class="form-control" value="<?php echo $_SESSION['Prijs']; ?>" type="text" disabled>
            </div>
              <input type="submit" name="submit" style="float: right;" value="Betalen" class="btn btn-primary btn-block w-100"/>
        </div>
    </div>

</body>

<?php
include_once 'footer.php';
?>
