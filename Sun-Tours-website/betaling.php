<?php
include_once 'header.php';

if(isset($_POST['submit'])){

    //Maak instance boeking met info van de pagina en andere classes
    $Boeking = new Boeking($_SESSION['id'], $_SESSION['KlantID'], $_SESSION['Land'], $_SESSION['Plaats'], $_SESSION['Prijs'], $_SESSION['personen'], $_SESSION['vertrekdatum'], $_SESSION['boekingsdatum'], $_SESSION['duur'], $_SESSION['hotel'], $_SESSION['vervoer']);

    //dd($Boeking);
    $Boeking->Boeken($database); //Boekt de reis, stuurt naar database en return BoekingID om zo factuur te kunnen laten zien
    unset($_SESSION['id'], $_SESSION['KlantID'], $_SESSION['Land'], $_SESSION['Plaats'], $_SESSION['Prijs'], $_SESSION['personen'], $_SESSION['vertrekdatum'], $_SESSION['boekingsdatum'], $_SESSION['duur'], $_SESSION['hotel'], $_SESSION['vervoer']);

    header("Location: home.php");
}
?>

<body>
  <form method="post">
    <h1 class="text-center"><?=  $text[$_SESSION['lang']]['betaling'][1] ?></h1>
    <div class="row" style="width:50%;margin-left:25%;">
      <div class="col">
          <div class="mb-2">
            <label for="woonplaats" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][2] ?></label>
            <input name="land" class="form-control" value="<?php echo $_SESSION['Land']; ?>" type="text" disabled>
          </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="plaats" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][3] ?> </label>
                <input name="plaats" class="form-control" value="<?php echo $_SESSION['Plaats']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="duur" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][4] ?></label>
                <input name="duur" class="form-control" value="<?php echo $_SESSION['duur']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="personen" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][5] ?></label>
                <input name="personen" class="form-control" value="<?php echo $_SESSION['personen']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="hotel" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][6] ?></label>
                <input name="hotel" class="form-control" value="<?php if(!$_SESSION['hotel'] == ""){echo $_SESSION['hotel'];}else{echo "Geen hotel";} ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="vervoer" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][7] ?></label>
                <input name="vervoer" class="form-control" value="<?php if(!$_SESSION['vervoer'] == ""){echo $_SESSION['vervoer'];}else{echo "Geen vervoer";} ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2">
                <label for="vertrekdatum" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][8] ?></label>
                <input name="vertrekdatum" class="form-control" value="<?php echo $_SESSION['vertrekdatum']; ?>" type="text" disabled>
            </div>
        </div>
        <div class="col">
            <div class="mb-2">
                <label for="boekingsdatum" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][9] ?></label>
                <input name="boekingsdatum" class="form-control" value="<?php echo $_SESSION['boekingsdatum']; ?>" type="text" disabled>
            </div>
        </div>
    </div>
    <div class="row" style="width:50%;margin-left:25%;">
        <div class="col">
            <div class="mb-2" style="width:48.75%;">
                <label for="prijs" class="form-label"><?=  $text[$_SESSION['lang']]['betaling'][10] ?></label>
                <input name="prijs" class="form-control" value="<?php echo $_SESSION['Prijs']; ?>" type="text" disabled>
            </div>
              <input type="submit" name="submit" style="float: right;" value="<?=  $text[$_SESSION['lang']]['betaling'][11] ?>" class="btn btn-primary btn-block w-100"/>
        </div>
  </form>
    </div>
</body>

<?php
include_once 'footer.php';
?>
