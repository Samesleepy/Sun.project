<?php include_once 'header.php' ?>

<html>
   <head>
      <!-- <link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
      <link rel="stylesheet" href="test.css"/>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/> -->
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
               <div class="input-group mt-3">
                  <span class="input-group-text">Uw review: </span>
                  <textarea class="form-control"  name="review"></textarea>
               </div>
               <div class="form-group">
                  <div class="text-center">
                     <button type="submit" name="submitr" class="btn btn-primary mt-3 btn-block">Verstuur</button>
                  </div>
               </div>
            </form>
            <?php

            //print_r($Bestemminginfo);
             if(isset($_POST['submitr'])){
               $Reviewdate = date('Y/m/d');
               $Bestemminginfo = $Bestemming->GetBestemmingInfo();
               //print_r($Bestemminginfo['ID']);

               $Review = new Review($Bestemminginfo['ID'], $Userinfo['Voornaam'], $Userinfo['Achternaam'], $Userinfo['Tussenvoegsel'],$_POST['score'], $_POST['review'], $Reviewdate);
               //print_r($Review->BestemmingID);
               $Review->CreateReview($database);
             }

            $stmt = $db->prepare("SELECT `Voornaam`, `Achternaam`,`Tussenvoegsel`,`Score`, `Opmerking`, `Datum` FROM `review` WHERE `BestemmingID` = '".$Bestemminginfo['ID']."'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $Reviewsresult = $result;
            //dd($Reviewsresult);

            foreach ($Reviewsresult as $Reviews){
              $Reviews = new Review($Bestemminginfo['ID'], $Reviews['Voornaam'], $Reviews['Achternaam'], $Reviews['Tussenvoegsel'], $Reviews['Score'], $Reviews['Opmerking'], $Reviews['Datum']);
              $Reviews->ShowReview();
            }
            ?>
         </div>
      </div>
   </body>
</html>
