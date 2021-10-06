<?php 
include_once 'header.php'; 

$db = $database->connection();
if(isset($_POST['submit'])) {

    $stmt = $db->query("SELECT `Wachtwoord` FROM `klant` WHERE `KlantID`='".$_SESSION['KlantID']."'");
    $resultinfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $passOud = $_POST['passOud'];
    $passOud_hashed = password_hash($_POST['passOud'], PASSWORD_DEFAULT);
    $passNieuw = $_POST['passNieuw'];
    $passNieuw_hashed = password_hash($_POST['passNieuw'], PASSWORD_DEFAULT);
    $passHerhaal = $_POST['passHerhaal'];
    $passHerhaal_hashed = password_hash($_POST['passHerhaal'], PASSWORD_DEFAULT);

    if(password_verify($passOud, $resultinfo['Wachtwoord'])){
        if($_POST['passNieuw'] === $_POST['passHerhaal']){
            $stmt = $db->prepare("UPDATE `klant` SET `Wachtwoord` = '".$passNieuw_hashed."' WHERE `KlantID` = '".$_SESSION['KlantID']."'");
            $stmt->execute();
            header("Location: profiel.php");
        }else{
            echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Fout! Herhaal het nieuwe wachtwoord</div>";
        }
    }else{
        echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Fout! Je oude wachtwoord is verkeerd</div>";
    }
}
?>

<body>
    <div class="card bg-light">
        <div class="card-body mx-auto" style="width: 800px;">
            <div class="jumbotron text-center">
            <h1>Verander je wachtwoord<h1>
        </div>
        <form action="" method="post">
            <div class="mb-2">
                <label for="OudWachtwoord" class="form-label">Oud wachtwoord</label>
                <input name="passOud" class="form-control" type="password" required>
            </div>
            <div class="mb-2">
                <label for="NieuwWachtwoord" class="form-label">Nieuw wachtwoord</label>
                <input name="passNieuw" class="form-control" type="password" required>
            </div>
            <div class="mb-2">
                <label for="HerhaalWachtwoord" class="form-label">Herhaal nieuw wachtwoord</label>
                <input name="passHerhaal" class="form-control" type="password" required>
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
