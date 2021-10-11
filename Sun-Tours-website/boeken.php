<?php
include_once 'header.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location: home.php");
}

$db = $database->connection();
$stmt = $db->prepare("SELECT bestemming.`ID`, bestemming.`Land`, bestemming.`Plaats`, `Type`, bestemming.`Prijs`,`Limiet`,`Plaatje`,
AVG(`Score`), SUM(`Personen`)
FROM `bestemming`
LEFT JOIN review
ON bestemming.ID = review.BestemmingID
LEFT JOIN boeking
ON bestemming.ID = boeking.BoekingID
WHERE bestemming.`ID` = '".$id."'
GROUP BY bestemming.ID;");
$stmt->execute();
$result = $stmt->fetch();
// print_r($result);
$Bestemming = new Bestemming($id, $result['Land'], $result['Plaats'],$result['Type'], $result['Prijs'], $result['Plaatje'], $result['Limiet'], $result['AVG(`Score`)'], $result['SUM(`Personen`)']);
// print_r($Bestemming);
// print_r($result);
// print_r($stmt);
//$Bestemming = GetBestemmingFromId($database, $id);
//print_r ($Bestemming);

$Bestemminginfo = $Bestemming->GetBestemmingInfo();
$Userinfo = $User->GetUserInfo();
//print_r($Bestemming);


$prijs = false;
if(isset($_POST['personen'])){
    $prijs = $_POST['personen'] * $_POST['duur'];
}else{
    $prijs = false;
}
if($prijs){
    $prijs = intval($prijs) * intval($Bestemminginfo['Prijs']);
    ?><script>if(confirm("Druk op OK om te kopen voor <?php echo "€" . $prijs . ".00"; ?>")){alert("Betaald!");<?php echo Boeken(); ?>;window.location.href = "home.php"}</script><?php
}
$prijspp = $Bestemminginfo['Prijs'];
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

<html>
<head>
    <link rel="stylesheet" href="test.css" type ="text/css"/>
    <title>Boeken</title>
</head>
<body>
    <?php if(isset($_SESSION['user'])){ ?>
    <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
        <h2><?php echo $Bestemminginfo['Plaats'].",".$Bestemminginfo['Land']; if(isset($score)){echo " ",round($score,2);} ?></h2><br><br>

        <div class="form-group input-group">
            <input id="personenveld" name="personen" class="form-control" placeholder="Personen" type="number" min="1" onkeyup="updatePrijs()"  required>
        </div>
        <div class="form-group input-group">
            <input name="vertrekdatum" class="form-control" placeholder="MM/DD/YYYY" type="date" required><label>&nbsp; Vertrekdatum</label>
        </div>
        <div class="form-group input-group">
            <input id="dagenveld" name="duur" class="form-control" placeholder="Duur" type="number" min="1" onkeyup="updatePrijs()" required><label>&nbsp; Dagen</label>
        </div>
        <br><label>Prijs &nbsp;</label><span id="prijsPP"><?php echo "&euro;" . $Bestemminginfo['Prijs'] . " "; ?></span><label>p.p.</label><br>

        <label style="float:left;">Totaal &nbsp;</label><div id="totaal" style="float:left;"><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0.00";} ?></div><br><br>

        <input type="submit" name="submit" value="Naar betalen" class="btn btn-primary btn-block">
    </form>
    <?php ;}else{ ?>
    <p class="text-danger">Log eerst in</p>
    <?php ;} ?>
    <content><?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemminginfo['Plaatje']).'"/>';?></content>
    <?php //include_once 'review.php';
   //include_once 'alternatieven.php';
    if(isset($_POST['submit'])){
    $Boeking = new Boeking;
    $Boeking->Boeken($database, $Bestemminginfo['ID'],$Userinfo['klantID'], $Bestemminginfo['Land'],
    $Bestemminginfo['Plaats'], $_POST['personen'], $_POST['vertrekdatum'], $_POST['duur']);
    // {
    //     $query = $db->prepare("INSERT INTO `boeking` (`BestemmingID`, `KlantID`, `Land`,`Plaats`, `Prijs`, `Personen`, `Vertrekdatum`, `Duur`) VALUES('$BestemmingID','$KlantID','$Land','$Plaats','$prijs','$Personen','$Vertrekdatum','$Duur')");
    //     $query->execute();
    // }
  }
     ?>
</body>
</html>
<?php include 'footer.php';?>