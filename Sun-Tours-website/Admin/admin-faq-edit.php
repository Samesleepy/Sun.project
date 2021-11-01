<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `faq` WHERE `QID` = '".$_GET['QID']."'");
$stmt->execute();
$faq = $stmt->fetch();
$db = NULL;

$FaqToEdit = new Faq($_GET['QID'], $faq['Vraag-NL'], $faq['Antwoord-NL'], $faq['Vraag-EN'], $faq['Antwoord-EN'] );
$Faqinfo = $FaqToEdit->GetFaqInfo();

if(isset($_POST['changeinfo'])){
  $FaqToEdit->AdminUpdateFaq($database, $_POST['Vraag-NL'], $_POST['Antwoord-NL'], $_POST['Vraag-EN'], $_POST['Antwoord-EN']);
  header("Refresh:0");
}
?>

<body>
   <div class="container py-4 w-50">
      <div class="jumbotron text-center">
         <h1>
         FAQ wijzigen
         <h1>
      </div>
      <form method="post" class="mb-5">
         <div class="col">
            <div class="mb-2">
               <label for="Vraag-NL" class="form-label">Vraag-NL</label>
               <input name="Vraag-NL" class="form-control" placeholder="Vraag-NL" value="<?php echo $Faqinfo['Vraag-NL'] ?> "type="text" required>
            </div>
         </div>
         <div class="col">
            <div class="mb-2">
               <label for="Antwoord-NL" class="form-label">Antwoord-NL</label>
               <textarea name="Antwoord-NL" class="form-control mb-5" placeholder="Antwoord-NL" value="<?php echo $Faqinfo['Antwoord-NL'] ?> "type="textarea" rows="3" required ><?php echo $Faqinfo['Antwoord-NL'] ?></textarea>
            </div>
         </div>
         <div class="mb-2">
            <label for="Vraag-EN" class="form-label">Vraag-EN</label>
            <input name="Vraag-EN" class="form-control" placeholder="Vraag-EN" value="<?php echo $Faqinfo['Vraag-EN'] ?> "type="text" required>
         </div>
         <div class="mb-2">
            <label for="Antwoord-EN" class="form-label">Antwoord-EN</label>
            <textarea name="Antwoord-EN" class="form-control" placeholder="Antwoord-EN" value="<?php echo $Faqinfo['Antwoord-EN'] ?> "type="textarea" rows="3" required><?php echo $Faqinfo['Antwoord-EN'] ?></textarea>
         </div>
         <button type="submit" name="changeinfo" class="btn btn-primary btn-block w-100 my-2 mt-3">FAQ Wijzigen</button>
      </form>
   </div>
</body>

<?php
include_once('admin-footer.php');
?>
