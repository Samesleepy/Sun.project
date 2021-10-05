<?php 
include_once 'header.php'; 

$db = $database->connection();

if(isset($_POST['submit'])) {
    $stmt = $db->query("SELECT KlantID FROM `Klant` WHERE `Email`='".$_SESSION['Email']."'");
    $resultinfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $klantid = $resultinfo['KlantID'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $land = $_POST['land'];
    $woonplaats = $_POST['woonplaats'];
    $postcode = $_POST['postcode'];
    $straatnaam = $_POST['straatnaam'];
    $huisnummer = $_POST['huisnummer'];

    $sql = "UPDATE `klant` SET 
    `Voornaam` = '".$voornaam."',
    `Achternaam` = '".$achternaam."',
    `Tussenvoegsel` = '".$tussenvoegsel."', 
    `Email` = '".$email."', 
    `Telefoonnummer` = '".$telefoonnummer."',
    `Land` = '".$land."',
    `Woonplaats` = '".$woonplaats."', 
    `Postcode` = '".$postcode."', 
    `Straatnaam` = '".$straatnaam."', 
    `Huisnummer` = '".$huisnummer."'
    WHERE `KlantID` = '".$klantid."'";

    $stmt = $db->query($sql);

    $stmtx = $db->prepare("SELECT * FROM `Klant` WHERE `Email`='".$email."'");
    $stmtx->execute();
    $resultinfo = $stmtx->fetch(PDO::FETCH_ASSOC);

    foreach ($resultinfo as $key => $klantinfo) {
        $_SESSION[$key] = $klantinfo;
    }
}
?>

<body>
    <div class="card bg-light">
        <div class="card-body mx-auto" style="width: 800px;">
            <div class="jumbotron text-center">
            <h1>Mijn account<h1>
        </div>
        <a href="wachtwoord.php" class="link" style="float: right">Wachtwoord veranderen</a>
        <br>
        <form action="" method="post">
            <div class="row">
                <div class="col-4">
                    <div class="mb-2">
                        <label for="Name" class="form-label">Naam</label>
                        <input name="voornaam" class="form-control"  placeholder="Voornaam" value="<?php echo $_SESSION['Voornaam'] ?>" type="text" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-2">
                        <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
                        <input name="tussenvoegsel" class="form-control" placeholder="Tussenvoegsel" value="<?php echo $_SESSION['Tussenvoegsel'] ?>" type="text">
                    </div>
                </div>
                <div class="col-5">
                    <div class="mb-2">
                        <label for="achternaam" class="form-label">Achternaam</label>
                        <input name="achternaam" class="form-control" placeholder="Achternaam" value="<?php echo $_SESSION['Achternaam'] ?>" type="text" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <label for="email" class="form-label">E-mail</label>
                <input name="email" class="form-control" placeholder="E-mail" value="<?php echo $_SESSION['Email'] ?>" type="email" required>
            </div>
            <div class="mb-2">
                <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
                <input name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" value="<?php echo $_SESSION['Telefoonnummer'] ?>" type="text" required>
            </div>
            <div class="mb-2">
                <label for="land" class="form-label">Land</label>
                <input name="land" class="form-control" placeholder="Land" value="<?php echo $_SESSION['Land'] ?>" type="text" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-2">
                        <label for="woonplaats" class="form-label">Woonplaats</label>
                        <input name="woonplaats" class="form-control" placeholder="Woonplaats" value="<?php echo $_SESSION['Woonplaats'] ?>" type="text" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input name="postcode" class="form-control" placeholder="Postcode" value="<?php echo $_SESSION['Postcode'] ?>" type="text" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="mb-2">
                        <label for="straatnaam" class="form-label">Straatnaam</label>
                        <input name="straatnaam" class="form-control" placeholder="Straatnaam" value="<?php echo $_SESSION['Straatnaam'] ?>" type="text" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-2">
                        <label for="huisnummer" class="form-label">Huisnummer</label>
                        <input name="huisnummer" class="form-control" placeholder="Huisnummer" value="<?php echo $_SESSION['Huisnummer'] ?>" type="text" required>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <div class="text-end ">
                    <button id="submit" type="submit" name="submit" class="btn btn-primary btn-block w-100">Opslaan</button>
                </div>
            </div>
        </form>
        
        </div>
    </div>
</body>

<?php include_once 'footer.php' ?>
