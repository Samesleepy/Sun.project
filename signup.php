

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Registreer</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
     <script>function checkpass() {
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
                  <input name="postcode" class="form-control" placeholder="Postcode" type="text" required>
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

            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $databaseName = "sunproject";

            //connect to database
            $conn = mysqli_connect($host, $username, $password, $databaseName);

            if (!$conn) {
              die("Connection failed"); //: " . mysqli_connect_error());
            }
            //echo "Connected Successfully. </br>";
            if(isset($_POST['submit'])) {
              $voornaam = mysqli_real_escape_string($conn, $_POST['voornaam']);
              $tussenvoegsel = mysqli_real_escape_string($conn, $_POST['tussenvoegsel']);
              $achternaam = mysqli_real_escape_string($conn, $_POST['achternaam']);
              $email = mysqli_real_escape_string($conn, $_POST['email']);
              $telefoonnummer = mysqli_real_escape_string($conn, $_POST['telefoonnummer']);
              $wachtwoord = mysqli_real_escape_string($conn, $_POST['wachtwoord']);
              $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
              $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
              $straatnaam = mysqli_real_escape_string($conn, $_POST['straatnaam']);
              $huisnummer = mysqli_real_escape_string($conn, $_POST['huisnummer']);

              $sql = "INSERT INTO `klant`(`Voornaam`, `Achternaam`, `Tussenvoegsel`, `Email`, `Wachtwoord`, `Telefoonnummer`, `Postcode`, `Straatnaam`, `Huisnummer`)
              VALUES ('$voornaam', '$tussenvoegsel', '$achternaam','$email','$hashed_wachtwoord','$telefoonnummer','$postcode','$straatnaam','$huisnummer')";

              if(mysqli_query($conn, $sql)){
                echo "Account geregistreerd!";
              }else{
                echo "ERROR"; //$sql. " . mysqli_error($conn);
              }
            }

             ?>
         </div>
      </div>
   </body>
</html>
