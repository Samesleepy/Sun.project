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
    <form id="boekform" action="boeken.php" method="post">
        <?php echo $Bestemmingen['Locatie']; ?><br><br>

        <div class="form-group input-group">
            <input name="personen" class="form-control" placeholder="Personen" type="text" required>
        </div>
        <div class="form-group input-group">
            <input name="vertrekdatum" class="form-control" placeholder="MM/DD/YYYY" type="date" required><label>Vertrekdatum</label>
        </div>
        <div class="form-group input-group">
            <input name="duur" class="form-control" placeholder="Duur" type="text" required><label>Dagen</label>
        </div>
        <br><label>Prijs</label><?php echo " " . $Bestemmingen['Prijs']; ?><br>

        <input type="submit" value="Kopen" class="btn btn-primary btn-block">
    </form>
    <content><?php echo '<img src="data:image/png;base64,'.base64_encode($Bestemmingen['Plaatje']).'"/>';?></content>
</body>
</html>

<?php include 'footer.php';?>
