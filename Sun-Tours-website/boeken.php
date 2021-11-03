<?php
//header
include_once 'header.php';

//no id error fix
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location: home.php");
}

$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.ID, bestemming.Land, bestemming.Plaats, bestemming.Type, bestemming.Prijs, bestemming.Beschrijving, bestemming.Limiet, bestemming.Plaatje, tableA.totalRes, tableB.avgRev from bestemming LEFT JOIN ( SELECT BestemmingID, SUM(personen) AS totalRes FROM boeking GROUP BY BestemmingID ) tableA ON bestemming.id = tableA.BestemmingID LEFT JOIN ( SELECT BestemmingID, AVG(score) AS avgRev FROM review GROUP BY BestemmingID ) tableB ON bestemming.id = tableB.BestemmingID WHERE bestemming.ID = '".$id."';");
$stmt->execute(); //Haal bestemminginfo, gemiddelde score van reviews en het totaal aantal reserveringen uit de database, doormiddel van een query met subqueries
$result = $stmt->fetch();
//dd($result);

$db = null; //verbreek de verbinding met de database

//zet de result in class
$Bestemming = new Bestemming($id, $result['Land'], $result['Plaats'],$result['Type'], $result['Prijs'], $result['Beschrijving'], $result['Limiet'], $result['Plaatje'], $result['avgRev'], $result['totalRes']);
$Bestemminginfo = $Bestemming->GetBestemmingInfo();
$Userinfo = $User->GetUserInfo();
//dd($Bestemminginfo);

//bereken prijs
$prijs = false;
if(isset($_POST['personen'])){
    $prijs = $_POST['personen'] * $_POST['duur'];
}else{
    $prijs = false;
}
if($prijs){
    $prijs = intval($prijs) * intval($Bestemminginfo['Prijs']);
}
$score = $Bestemminginfo['Score'];

//if form submitted
if(isset($_POST['submit'])){
    $boekingsdatum = Date("Y-m-d");
    $_SESSION['id'] = $id;
    $_SESSION['KlantID'] = $Userinfo['KlantID'];
    $_SESSION['Land'] = $Bestemminginfo['Land'];
    $_SESSION['Plaats'] = $Bestemminginfo['Plaats'];
    $_SESSION['Prijs'] = $prijs;
    $_SESSION['personen'] = $_POST['personen'];
    $_SESSION['vertrekdatum'] = $_POST['vertrekdatum'];
    $_SESSION['boekingsdatum'] = $boekingsdatum;
    $_SESSION['duur'] = $_POST['duur'];
    $_SESSION['hotel'] = $_POST['hotel'];
    $_SESSION['vervoer'] = $_POST['vervoer'];

    header("Location: betaling.php");
}
?><script>if(confirm("Druk op OK om te kopen voor <?php echo "€" . $prijs . ".00"; ?>")){alert("Betaald!");window.location.href = "factuur.php?id=<?php echo $Boeking->BoekingID ?>"}</script><?php

$db = $database->connection();
$stmt = $db->prepare("SELECT `Naam`,`Prijs` from hotel WHERE `BestemmingID` = '".$_GET['id']."';");
$stmt->execute(); //Haal naam van hotel uit database, hotels van de gekozen bestemming
$hotels = $stmt->fetchAll();
?>



<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="py-3 mb-5 text-center">
            <h1><?=  $text[$_SESSION['lang']]['boeken'][1] ?></h1>
            <p class="lead"><?=  $text[$_SESSION['lang']]['boeken'][2] ?></p>
        </div>
        <div class="row">
            <div class="col-4">
            <?php
            //check if user is logged in
            if(isset($_SESSION['user'])){
                //echo image
                echo '<h2>';
                    echo $Bestemminginfo['Plaats'].", ".$Bestemminginfo['Land'];
                echo '</h2>';
                echo '<img height="250px" style="max-width: 380px;" src="data:image/png;base64,'.base64_encode($Bestemminginfo['Plaatje']).'"/>';
                //echo score if isset
                echo "<div class='my-3'>";
                if(isset($score)){echo "<h5>". $text[$_SESSION['lang']]['boeken'][3]. "</h5><p>" . round($score,2) . "</p>";}

                echo '<h5>'. $text[$_SESSION['lang']]['boeken'][22]. '</h5><p>'.$Bestemminginfo['Beschrijving'].'</p>';

                ?>
                <h5><?=  $text[$_SESSION['lang']]['boeken'][4] ?></h5>
                <a href="https://www.nederlandwereldwijd.nl/documenten/vragen-en-antwoorden/welke-landen-hebben-welke-kleurcode" target="_blank"><?= $Bestemminginfo['Land'] ?></a>

                </div>
            </div>
            <div class="col-8">
                <h2 class="text-primary"><?=  $text[$_SESSION['lang']]['boeken'][5] ?></h2>
                <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
                    <div class="mb-2">
                        <label for="personen" class="form-label"><?=  $text[$_SESSION['lang']]['boeken'][6] ?></label>
                        <input id="personenveld" name="personen" class="form-control" placeholder="<?=  $text[$_SESSION['lang']]['boeken'][6] ?>" type="number" min="1" onkeyup="updatePrijs()"  required>
                    </div>
                    <div class="mb-2">
                        <label for="datum" class="form-label"><?=  $text[$_SESSION['lang']]['boeken'][7] ?></label>
                        <input name="vertrekdatum" class="form-control" min="<?php echo date("Y-m-d"); ?>" placeholder="MM/DD/YYYY" type="date" required>
                    </div>
                    <div class="mb-2">
                        <label for="dagen" class="form-label"><?=  $text[$_SESSION['lang']]['boeken'][8] ?></label>
                        <input id="dagenveld" name="duur" class="form-control" placeholder="Duur" type="number" min="1" onchange="updatePrijs()" required>
                    </div>
                    <div class="mb-2">
                        <label for="hotel" class="form-label"><?=  $text[$_SESSION['lang']]['boeken'][9] ?></label>
                        <select class="form-select" name="hotel" aria-label="Default select example" onchange='updatePrijsPP(this)' required id='hotel'>
                            <option value="" disabled selected hidden><?=  $text[$_SESSION['lang']]['boeken'][10] ?></option>
                            <?php
                            if(!$hotels == ""){ //Als hotels NIET leeg zijn
                                foreach($hotels as $hotel){
                                    echo "<option value=".$hotel['Naam']."'>".$hotel['Naam'] . "</option>";
                                }
                            }else{ //Wel leeg
                                echo "<option value='Niks' disabled>". $text[$_SESSION['lang']]['boeken'][11]."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="Vervoer" class="form-label"><?=  $text[$_SESSION['lang']]['boeken'][12] ?></label>
                        <select class="form-select" name="vervoer" aria-label="Default select example" required>
                            <option value="" disabled selected hidden><?=  $text[$_SESSION['lang']]['boeken'][13] ?></option>
                            <option value="Auto"><?=  $text[$_SESSION['lang']]['boeken'][14] ?></option>
                            <option value="Vliegtuig"><?=  $text[$_SESSION['lang']]['boeken'][15] ?></option>
                            <option value="Boot"><?=  $text[$_SESSION['lang']]['boeken'][16] ?></option>
                        </select>
                    </div>

                    <hr>

                    <div class="row g-5 my-1">
                        <div class="col-md-5 col-lg-4 order-md-last">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0"><?=  $text[$_SESSION['lang']]['boeken'][17] ?></h6>
                                        <small class="text-muted"><?=  $text[$_SESSION['lang']]['boeken'][18] ?></small>
                                    </div>
                                    <span id="prijsPP" class="text-muted"><?php echo "&euro;0.00 "; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?=  $text[$_SESSION['lang']]['boeken'][19] ?></span>
                                    <strong><div id="totaal" style="float:left;"><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0.00";} ?></div></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="submit" name="submit" style="float: right;" value="<?=  $text[$_SESSION['lang']]['boeken'][20] ?>" class="btn btn-primary btn-block w-100"/>
                </form>
            </div>

            <hr class="my-5">

            <?php
                //show reviews and alternatives
                include_once 'review.php';
                include_once 'alternatieven.php';
                }else{
                    echo "<p class='text-danger'>". $text[$_SESSION['lang']]['boeken'][21] ."</p>";
                }
            ?>
        </div>
    </div>
</body>
<script>
    //live update prijs
    function updatePrijs(){
        personen = document.getElementById('personenveld').value;
        dagen = document.getElementById('dagenveld').value;

        prijsPP = <?php echo $hotel['Prijs']; ?>;

        $totaal = prijsPP * personen * dagen;
        if(personen==""||dagen==""){
            document.getElementById('totaal').innerHTML = "€0.00";
        }else{
            result = personen * dagen * prijsPP;
            document.getElementById('totaal').innerHTML = "€" + $totaal + ".00";
        }
    }
    function updatePrijsPP(HotelPrijs){
        document.getElementById('prijsPP').innerHTML = "€" + <?php echo $hotel['Prijs']; ?> + ".00";
    }
</script>

<?php include 'footer.php';?>
