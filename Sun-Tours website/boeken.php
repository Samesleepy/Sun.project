<?php include_once 'header.php';
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT `ID`, `Locatie`,`Prijs`,`Plaatje` FROM `bestemming`WHERE `ID` = '".$id."'");
$stmt->execute();
$result = $stmt->fetch();
$Bestemmingen = $result;

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
function updatePrijs(personen, prijspp, bool){
    if (!bool) {
        if (!personen == "") {
            result = personen * prijspp;
            document.getElementById('totaal').innerHTML = "€" + result + ".00";
        }else{
            document.getElementById('totaal').innerHTML = "€0.00";
            result = 0;
        }
    }
    if (bool) {
        if (!personen == "") {
            if (result > 0) {
                result2 = result * personen;
                document.getElementById('totaal').innerHTML = "€" + result2 + ".00";
            }else{
                result2 = personen * prijspp;
                document.getElementById('totaal').innerHTML = "€" + result2 + ".00";
            }
        }else{
            result2 = 0;
            document.getElementById('totaal').innerHTML = "€" + result + ".00";
        }
    }
}
</script>

<?php
function Boeken() {
    global $Bestemmingen;
    global $conn;
    global $prijs;

    $KlantID = $_SESSION['KlantID'];
    $Bestemming = $Bestemmingen['Locatie'];
    $Personen = $_POST['personen'];
    $Vertrekdatum = $_POST['vertrekdatum'];
    $Duur = $_POST['duur'];

    $query = $conn->prepare("INSERT INTO `boeking` (`KlantID`, `Bestemming`, `Prijs`, `Personen`, `Vertrekdatum`, `Duur`)
    VALUES ('$KlantID','$Bestemming','$prijs','$Personen','$Vertrekdatum','$Duur')");
    $query->execute();
}
?>
<head>
    <link  rel="stylesheet" href="test.css" type ="text/css"/>
    <title>Boeken</title>
</head>
<body>
    <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
        <h2><?php echo $Bestemmingen['Locatie']; ?></h2><br><br>

        <div class="form-group input-group">
            <input name="personen" class="form-control" placeholder="Personen" type="number" min="1" onkeyup="updatePrijs(this.value, <?php echo $prijspp; ?>, 0)"  required>
        </div>
        <div class="form-group input-group">
            <input name="vertrekdatum" class="form-control" placeholder="MM/DD/YYYY" type="date" required><label>&nbsp; Vertrekdatum</label>
        </div>
        <div class="form-group input-group">
            <input name="duur" class="form-control" placeholder="Duur" type="number" min="1" onkeyup="updatePrijs(this.value, <?php echo $prijspp; ?>, 1)" required><label>&nbsp; Dagen</label>
        </div>
        <br><label>Prijs &nbsp;</label><?php echo "&euro;" . $Bestemmingen['Prijs'] . " "; ?><label>p.p.</label><br>

        <label style="float:left;">Totaal &nbsp;</label><div id="totaal" style="float:left;"><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0.00";} ?></div><br><br>

        <input type="submit" name="submit" value="Naar betalen" class="btn btn-primary btn-block">
    </form>
    <content><?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen['Plaatje']).'"/>';?></content>
    <?php include_once 'review.php'; ?>
</body>
</html>
<?php include 'footer.php';?>
