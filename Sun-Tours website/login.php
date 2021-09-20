<?php
//session_start();
include_once 'header.php';
 ?>

   <head>
      <title>Login</title>
      <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
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

      if(isset($_POST['submit'])){
          $email = $_POST['email'];
          $sql = "SELECT COUNT(*) FROM `Klant` WHERE `Email` ='".$email."'";
          $result = $conn->query($sql);
          $count = $result->fetchColumn();
          if($count > 0){
              $wachtwoord = $_POST['wachtwoord'];
              $stmt = $conn->prepare("SELECT `Wachtwoord` FROM `Klant` WHERE `Email`='".$email."'");
              $stmt->execute();
              $resultpass = $stmt->fetch();
              if(password_verify($wachtwoord, $resultpass['Wachtwoord'])){
                  $stmt = $conn->prepare("SELECT * FROM `Klant` WHERE `Email`='".$email."'");
                  $stmt->execute();
                  $resultinfo = $stmt->fetch(PDO::FETCH_ASSOC);

              foreach ($resultinfo as $key => $klantinfo) {
                $_SESSION[$key] = $klantinfo;
                //echo $klantinfo . "</br>";
              }

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

<?php include_once 'footer.php' ?>
