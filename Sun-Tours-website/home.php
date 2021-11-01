<?php include_once 'header.php';
$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.ID, bestemming.Land, bestemming.Plaats, bestemming.Type, bestemming.Prijs, bestemming.Beschrijving, bestemming.Limiet, bestemming.Plaatje, tableA.totalRes, tableB.avgRev from bestemming LEFT JOIN ( SELECT BestemmingID, SUM(personen) AS totalRes FROM boeking GROUP BY BestemmingID ) tableA ON bestemming.id = tableA.BestemmingID LEFT JOIN ( SELECT BestemmingID, AVG(score) AS avgRev FROM review GROUP BY BestemmingID ) tableB ON bestemming.id = tableB.BestemmingID;");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Haal alle bestemmingen uit de database met hun info, haal daarbij ook de gemiddelde score van reviews op
$Bestemmingresult = $result;

foreach ($Bestemmingresult as $bestemming) { //Voor elke individuele bestemming die opgehaalt is
  $Bestemmingen[] = new Bestemming($bestemming['ID'], $bestemming['Land'], $bestemming['Plaats'], $bestemming['Type'], $bestemming['Prijs'], $bestemming['Beschrijving'], $bestemming['Limiet'], $bestemming['Plaatje'], $bestemming['avgRev'], $bestemming['totalRes']);
}//Maak instance bestemming aan in array met bijbehorende info uit de database
?>

<body class="mb-5">

<!-- <div class="container h-100">
   <div class="row align-items-center h-100">
      <div class="col-6 mx-auto">
         <div class="card text-white bg-dark mb-3" style="margin-top: -300px">
            <div class="card-body">
               <h3 class="card-title">
               Wij geloven dat iedereen een geweldige vakantie verdient!</h4>
               <h3 class="card-subtitle mb-2" style="opacity: 60%">
               Wat u ook zoekt, wij bieden het!</h5>
            </div>
         </div>
         <?php
            // if ($User->voornaam != ""){ //Als user ingelogd is
            // echo '<a href="bestemmingen.php" class="btn btn-primary btn-lg rounded fw-bold">Destinations</a>';
            // }else{
            // echo '<a href="signup.php" class="btn btn-primary btn-lg rounded fw-bold">Register</a>';
            // }
         ?>
      </div>
   </div>
</div> -->

   <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" height="450px">
      <div class="carousel-indicators">
         <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img src="Pics/header1.jpg" width="100%" height="450px" style="object-fit: cover;">

            <div class="container">
               <div class="carousel-caption text-start">
                  <h1 class="mb-3">Wij geloven dat iedereen een geweldige vakantie verdient!</h1>
                  <?php if (!$User->voornaam){
                     echo '<p><a class="btn btn-primary" href="signup.php">Registreren</a></p>';
                  }else{
                     echo '<p><a class="btn btn-primary" href="bestemmingen.php">Alle bestemmingen</a></p>';
                  } 
                  ?>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <img src="Pics/header2.jpeg" width="100%" height="450px" style="object-fit: cover;">

            <div class="container">
               <div class="carousel-caption">
                  <h1>Wat u ook zoekt, wij bieden het!</h1>
                  <p>Bekijk hier de huidige covid maatregelen.</p>
                  <p><a class="btn btn-primary" href="covid.php">Covid maatregelen</a></p>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <img src="Pics/header3.jpg" width="100%" height="450px" style="object-fit: cover;">

            <div class="container">
               <div class="carousel-caption text-end">
                  <h1>Neem contact op.</h1>
                  <p>Heeft u een vraag of een klacht? Neem dan gerust een kijkje op onze contact pagina.</p>
                  <p><a class="btn btn-primary" href="contact.php">Contact</a></p>
               </div>
            </div>
         </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
      </button>
   </div>

   <div class="container marketing py-5">
      <h1 class="display-8 text-center fw-bold lh-1 mb-3">Populaire bestemmingen</h1>
      <div class="row">
         <!-- foreach -->
         <?php 
            $i = 0;
            foreach ($Bestemmingen as $bestemming) {//haal individuele bestemmingen uit de array Bestemmingen, je hebt nu een bestemming
               echo "<div class='col-lg-4'>";
                  $bestemming->ShowBestemming(400);//laat bestemming zien in html-bootstrap card
               echo "</div>";

               $i++;
               if($i==3) break;
            }
         ?>
      </div>
   </div>

   <div class="container col-xxl-8 px-4 py-5">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
         <div class="col-10 col-sm-8 col-lg-6">
            <img src="Pics/landscape-at-dawn.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
         </div>
         <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Top ervaringen met Suntours</h1>
            <p class="lead">Wij hebben al meer als 100 klanten de mooiste ervaring van hun leven gegeven, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
         </div>
      </div>
   </div>
</body>



<?php include_once 'footer.php';?>
