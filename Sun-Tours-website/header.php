<?php

//Include alle classes
include_once('Classes/db.php');
include_once('Classes/bestemmingClass.php');
include_once('Classes/userClass.php');
include_once('Classes/boekingClass.php');
include_once('Classes/faqClass.php');
include_once('Classes/reviewClass.php');
include_once('Classes/contactClass.php');
include_once('text.php');

//for testing
function dd($x){
   echo "<pre>";
   print_r($x);
   die();
   echo "</pre>";
}

//start de sessie 
session_start();
//maakt de connectie met de database via de class
$database = new Database();
//maakt een nieuwe user aan als die nog niet bestond
if(isset($_SESSION['user'])){
   $User = $_SESSION['user'];
}else{
   $User = new User();
}

//kijkt of language al geselecteerd is
if(isset($_GET['lang'])){
   //zo ja dan zet die deze op de geselecteerde taal
   $_SESSION['lang'] = $_GET['lang'];
}else{
   //zo niet zet die hem op NL (default)
   if(!isset($_SESSION['lang'])){
      $_SESSION['lang'] = 'NL';
   }
}

//als er op logout wordt dan destroyed die de sessie
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
      <script src="https://kit.fontawesome.com/e1d19818da.js" crossorigin="anonymous"></script>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-md-center">
         <div class="container">

            <a href="home.php"><img src="Pics\Sun-Tours-logo.png" class="sun" alt="Suntours"></a>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="bestemmingen.php"><?=  $text[$_SESSION['lang']]['header'][1] ?></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="covid.php"><?=  $text[$_SESSION['lang']]['header'][2] ?></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="contact.php"><?=  $text[$_SESSION['lang']]['header'][3] ?></a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=  $text[$_SESSION['lang']]['header'][4] ?></a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?lang=NL"><object data="Pics/flag-nl.svg" width="20" ></object> <?=  $text[$_SESSION['lang']]['header'][5] ?></a></li>
                        <li><a class="dropdown-item" href="?lang=EN"><object data="Pics/flag-uk.svg" width="20" ></object> <?=  $text[$_SESSION['lang']]['header'][6] ?></a></li>
                     </ul>
                  </li>
                  
                  <?php 
                  //laat het vlagetje zien achter de language switcher
                  if($_SESSION['lang'] == 'EN'){
                     echo "<object data='Pics/flag-uk.svg' width='20' ></object>";
                  }else{
                     echo "<object data='Pics/flag-nl.svg' width='20' ></object>";
                  } ?>
               </ul>

               <ul class="navbar-nav ms-auto">
               <?php if(isset($_SESSION['user'])){ //laat de menu items zien van een ingelogd persoon?>
                     <li class="nav-item" style="padding-right: 5px;">
                        <form method="post">
                           <button type='submit' name='logout' class='btn btn-danger btn-block'><?= $text[$_SESSION['lang']]['header'][7] ?> <i class="fas fa-sign-out-alt"></i></button>
                        </form>
                     </li>
                  <?php }else{ //laat de menu items zien van een niet iemand persoon?>
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="signup.php"><?= $text[$_SESSION['lang']]['header'][8] ?></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php"><?= $text[$_SESSION['lang']]['header'][9] ?></a>
                     </li>
                  <?php } ?>
                  <li class="nav-item">
                     <a class="navbar-text" aria-current="page">
                        <?php
                        //laat de dropdown zien als iemand is ingelogd
                        if(isset($_SESSION['user'])){
                           echo "<div class='dropdown'>";
                           echo    "<a class='btn btn-primary dropdown-toggle' style='' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
                           echo $User->voornaam . " " ;
                           if($User->tussenvoegsel != ""){
                              echo " " . $User->tussenvoegsel . " ";
                           }
                           echo $User->achternaam;
                           echo " <i class='fas fa-user'></i> ";
                           echo    "</a>";
                           echo    "<ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>";
                           echo        "<li><a class='dropdown-item' href='profiel.php'>". $text[$_SESSION['lang']]['profiel'][18]."</a></li>";
                           //als je een admin bent zie je de optie om naar het admin dashboard te gaan
                           if($_SESSION['user']->role == 'Admin'){
                              echo     "<li><a class='dropdown-item' href='admin/admin.php'>". $text[$_SESSION['lang']]['profiel'][19]."</a></li>";
                           }
                           echo        "<li><a class='dropdown-item' href='boekingen.php'>". $text[$_SESSION['lang']]['profiel'][20]."</a></li>";
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
      <!-- bootstrap & jquery includes -->
      <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
   </body>
