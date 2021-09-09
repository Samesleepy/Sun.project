<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
      <div class="card bg-light">
         <div class="card-body mx-auto" style="max-width: 800px;">
            <div class="jumbotron text-center">
               <h1>Log in<h1>
            </div>
            <form method="post">
               <div class="form-group input-group">
                  <input name="email" class="form-control" placeholder="E-mail" type="email" required>
               </div>
                     <div class="form-group input-group">
                        <input name="wachtwoord" class="form-control" placeholder="Wachtwoord" type="password" required>
                     </div>
                  </div>

               <div class="form-group">
                  <div class="text-center">
                     <button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <?php

      $host = "localhost";
      $username = "root";
      $password = "";
      $databaseName = "sunproject";

      //connect to database
      $conn = mysqli_connect($host, $username, $password, $databaseName);

      if (!$conn) {
        die("Connection failed");
      }
      //echo "Connected Successfully. </br>";

      if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sqlemail = "SELECT COUNT(*) FROM `Klant` WHERE `Email`='".$email."'";
        $resultemail = mysqli_fetch_array(mysqli_query($conn, $sqlemail));
        if($resultemail[0] > 0){
          $wachtwoord = mysqli_real_escape_string($conn, $_POST['wachtwoord']);
          $sqlhashedpass = "SELECT `Wachtwoord` FROM `Klant` WHERE `Email`='".$email."'";
          $resultpass = mysqli_fetch_assoc(mysqli_query($conn,$sqlhashedpass));
            if(password_verify($wachtwoord, $resultpass['Wachtwoord'])){
              $sqlinfo = "SELECT * FROM `Klant` WHERE `Email`='".$email."'";
              $resultinfo = mysqli_fetch_assoc(mysqli_query($conn, $sqlinfo));
              $_SESSION['email'] = $email;
              $_SESSION['Voornaam'] = $resultinfo['Voornaam'];

              echo "Welkom: " . $resultinfo['Voornaam'] . " " ;
              if($resultinfo['Tussenvoegsel'] != ""){
                echo " " . $resultinfo['Tussenvoegsel'] . " ";
              }
              echo $resultinfo['Achternaam'] . "!";
              //print_r($resultinfo);
            }else{
              echo "Wachtwoord is fout";
          }
        }else{
        echo "Email is fout";}
      }
        ?>
   </body>
</html>
