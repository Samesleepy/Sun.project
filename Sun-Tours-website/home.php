<?php include_once 'header.php';?>

<body style="background-image: url('Pics/landscape-at-dawn.jpg'); background-size: cover;">

<div class="container h-100">
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
            if ($User->voornaam != ""){ //Als user ingelogd is
            echo '<a href="bestemmingen.php" class="btn btn-primary btn-lg rounded fw-bold">Destinations</a>';
            }else{
            echo '<a href="signup.php" class="btn btn-primary btn-lg rounded fw-bold">Register</a>';
            }
         ?>
      </div>
   </div>
</div>

</body>



<?php include_once 'footer.php';?>
