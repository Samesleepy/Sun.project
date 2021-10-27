<?php include_once 'header.php';?>

<body>

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
            <img src="Pics/header1.webp" width="100%" height="450px" style="object-fit: cover;">

            <div class="container">
               <div class="carousel-caption text-start">
                  <h1>Example headline.</h1>
                  <p>Some representative placeholder content for the first slide of the carousel.</p>
                  <p><a class="btn btn-primary" href="#">Sign up today</a></p>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <img src="Pics/header2.jpeg" width="100%" height="450px" style="object-fit: cover;">

            <div class="container">
               <div class="carousel-caption">
                  <h1>Another example headline.</h1>
                  <p>Some representative placeholder content for the second slide of the carousel.</p>
                  <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <img src="Pics/landscape-at-dawn.jpg" width="100%" height="450px" style="object-fit: cover;">

            <div class="container">
               <div class="carousel-caption text-end">
                  <h1>One more for good measure.</h1>
                  <p>Some representative placeholder content for the third slide of this carousel.</p>
                  <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
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


   <!-- Marketing messaging and featurettes
   ================================================== -->
   <!-- Wrap the rest of the page in another container to center all the content. -->

   <div class="container marketing mt-5">

      <!-- Three columns of text below the carousel -->
      <div class="row">
         <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

            <h2>Heading</h2>
            <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
         </div><!-- /.col-lg-4 -->
         <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

            <h2>Heading</h2>
            <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
         </div><!-- /.col-lg-4 -->
         <div class="col-lg-4">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

            <h2>Heading</h2>
            <p>And lastly this, the third column of representative placeholder content.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
         </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

   </div>

</body>



<?php include_once 'footer.php';?>
