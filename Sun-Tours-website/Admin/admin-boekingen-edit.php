<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `boeking` WHERE `BoekingID` = '".$_GET['BoekingID']."'");
$stmt->execute();
$boeking = $stmt->fetch();
$db = NULL;

$BoekingToEdit = new Boeking(0, 0, $boeking['Land'], $boeking['Plaats'], $boeking['Prijs'], $boeking['Personen'], $boeking['Vertrekdatum'], $boeking['Boekingsdatum'], $boeking['Duur'],$boeking['Hotel'],$boeking['Vervoer']);
$Boekinginfo = $BoekingToEdit->GetBoekingInfo();


if(isset($_POST['changeinfo'])){
  $BoekingToEdit->AdminUpdateBoeking($database, $_GET['BoekingID'], $_POST['land'], $_POST['plaats'], $_POST['prijs'], $_POST['personen'], $_POST['hotel'],$_POST['vervoer'],$_POST['vertrekdatum'],$_POST['boekingsdatum'],$_POST['duur']);
  header("Refresh:0");
}
?>
<body>
   <div class="container py-4 w-50">
      <div class="jumbotron text-center">
         <h1>
         Boeking wijzigen
         <h1>
      </div>
      <form method="post" class="mb-5">
         <div class="row">
            <div class="col-6">
               <div class="mb-2">
                  <label for="land" class="form-label">Land</label>
                  <input name="land" class="form-control" placeholder="land" value="<?php echo $Boekinginfo['Land'] ?> "type="text" required>
               </div>
            </div>
            <div class="col-6">
               <div class="mb-2">
                  <label for="plaats" class="form-label">Plaats</label>
                  <input name="plaats" class="form-control" placeholder="plaats" value="<?php echo $Boekinginfo['Plaats'] ?> "type="text" required>
               </div>
            </div>
         </div>
         <div class="mb-2">
            <label for="prijs" class="form-label">Prijs</label>
            <input name="prijs" class="form-control" placeholder="prijs" value="<?php echo $Boekinginfo['Prijs'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="personen" class="form-label">Personen</label>
            <input name="personen" class="form-control" placeholder="personen" value="<?php echo $Boekinginfo['Personen'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="hotel" class="form-label">Hotel</label>
            <input name="hotel" class="form-control" placeholder="hotel" value="<?php echo $Boekinginfo['Hotel'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="vervoer" class="form-label">Vervoer</label>
            <input name="vervoer" class="form-control" placeholder="vervoer" value="<?php echo $Boekinginfo['Vervoer'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="vertrekdatum" class="form-label">Vertrekdatum</label>
            <input name="vertrekdatum" class="form-control" placeholder="vertrekdatum" value="<?php echo $Boekinginfo['Vertrekdatum'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="boekeingsdatum" class="form-label">Boekingsdatum</label>
            <input name="boekingsdatum" class="form-control" placeholder="boekingsdatum" value="<?php echo $Boekinginfo['Boekingsdatum'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="duur" class="form-label">Duur</label>
            <input name="duur" class="form-control" placeholder="duur" value="<?php echo $Boekinginfo['Duur'] ?> "type="text" required>
         </div>
         <button type="submit" name="changeinfo" class="btn btn-primary btn-block w-100 my-2">Boeking Wijzigen</button>
      </form>
   </div>
</body>
<?php
include_once('admin-footer.php');
?>
