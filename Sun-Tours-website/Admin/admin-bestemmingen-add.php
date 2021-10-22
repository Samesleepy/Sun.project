<?php
include_once('admin-header.php');

if(isset($_POST['submit'])) {

  $afbeelding = addslashes(file_get_contents($_FILES['plaatje']['tmp_name']));

  $BestemmingToAdd = new Bestemming(0, $_POST['land'], $_POST['plaats'], $_POST['type'], $_POST['beschrijving'], $_POST['prijs'], $_POST['limiet'], $afbeelding, 0, 0);
  $BestemmingToAdd->AdminAddBestemming($database);
}

?>
   <head>
      <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
   </head>
   <body>
      	 <div class="container py-4 w-50">
            <div class="jumbotron text-center">
               <h1>Voeg bestemming toe<h1>
            </div>
            <form method="post" class="mb-5" enctype="multipart/form-data">
               <div class="row" class="mb-2">
                  <div class="col">
                     <div class="form-group input-group mb-2">
                       <!-- <label for="land" class="form-label">Land</label> -->
                        <input name="land" class="form-control" placeholder="Land" type="text" required>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group input-group mb-2">
                        <!-- <label for="plaats" class="form-label">Plaats</label> -->
                        <input name="plaats" class="form-control" placeholder="Plaats" type="text" required>
                     </div>
                  </div>
               </div>
               <div class="form-group input-group mb-2">
                    <select name="type" class="form-control">
                      <option value="Zomer">Zomer</option>
                      <option value="Winter">Winter</option>
                      <option value="Cultuur">Cultuur</option>
                      <option value="Stedentrip">Stedentrip</option>
                    </select>
               </div>
               <div class="form-group input-group mb-2">
                  <textarea  style="height: auto !important" class="form-control" name="beschrijving" placeholder="Beschrijving" rows="5" required></textarea>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group input-group mb-2">
                        <input name="prijs" class="form-control" placeholder="Prijs" type="text" required>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group input-group mb-2">
                        <input name="limiet" class="form-control" placeholder="Limiet" type="text" required>
                     </div>
                  </div>
               </div>
               <div class="input-group">
                 <input type="file" class="form-control" name="plaatje" aria-label="Upload">
               </div>
               <div class="form-group mb-2">
                  <div class="text-center">
                     <button id="submit" type="submit" name="submit" class="btn btn-primary btn-block">Voeg bestemming toe</button>
                  </div>
               </div>
            </form>
          </div>
   </body>
</html>

<?php
include_once('admin-header.php');
 ?>
