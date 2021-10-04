<?php
include_once 'header.php';
?>
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
                     <button type="submit" name="submit" class="btn btn-primary btn-block mb-5">Log in</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <?php

      if(isset($_POST['submit'])){
         $db = $database->connection();
         $email = $_POST['email'];
         $sql = "SELECT COUNT(*) FROM `Klant` WHERE `Email` ='".$email."'";
         $result = $db->query($sql);
         $count = $result->fetchColumn();
         if($count > 0){
            $wachtwoord = $_POST['wachtwoord'];
            $stmt = $db->prepare("SELECT `Wachtwoord` FROM `Klant` WHERE `Email`='".$email."'");
            $stmt->execute();
            $resultpass = $stmt->fetch();
            if(password_verify($wachtwoord, $resultpass['Wachtwoord'])){
               $stmt = $db->prepare("SELECT * FROM `Klant` WHERE `Email`='".$email."'");
               $stmt->execute();
               $resultinfo = $stmt->fetch(PDO::FETCH_ASSOC);

               foreach ($resultinfo as $key => $klantinfo) {
                  $_SESSION[$key] = $klantinfo;
               }
               header("Location: home.php");
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
