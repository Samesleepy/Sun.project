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
$prijspp = $Bestemminginfo['Prijs'];
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
            <h1>Boeken</h1>
            <p class="lead">Hieronder kunt u uw reis boeken. Links ziet u meer info over de reis en rechts kunt u alle gegevens invullen die nodig zijn voor het boeken.</p>
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
                    if(isset($score)){echo "<h5> Review Score : " . round($score,2) . "</h5>";} 

                    <p>

                    </p>
                    ?>
                </div>
            </div>
            <div class="col-8">
                <h2 class="text-primary">Booking info</h2>
                <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
                    <div class="mb-2">
                        <label for="personen" class="form-label">Aantal personen</label>
                        <input id="personenveld" name="personen" class="form-control" placeholder="Personen" type="number" min="1" onkeyup="updatePrijs()"  required>
                    </div>
                    <div class="mb-2">
                        <label for="datum" class="form-label">Vertrek datum</label>
                        <input name="vertrekdatum" class="form-control" min="<?php echo date("Y-m-d"); ?>" placeholder="MM/DD/YYYY" type="date" required>
                    </div>
                    <div class="mb-2">
                        <label for="dagen" class="form-label">Aantal dagen</label>
                        <input id="dagenveld" name="duur" class="form-control" placeholder="Duur" type="number" min="1" onkeyup="updatePrijs()" required>
                    </div>
                    <div class="mb-2">
                        <label for="hotel" class="form-label">Kies je hotel</label>
                        <select class="form-select" name="hotel" aria-label="Default select example" onchange='updatePrijsPP(this)' required id='hotel'>
                            <option value="" disabled selected hidden>Kies hier uw hotel</option>
                            <?php
                            if(!$hotels == ""){ //Als hotels NIET leeg zijn
                                foreach($hotels as $hotel){
                                echo "<option value=".$hotel['Naam']."'>".$hotel['Naam'] . " (&euro;" . $hotel['Prijs']. ")</option>";

                                }
                            }else{ //Wel leeg
                                echo "<option value='Niks' disabled>Geen hotels</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="Vervoer" class="form-label">Kies je vervoer</label>
                        <select class="form-select" name="vervoer" aria-label="Default select example" required>
                            <option value="" disabled selected hidden>Kies hier uw vervoer</option>
                            <option value="Auto">Auto</option>
                            <option value="Vliegtuig">Vliegtuig</option>
                            <option value="Boot">Boot</option>
                        </select>
                    </div>

                    <hr>

                    <div class="row g-5 my-1">
                        <div class="col-md-5 col-lg-4 order-md-last">
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">Prijs p.p.</h6>
                                        <small class="text-muted">Prijs per persoon</small>
                                    </div>
                                    <span id="prijsPP" class="text-muted"><?php echo "&euro;0.00 "; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Totaal</span>
                                    <strong><div id="totaal" style="float:left;"><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0.00";} ?></div></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="submit" name="submit" style="float: right;" value="Naar betalen" class="btn btn-primary btn-block w-100"/>
                </form>
            </div>

            <hr class="my-5">

            <?php
                //show reviews and alternatives
                include_once 'review.php';
                include_once 'alternatieven.php';
                }else{
                    echo "<p class='text-danger'>Log eerst in</p>";
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
        prijspp_str = document.getElementById('prijsPP').innerHTML;

        prijspp = prijspp_str.substr(1,prijspp_str.length-5);
        prijsint = parseInt(prijspp);
        if(personen==""||dagen==""){
            document.getElementById('totaal').innerHTML = "€0.00";
        }else{
            result = personen * dagen * prijsint;
            document.getElementById('totaal').innerHTML = "€" + result + ".00";
        }
        var e = document.getElementById("hotel");
        var a = array(60,50,50); // alle options prijzenb
        alert(a[e.selectedIndex]);
    }
    function updatePrijsPP(HotelPrijs){
        document.getElementById('prijsPP').innerHTML = <?php echo $hotel['Prijs']; ?>;
    }
</script>

<?php include 'footer.php';?>
