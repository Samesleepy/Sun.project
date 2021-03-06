<?php
include_once 'header.php';

if($User->voornaam == ""){
    header("Location: home.php");
}

$Userinfo = $User->GetUserInfo();

if(isset($_POST['submit'])) {
    $User->UpdateUserInfo($database, $_POST['voornaam'],$_POST['achternaam'],$_POST['tussenvoegsel'],$_POST['email'],
    $_POST['telefoonnummer'],$_POST['land'],$_POST['woonplaats'],$_POST['postcode'],
    $_POST['straatnaam'],$_POST['huisnummer']);

    header("Location: profiel.php");
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
                        <input name="voornaam" class="form-control"  placeholder="Voornaam" value="<?php echo $Userinfo['Voornaam'] ?>" type="text" required>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-2">
                        <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
                        <input name="tussenvoegsel" class="form-control" placeholder="Tussenvoegsel" value="<?php echo $Userinfo['Tussenvoegsel'] ?>" type="text">
                    </div>
                </div>
                <div class="col-5">
                    <div class="mb-2">
                        <label for="achternaam" class="form-label">Achternaam</label>
                        <input name="achternaam" class="form-control" placeholder="Achternaam" value="<?php echo $Userinfo['Achternaam'] ?>" type="text" required>
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <label for="email" class="form-label">E-mail</label>
                <input name="email" class="form-control" placeholder="E-mail" value="<?php echo $Userinfo['Email'] ?>" type="email" required>
            </div>
            <div class="mb-2">
                <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
                <input name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" value="<?php echo $Userinfo['Telefoonnummer'] ?>" type="text" required>
            </div>
            <div class="mb-2">
                <label for="land" class="form-label">Land</label>
                <input name="land" class="form-control" placeholder="Land" value="<?php echo $Userinfo['Land'] ?>" type="text" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-2">
                        <label for="woonplaats" class="form-label">Woonplaats</label>
                        <input name="woonplaats" class="form-control" placeholder="Woonplaats" value="<?php echo $Userinfo['Woonplaats'] ?>" type="text" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input name="postcode" class="form-control" placeholder="Postcode" value="<?php echo $Userinfo['Postcode'] ?>" type="text" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="mb-2">
                        <label for="straatnaam" class="form-label">Straatnaam</label>
                        <input name="straatnaam" class="form-control" placeholder="Straatnaam" value="<?php echo $Userinfo['Straatnaam'] ?>" type="text" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-2">
                        <label for="huisnummer" class="form-label">Huisnummer</label>
                        <input name="huisnummer" class="form-control" placeholder="Huisnummer" value="<?php echo $Userinfo['Huisnummer'] ?>" type="text" required>
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
