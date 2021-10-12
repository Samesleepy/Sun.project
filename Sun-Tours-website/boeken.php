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

//$db = null;

//zet de result in class
$Bestemming = new Bestemming($id, $result['Land'], $result['Plaats'],$result['Type'], $result['Prijs'], $result['Beschrijving'], $result['Limiet'], $result['Plaatje'], $result['avgRev'], $result['totalRes']);
$Bestemminginfo = $Bestemming->GetBestemmingInfo();

//dd($Bestemminginfo);

//if form submitted
if(isset($_POST['submit'])){
    //print_r($Userinfo);
    //$Bestemminginfo = $Bestemming->GetBestemmingInfo();
    $Userinfo = $User->GetUserInfo();
    $boekingsdatum = Date("Y-m-d");
    $Boeking = new Boeking($id, $Userinfo['KlantID'], $Bestemminginfo['Land'], $Bestemminginfo['Plaats'], $prijs, $_POST['personen'], $_POST['vertrekdatum'], $boekingsdatum, $_POST['duur']);
    $Boeking->Boeken($database);
}

//bereken prijs
$prijs = false;
if(isset($_POST['personen'])){
    $prijs = $_POST['personen'] * $_POST['duur'];
}else{
    $prijs = false;
}
if($prijs){
    $prijs = intval($prijs) * intval($Bestemminginfo['Prijs']);
    ?><script>if(confirm("Druk op OK om te kopen voor <?php echo "€" . $prijs . ".00"; ?>")){alert("Betaald!");<?php //echo Boeken(); ?>;window.location.href = "home.php"}</script><?php
}
$prijspp = $Bestemminginfo['Prijs'];
$score = $Bestemminginfo['Score'];
$beschrijving = $Bestemminginfo['Beschrijving'];
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
                echo '<img height="250px" src="data:image/png;base64,'.base64_encode($Bestemminginfo['Plaatje']).'"/>';
                //echo score if isset
                echo "<div class='my-3'>";
                    if(isset($score)){echo round($score,2);}
                echo "</div>";
            ?>
            </div>
            <div class="col-8">
                <h2 class="text-primary">Booking info</h2>
                <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
                    <div class="form-group input-group">
                        <input id="personenveld" name="personen" class="form-control" placeholder="Personen" type="number" min="1" onkeyup="updatePrijs()"  required>
                    </div>
                    <div class="form-group input-group">
                        <input name="vertrekdatum" class="form-control" min="<?php echo date("Y-m-d"); ?>" placeholder="MM/DD/YYYY" type="date" required><label>&nbsp; Vertrekdatum</label>
                    </div>
                    <div class="form-group input-group">
                        <input id="dagenveld" name="duur" class="form-control" placeholder="Duur" type="number" min="1" onkeyup="updatePrijs()" required><label>&nbsp; Dagen</label>
                    </div>
                    <br><label>Prijs &nbsp;</label><span id="prijsPP"><?php echo "&euro;" . $Bestemminginfo['Prijs'] . " "; ?></span><label>p.p.</label><br>

                    <label style="float:left;">Totaal &nbsp;</label><div id="totaal" style="float:left;"><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0.00";} ?></div><br><br>

                    <input type="submit" name="submit" value="Naar betalen" class="btn btn-primary btn-block">
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
