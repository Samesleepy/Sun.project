<?php
session_start();
include_once('db.php');
include_once('functionss.php');

$database = new Database();

if(isset($_POST['logout'])){
   session_destroy();
   header("Location: home.php");
}
?>

<html lang="nl" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Suntours</title>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="test.css"/>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container">

            <a href="home.php"><img src="Pics\Sun-Tours-logo.png" class="sun" alt="Suntours"></a>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="bestemmingen.php">Destinations</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="covid.php">Covid-19 Measures</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Language</a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#"><object data="Pics/flag-nl.svg" width="20" ></object> Dutch</a></li>
                        <li><a class="dropdown-item" href="#"><object data="Pics/flag-uk.svg" width="20" ></object> English</a></li>
                     </ul>
                  </li>
                  <object data="Pics/flag-uk.svg" width="20" ></object>
               </ul>

               <ul class="navbar-nav ms-auto">
               <?php if(isset($_SESSION['Voornaam'])){ ?>
                     <li class="nav-item" style="padding-right: 5px;">
                        <form method="post">
                           <button type='submit' name='logout' class='btn btn-danger btn-block'>Log out</button>
                        </form>
                     </li>
                  <?php }else{ ?>
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="signup.php">Register</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php">Log in</a>
                     </li>
                  <?php } ?>
                  <li class="nav-item">
                     <a class="navbar-text" aria-current="page">
                        <?php
                        if(isset($_SESSION['Voornaam'])){
                           echo "<div class='dropdown'>";
                           echo    "<a class='btn btn-primary dropdown-toggle' style='' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
                           echo $_SESSION['Voornaam'] . " " ;
                           if($_SESSION['Tussenvoegsel'] != ""){
                              echo " " . $_SESSION['Tussenvoegsel'] . " ";
                           }
                           echo $_SESSION['Achternaam'];
                           echo    "</a>";
                           echo    "<ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
                           echo        "<li><a class='dropdown-item' href='profiel.php'>My Account</a></li>";
                           if(/*$_SESSION['Role'] == 'Admin' ||*/ $_SESSION['Voornaam'] == 'Joey'){
                              echo     "<li><a class='dropdown-item' href='adminpage.php'>Admin page</a></li>";
                           }
                           echo        "<li><a class='dropdown-item' href='boekingen.php'>Bookings</a></li>";
                           echo    "</ul>";
                           echo "</div>";
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
