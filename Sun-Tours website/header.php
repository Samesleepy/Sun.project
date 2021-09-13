<?php session_start(); ?>

<html lang="nl" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Suntours</title>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
      <link  rel="stylesheet" href="suntours.css" type ="text/css"/>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container">
            <a class="navbar-brand" href="home.php">
            <img src="Pics\Sun-Tours-logo.png" class="sun" alt="Suntours">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home.php">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Bestemmingen</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Coronamaatregelen</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="signup.php">Registreren</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="login.php">Inloggen</a>
               </li>
               <!-- <div class="container-fluid">
                  <form class="d-flex">
                     <input class="form-control me-2" type="search" placeholder="Zoek" aria-label="Search">
                     <button class="btn btn-outline-success" type="submit">Zoek</button>
                  </form>
                </ul>
               </div> -->
               <li class="nav-item ml-auto">
                  <a class="navbar-text" aria-current="page">
                  <?php
                  //print_r($_SESSION);
                  if(isset($_SESSION['Voornaam'])){
                     echo $_SESSION['Voornaam'] . " " ;
                     if($_SESSION['Tussenvoegsel'] != ""){
                       echo " " . $_SESSION['Tussenvoegsel'] . " ";
                     }
                     echo $_SESSION['Achternaam'];
                   }
                     //print_r($_SESSION);
                     ?>
                  </a>
               </li>
            </div>
         </div>
      </nav>
      <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>
