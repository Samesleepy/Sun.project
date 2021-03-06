<?php
include_once 'header.php';

if(isset($_POST['submit'])) {
  $User = new User;
  $User->Signup($database,$_POST['voornaam'],$_POST['achternaam'], $_POST['tussenvoegsel'],$_POST['email'],$_POST['telefoonnummer'],
  $hashed_wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT),
  $_POST['land'],$_POST['woonplaats'],$_POST['postcode'], $_POST['straatnaam'],
  $_POST['huisnummer']);
}
if($User->voornaam != ""){
             header("Location: home.php");
           }
?>

   <head>
      <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
   </head>
   <body>
      <script>
         function checkpass() {
            if (document.getElementById('wachtwoord').value == document.getElementById('wachtwoordh').value) {
                  document.getElementById('submit').disabled = false;
            }else{
            document.getElementById('submit').disabled = true;
            }
         }
      </script>
      <div class="card bg-light">
         <div class="card-body mx-auto" style="max-width: 800px;">
            <div class="jumbotron text-center">
               <h1>Registreer hier<h1>
            </div>
            <p class="text-center">Maak een gratis account</p>
            <form method="post">
               <div class="row">
                  <div class="col">
                     <div class="form-group input-group">
                        <input name="voornaam" class="form-control" placeholder="Voornaam" type="text" required>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group input-group">
                        <input name="tussenvoegsel" class="form-control" placeholder="Tussenvoegsel" type="text">
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group input-group">
                        <input name="achternaam" class="form-control" placeholder="Achternaam" type="text" required>
                     </div>
                  </div>
               </div>
               <div class="form-group input-group">
                  <input name="email" class="form-control" placeholder="E-mail" type="email" required>
               </div>
               <div class="form-group input-group">
                  <input name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" type="text" required>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group input-group">
                        <input id="wachtwoord" name="wachtwoord" class="form-control" placeholder="Wachtwoord" type="password" required onchange='checkpass();'>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group input-group">
                        <input id="wachtwoordh" name="wachtwoordh" class="form-control" placeholder="Herhaal wachtwoord" type="password" required onchange='checkpass();'>
                     </div>
                  </div>
               </div>
               <div class="form-group input-group">
                  <input name="land" class="form-control" placeholder="Land" type="text" required>
               </div>
               <div class="form-group input-group">
                  <input name="postcode" class="form-control" placeholder="Postcode" type="text" required>
               </div>
               <div class="form-group input-group">
                  <input name="woonplaats" class="form-control" placeholder="Woonplaats" type="text" required>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group input-group">
                        <input name="straatnaam" class="form-control" placeholder="Straatnaam" type="text" required>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group input-group">
                        <input name="huisnummer" class="form-control" placeholder="Huisnummer" type="text" required>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="text-center">
                     <button id="submit" type="submit" name="submit" class="btn btn-primary btn-block">Maak Account</button>
                  </div>
               </div>
               <p class="text-center">Heb je al een account?<a href="">Log In</a> </p>
            </form>
         </div>
      </div>
   </body>
</html>

<?php include_once 'footer.php' ?>
