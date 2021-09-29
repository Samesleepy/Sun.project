<?php
include_once 'header.php';
$id = $_GET['id'];
$db = $database->connection();

$stmt = $db->prepare("SELECT `ID`, `Land`,`Plaats`,`Prijs`,`Plaatje` FROM `bestemming`WHERE `ID` = '".$id."'");
$stmt->execute();
$result = $stmt->fetch();
$Bestemmingen = $result;

$stmt = $db->prepare("SELECT `Score` FROM `Review` WHERE `BestemmingID` = '".$id."'");
$stmt->execute();

$results = array();

//werkt niet
// while($stmt->fetch(PDO::FETCH_ASSOC)){
//   $results[] = $stmt->fetchColumn();
// }

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($results, $row['Score']);
}
//echo "</br>";
//print_r($results);

//$score = array_sum($results)/count($results);

$results = array_filter($results);
if(count($results)) {
    $score = array_sum($results)/count($results);
}

//echo $score;

$prijs = false;
if(isset($_POST['personen'])){
    $prijs = $_POST['personen'] * $_POST['duur'];
}else{
    $prijs = false;
}
if($prijs){
    $prijs = intval($prijs) * intval($Bestemmingen['Prijs']);
    ?><script>if(confirm("Druk op OK om te kopen voor <?php echo "€" . $prijs . ".00"; ?>")){alert("Betaald!");<?php echo Boeken(); ?>;window.location.href = "home.php"}</script><?php
}
$prijspp = $Bestemmingen['Prijs'];
?>
<script>

function updatePrijs(){
    personen = document.getElementById('personenveld').value;
    dagen = document.getElementById('dagenveld').value;
    prijspp_str = document.getElementById('prijsPP').innerHTML;

    // prijspp = prijspp_str.substr(1);
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

<?php
function Boeken() {
    global $Bestemmingen;
    global $db;
    global $prijs;

    $KlantID = $_SESSION['KlantID'];
    $Bestemming = $Bestemmingen['Locatie'];
    $Personen = $_POST['personen'];
    $Vertrekdatum = $_POST['vertrekdatum'];
    $Duur = $_POST['duur'];

    $query = $db->prepare("INSERT INTO `boeking` (`KlantID`, `Bestemming`, `Prijs`, `Personen`, `Vertrekdatum`, `Duur`)
    VALUES ('$KlantID','$Bestemming','$prijs','$Personen','$Vertrekdatum','$Duur')");
    $query->execute();
}
?>
<html>
<head>
    <link  rel="stylesheet" href="test.css" type ="text/css"/>
    <title>Boeken</title>
</head>
<body>
    <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
        <h2><?php echo $Bestemmingen['Plaats'].",".$Bestemmingen['Land']; if(isset($score)){echo " ",round($score,2);} ?></h2><br><br>

        <div class="form-group input-group">
            <input id="personenveld" name="personen" class="form-control" placeholder="Personen" type="number" min="1" onkeyup="updatePrijs()"  required>
        </div>
        <div class="form-group input-group">
            <input name="vertrekdatum" class="form-control" placeholder="MM/DD/YYYY" type="date" required><label>&nbsp; Vertrekdatum</label>
        </div>
        <div class="form-group input-group">
            <input id="dagenveld" name="duur" class="form-control" placeholder="Duur" type="number" min="1" onkeyup="updatePrijs()" required><label>&nbsp; Dagen</label>
        </div>
        <br><label>Prijs &nbsp;</label><span id="prijsPP"><?php echo "&euro;" . $Bestemmingen['Prijs'] . " "; ?></span><label>p.p.</label><br>

        <label style="float:left;">Totaal &nbsp;</label><div id="totaal" style="float:left;"><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0.00";} ?></div><br><br>

        <input type="submit" name="submit" value="Naar betalen" class="btn btn-primary btn-block">
    </form>
    <content><?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen['Plaatje']).'"/>';?></content>
    <?php include_once 'review.php'; ?>
</body>
</html>
<?php include 'footer.php';?>
