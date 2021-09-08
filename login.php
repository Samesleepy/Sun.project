<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title></title>
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
        die("Connection failed: " . mysqli_connect_error());
      }
      echo "Connected Successfully. </br>";

      if(isset($_POST['submit'])){
              $email = mysqli_real_escape_string($conn, $_POST['email']);
              $wachtwoord = mysqli_real_escape_string($conn, $_POST['wachtwoord']);
              $sqlhashedpass = "SELECT `Wachtwoord` FROM `Klant` WHERE `Email`='".$email."'";
              //$resultpass = mysqli_query($conn,$sqlhashedpass);
              //$resultp = mysqli_fetch_assoc($resultpass);
              $resultpass = mysqli_fetch_assoc(mysqli_query($conn,$sqlhashedpass));
              //echo $resultp['Wachtwoord'];
              //echo "</br>";
              if(password_verify($wachtwoord, $resultpass['Wachtwoord'])){
                //echo "SUCCESSS SEdaefa";
                //echo "</br>";
              //$sql = "SELECT COUNT(*) as cntUser FROM `klant` WHERE `Email`='".$email."' AND `Wachtwoord`='".$wachtwoord."'";
                $sql = "SELECT COUNT(*) as cntUser FROM `klant` WHERE `Email`='".$email."'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);

                $count = $row['cntUser'];

                  if($count > 0){
                  //$_SESSION['email'] = $email;
                    echo "JE BENT INGELOGD";
                  //print_r($count);
              //}else{
              //    echo "VERKEERDE INFO";
              }
            }else{echo "Email of wachtwoord is fout";}
          }
        ?>


   </body>
</html>