<?php
//header
include_once 'header.php';

//no id error fix
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location: home.php");
}

//select avg score and other stuff
$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.ID, bestemming.Land, bestemming.Plaats, bestemming.Type, bestemming.Prijs, bestemming.Beschrijving, bestemming.Limiet, bestemming.Plaatje, tableA.totalRes, tableB.avgRev from bestemming LEFT JOIN ( SELECT BestemmingID, SUM(personen) AS totalRes FROM boeking GROUP BY BestemmingID ) tableA ON bestemming.id = tableA.BestemmingID LEFT JOIN ( SELECT BestemmingID, AVG(score) AS avgRev FROM review GROUP BY BestemmingID ) tableB ON bestemming.id = tableB.BestemmingID WHERE bestemming.ID = '".$id."';");
$stmt->execute();
$result = $stmt->fetch();
//dd($result);

$db = null;

//zet de result in class
$Bestemming = new Bestemming($id, $result['Land'], $result['Plaats'],$result['Type'], $result['Prijs'], $result['Beschrijving'], $result['Limiet'], $result['Plaatje'], $result['avgRev'], $result['totalRes']);
$Bestemminginfo = $Bestemming->GetBestemmingInfo();

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
    ?><script>if(confirm("Druk op OK om te kopen voor <?php echo "€" . $prijs . ".00"; ?>")){alert("Betaald!");<?php //echo Boeken(); ?>;window.location.href = "home.php<?php //echo $BoekingID; ?>"}</script><?php
}
$prijspp = $Bestemminginfo['Prijs'];
$score = $Bestemminginfo['Score'];

//if form submitted
if(isset($_POST['submit'])){
    //print_r($Userinfo);
    //$Bestemminginfo = $Bestemming->GetBestemmingInfo();
    $Userinfo = $User->GetUserInfo();
    $boekingsdatum = Date("Y-m-d");
    $Boeking = new Boeking($id, $Userinfo['KlantID'], $Bestemminginfo['Land'], $Bestemminginfo['Plaats'], $prijs, $_POST['personen'], $_POST['vertrekdatum'], $boekingsdatum, $_POST['duur']);
    $Boeking->Boeken($database);
}
?>

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
    }
</script>

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
                    echo $Bestemminginfo['Plaats'].",".$Bestemminginfo['Land'];
                echo '</h2>';
                echo '<img height="250px" style="max-width: 380px;" src="data:image/png;base64,'.base64_encode($Bestemminginfo['Plaatje']).'"/>';
                //echo score if isset
                echo "<div class='my-3'>";
                    if(isset($score)){echo "<h5> Score : " . round($score,2) . "</h5>";}
                echo "</div>";
            ?>
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
                        <select class="form-select" name="hotel" aria-label="Default select example">
                            <option selected>Kies hier uw hotel</option>
                            <option value="Hotel1">Hotel 1</option>
                            <option value="Hotel2">Hotel 2</option>
                            <option value="Hotel3">Hotel 3</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="Vervoer" class="form-label">Kies je vervoer</label>
                        <select class="form-select" name="hotel" aria-label="Default select example">
                            <option selected>Kies hier uw vervoer</option>
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
                                    <span id="prijsPP" class="text-muted"><?php echo "&euro;" . $Bestemminginfo['Prijs'] . " "; ?></span>
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
            <?php
                }else{
                    echo "<p class='text-danger'>Log eerst in</p>";
                }
                //show reviews and alternatives
                // include_once 'review.php';
                // include_once 'alternatieven.php';

            ?>
        </div>
    </div>
</body>

<?php include 'footer.php';?>
