<?php
include_once 'header.php';

if($User->voornaam == ""){
             header("Location: home.php");
           }
if(isset($_POST['submit'])) {
  $User->ChangePass($database, $User->GetUserInfo()['KlantID'], $_POST['passNieuw'], $_POST['passOud'], $_POST['passHerhaal']);
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
