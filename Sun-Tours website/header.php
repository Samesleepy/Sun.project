<?php session_start();

$host = "localhost";
$username = "root";
$password = "";
$databaseName = "sunproject";

//connect to database
try {
  $conn = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed";//: " . $e->getMessage();
}

 ?>

<html lang="nl" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Suntours</title>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
      <!-- <link  rel="stylesheet" href="suntours.css" type ="text/css"/> -->
      <link rel="stylesheet" href="test.css"/>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container">

            <a href="home.php">  <img src="Pics\Sun-Tours-logo.png" class="sun" alt="Suntours">  </a>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home.php">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="bestemmingen.php">Bestemmingen</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="covid.php">Coronamaatregelen</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="signup.php">Registreren</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="login.php">Inloggen</a>
               </li>
             </ul>
               <!-- <div class="container-fluid">
                  <form class="d-flex">
                     <input class="form-control me-2" type="search" placeholder="Zoek" aria-label="Search">
                     <button class="btn btn-outline-success" type="submit">Zoek</button>
                  </form>
                </ul>
               </div> -->
              <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                  <a class="navbar-text" aria-current="page">
                    <form method="post">
                      <div class="form-group">
                        <div class="text-center">
                          <?php                                                                                     if(isset($_SESSION['Voornaam'])){
                              echo "<button type='submit' name='logout' class='btn btn-danger btn-block'>";
                              echo "Uitloggen";

                              if(isset($_POST['logout'])){
                                  session_destroy();
                              }
                          }  ?>
                          </button>
                        </div>
                      </div>
                    </form>
                  </a>
               </li>
               <li class="nav-item">
                 <a class="navbar-text" aria-current="page">
                   <?php
                   if(isset($_SESSION['Voornaam'])){
                     echo $_SESSION['Voornaam'] . " " ;
                       if($_SESSION['Tussenvoegsel'] != ""){
                         echo " " . $_SESSION['Tussenvoegsel'] . " ";
                       }
                      echo $_SESSION['Achternaam'];
                   }
                    ?>
                </a>
              </li>
             </ul>
            </div>
         </div>
      </nav>
      <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>
