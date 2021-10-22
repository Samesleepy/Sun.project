<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `bestemming` WHERE `ID` = '".$_GET['BestemmingID']."'");
$stmt->execute();
$bestemming = $stmt->fetch();
$db = NULL;

$BestemmingToEdit = new Bestemming($_GET['BestemmingID'] ,$bestemming['Land'], $bestemming['Plaats'], $bestemming['Type'], $bestemming['Prijs'], $bestemming['Beschrijving'], $bestemming['Limiet'], $bestemming['Plaatje'], 0, 0);
$Bestemminginfo = $BestemmingToEdit->GetBestemmingInfo();

if(isset($_POST['changeinfo'])){
  $BestemmingToEdit->AdminUpdateBestemming($database, $_POST['land'], $_POST['plaats'], $_POST['type'], $_POST['prijs'], $_POST['limiet'], $_POST['beschrijving']);
  header("Refresh:0");
}
?>

<body>
   <div class="container py-4 w-50">
      <div class="jumbotron text-center">
         <h1>
         Bestemming wijzigen
         <h1>
      </div>
      <form method="post" class="mb-5">
         <div class="row">
            <div class="col-6">
               <div class="mb-2">
                  <label for="land" class="form-label">Land</label>
                  <input name="land" class="form-control" placeholder="land" value="<?php echo $Bestemminginfo['Land'] ?> "type="text" required>
               </div>
            </div>
            <div class="col-6">
               <div class="mb-2">
                  <label for="plaats" class="form-label">Plaats</label>
                  <input name="plaats" class="form-control" placeholder="plaats" value="<?php echo $Bestemminginfo['Plaats'] ?> "type="text" required>
               </div>
            </div>
         </div>
         <div class="mb-2">
            <label for="type" class="form-label">Type</label>
            <input name="type" class="form-control" placeholder="type" value="<?php echo $Bestemminginfo['Type'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="prijs" class="form-label">Prijs</label>
            <input name="prijs" class="form-control" placeholder="prijs" value="<?php echo $Bestemminginfo['Prijs'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="limiet" class="form-label">Limiet</label>
            <input name="limiet" class="form-control" placeholder="limiet" value="<?php echo $Bestemminginfo['Limiet'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="beschrijving" class="form-label">Beschrijving</label>
            <input name="beschrijving" class="form-control" placeholder="beschrijving" value="<?php echo $Bestemminginfo['Beschrijving'] ?> "type="text" required>
         </div>
         <button type="submit" name="changeinfo" class="btn btn-primary btn-block w-100 my-2">Bestemming Wijzigen</button>
      </form>
   </div>
</body>

<?php
include_once('admin-footer.php');
?>
