<?php include_once 'header.php';
$id = $_GET['id'];

$query = "SELECT `Locatie`, `Prijs`, `Plaatje` FROM `bestemming` WHERE `ID` = '".$id."'";
    $result = mysqli_query($conn, $query);
    while($fetch = mysqli_fetch_assoc($result)){
    $Bestemmingen = array(
      'Locatie' => $fetch['Locatie'],
      'Prijs' => $fetch['Prijs'],
      'Plaatje' => $fetch['Plaatje']
     );
    }
$prijs = false;
if(isset($_POST['personen'])){
    $prijs = $_POST['personen'];
}else{
    $prijs = false;
}
if($prijs){
    $prijs = intval($prijs) * intval($Bestemmingen['Prijs']);
    ?><script>if(confirm("Druk op OK om te kopen voor <?php echo "€" . $prijs; ?>")){alert("Betaald!");window.location.href = "home.php"}</script><?php
}
// function updatePrijs($personen, $prijspp){
//     echo "hallo";
//     $resultaat = $personen * $prijspp;
//     echo $resultaat;
// }
function updatePrijs(){
    echo "hallo";
    
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="test.css" type ="text/css"/>
    <title>Boeken</title>
</head>
<body>
    <form id="boekform" action="boeken.php?id=<?php echo $id; ?>" method="post">
        <?php echo $Bestemmingen['Locatie']; ?><br><br>

        <div class="form-group input-group">
            <input name="personen" class="form-control" placeholder="Personen" type="text" onkeyup="updatePrijs()"  required> <!--this.value,$Bestemmingen['Prijs'])" required>-->
        </div>
        <div class="form-group input-group">
            <input name="vertrekdatum" class="form-control" placeholder="MM/DD/YYYY" type="date" required><label>Vertrekdatum</label>
        </div>
        <div class="form-group input-group">
            <input name="duur" class="form-control" placeholder="Duur" type="text" required><label>Dagen</label>
        </div>
        <br><label>Prijs</label><?php echo " &euro;" . $Bestemmingen['Prijs'] . " "; ?><label>p.p.</label><br>

        <label>Totaal</label><?php if($prijs){echo " &euro;" . $prijs;}else{echo " &euro;0";} ?><br><br>

        <input type="submit" value="Naar betalen" class="btn btn-primary btn-block">
    </form>
    <content><?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen['Plaatje']).'"/>';?></content>
</body>
</html>
<?php include 'footer.php';?>