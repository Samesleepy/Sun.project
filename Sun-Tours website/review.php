<?php include_once 'header.php' ?>
   <head>
      <title>Login</title>
      <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
      <link rel="stylesheet" href="test.css"/>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
   </head>
   <body>
      <div class="card bg-light">
         <div class="card-body mx-auto" style="max-width: 800px;">
            <div class="jumbotron text-center">
               <h1>Schrijf een review!<h1>
            </div>

            <form method="post">
              <select class="form-select form-select-sm" id="inputGroupSelect01" name="score" required>
                  <option value="">Score: </option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
              </select>
               <div class="input-group">
                 <span class="input-group-text">Uw review: </span>
                 <textarea class="form-control"  name="review"></textarea>
              </div>

               <div class="form-group">
                  <div class="text-center">
                     <button type="submit" name="submit" class="btn btn-primary btn-block">Verstuur</button>
                  </div>
               </div>
            </form>
            <?php

            if(isset($_POST['submit'])){

              $voornaam = $_SESSION['Voornaam'];
              $achternaam = $_SESSION['Achternaam'];
              $tussenvoegsel = $_SESSION['Tussenvoegsel'];
              $score = $_POST['score'];
              $review = $_POST['review'];
              $datum = date('Y/m/d');

              $sql = "INSERT INTO `review`(`BestemmingID`,`Voornaam`, `Achternaam`, `Tussenvoegsel`, `Score`, `Opmerking`,`Datum`) VALUES(?,?,?,?,?,?,?)";

              $stmt= $conn->prepare($sql);
              $stmt->execute([$id,$voornaam, $achternaam, $tussenvoegsel, $score, $review, $datum]);
              unset($_POST['submit']);
            }

            $stmt = $conn->prepare("SELECT `Voornaam`, `Achternaam`,`Tussenvoegsel`,`Score`, `Opmerking`, `Datum` FROM `review` WHERE `BestemmingID` = '".$id."'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $Reviews = $result;

            //print_r($Reviews);

               foreach ($Reviews as $review) {
             ?>
                        <div class="card">
                         <div class="card-body">
                            <h5 class="card-title"><?php echo $review['Voornaam'] . " " ;
                              if($review['Tussenvoegsel'] != ""){
                                 echo " " . $review['Tussenvoegsel'] . " ";
                              }
                            echo $review['Achternaam']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $review['Datum']?></h6>
                            <p class="card-text"><?php echo $review['Score'] ?></p>
                            <p class="card-text"><?php echo $review['Opmerking'] ?></p>

                         </div>
                      </div>
                    </div>
                    <?php }
                       ?>
         </div>
      </div>
   </body>
</html>
