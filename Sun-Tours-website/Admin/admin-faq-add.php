<?php
include_once('admin-header.php');

if(isset($_POST['submit'])) {

  $FaqToAdd = new Faq(0, $_POST['Vraag-NL'], $_POST['Antwoord-NL'], $_POST['Vraag-EN'], $_POST['Antwoord-EN']);
  $FaqToAdd->AdminAddFaq($database);
}

?>
<body>
   <div class="container py-4 w-50">
      <div class="jumbotron text-center">
         <h1>
         Voeg FAQ toe
         <h1>
      </div>
      <form method="post" class="mb-5" enctype="multipart/form-data">
         <div class="row" class="mb-2">
            <div class="col">
               <label for="Vraag-NL" class="form-label">Vraag-NL</label>
               <div class="form-group input-group mb-2">
                  <input name="Vraag-NL" class="form-control" placeholder="Vraag-NL" type="text" required>
               </div>
            </div>
         </div>
         <label for="Antwoord-NL" class="form-label">Antwoord-NL</label>
         <div class="form-group input-group mb-2">
            <textarea  style="height: auto !important" class="form-control mb-4" name="Antwoord-NL" placeholder="Antwoord-NL" rows="3" required></textarea>
         </div>
         <div class="row">
            <div class="col">
               <label for="Vraag-EN" class="form-label">Vraag-EN</label>
               <div class="form-group input-group mb-2">
                  <input name="Vraag-EN" class="form-control" placeholder="Vraag-EN" type="text" required>
               </div>
            </div>
            <label for="Antwoord-EN" class="form-label">Antwoord-EN</label>
            <div class="form-group input-group mb-2">
               <textarea  style="height: auto !important" class="form-control" name="Antwoord-EN" placeholder="Antwoord-EN" rows="3" required></textarea>
            </div>
         </div>
         <div class="form-group mb-2">
            <div class="text-center">
               <button id="submit" type="submit" name="submit" class="btn btn-primary btn-block">Voeg FAQ toe</button>
            </div>
         </div>
      </form>
   </div>
</body>
</html>

<?php
include_once('admin-header.php');
 ?>
