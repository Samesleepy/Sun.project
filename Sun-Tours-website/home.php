<?php include_once 'header.php';?>


<body style="background-image: url('Pics/landscape-at-dawn.jpg'); background-size: cover;">
   <div class="card text-white bg-dark" style="margin-left:65%; margin-top: 6%; width:20%">
      <div class="card-body">
         <h3 class="card-title">
         Wij geloven dat iedereen een geweldige vakantie verdient!</h4>
         <h3 class="card-subtitle mb-2" style="opacity: 60%">
         Wat u ook zoekt, wij bieden het!</h5>
      </div>
   </div>

   <?php
   //dd($_SESSION['user']->role);

   if ($User->voornaam != ""){ //Als user ingelogd is
   echo '<a href="bestemmingen.php" class="btn btn-primary rounded" style="margin-left:65%; margin-top: 1%; width: 20%">Destinations</a>';
   }else{
   echo '<a href="signup.php" class="btn btn-primary rounded" style="margin-left:65%; margin-top: 1%; width: 20%">Register</a>';
   }
      ?>
</body>

<?php include_once 'footer.php';?>
