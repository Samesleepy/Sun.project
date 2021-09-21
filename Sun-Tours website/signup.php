<?php include_once 'header.php' ?>

<html>
   <head>
      <title>Registreer</title>
      <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
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

            <?php

            function CheckDuplicateEmail($email, $conn){
              $sql = "SELECT COUNT(*) FROM `Klant` WHERE `Email` ='".$email."'";
              $result = $conn->query($sql);
              $count = $result->fetchColumn();

              if($count != 0){
                return False;
              }else{
                return True;
              }

            }
            if(isset($_POST['submit'])) {

              $voornaam = $_POST['voornaam'];
              $achternaam = $_POST['achternaam'];
              $tussenvoegsel = $_POST['tussenvoegsel'];
              $email = $_POST['email'];
              $telefoonnummer = $_POST['telefoonnummer'];
              $wachtwoord = $_POST['wachtwoord'];
              $hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
              $land = $_POST['land'];
              $woonplaats = $_POST['woonplaats'];
              $postcode = $_POST['postcode'];
              $straatnaam = $_POST['straatnaam'];
              $huisnummer = $_POST['huisnummer'];

              if(CheckDuplicateEmail($email, $conn)){

                $sql = "INSERT INTO `klant` (`Voornaam`, `Achternaam`, `Tussenvoegsel`, `Email`, `Wachtwoord`, `Telefoonnummer`,`Land`,`Woonplaats`, `Postcode`, `Straatnaam`, `Huisnummer`)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                $stmt= $conn->prepare($sql);
                $stmt->execute([$voornaam, $achternaam, $tussenvoegsel, $email, $hashed_wachtwoord, $telefoonnummer,$land , $woonplaats, $postcode, $straatnaam, $huisnummer]);

                // if(mysqli_query($conn, $sql)){
                //   echo "Account geregistreerd!";
                // }else{
                //   echo "ERROR"; //$sql. " . mysqli_error($conn);
                // }
              }else{
                echo "Email is al in gebruik!";
              }
            }

             ?>
         </div>
      </div>
   </body>
</html>

<?php include_once 'footer.php' ?>
