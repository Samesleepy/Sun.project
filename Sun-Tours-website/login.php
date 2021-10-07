<?php
include_once 'header.php';

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
         echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Wachtwoord is fout</div>";
      }
   }else{
      echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Email is fout</div>";
   }
}
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
                        <input id="password" name="wachtwoord" class="form-control" placeholder="Wachtwoord" type="password" required>
                     </div>
                     <input type="checkbox" onchange="showHidePass(this)"><span id="showhidepass"> Show</span>
                  </div>

               <div class="form-group">
                  <div class="text-center">
                     <button type="submit" name="submit" class="btn btn-primary btn-block mb-5">Log in</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <script>
         function showHidePass(x){
            var checkbox=x.checked;
            if(checkbox){
               document.getElementById("password").type="text";
               document.getElementById("showhidepass").textContent=" Hide";
            }else{
               document.getElementById("password").type="password";
               document.getElementById("showhidepass").textContent=" Show";
            }
         }
      </script>
   </body>
</html>
<?php include_once 'footer.php' ?>