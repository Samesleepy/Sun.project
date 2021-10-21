<?php
include_once('admin-header.php');

$UserToEdit = new User();
$UserToEdit->SetUserInfo($database, $_GET['KlantID']);
$Userinfo = $UserToEdit->GetUserInfo();

if(isset($_POST['changeinfo'])){
  $UserToEdit->AdminUpdateUser($database, $_POST['email'], $_POST['role']);
  header("Refresh:0");
}

if(isset($_POST['changepass'])){
  $UserToEdit->AdminUpdateUserPass($database, $_POST['passNieuw']);
  header("Refresh:0");
}
?>

<body>
  <div class="container py-4 w-50">
    <div class="jumbotron text-center">
        <h1>Account wijzigen<h1>
    </div>
    <form method="post" class="mb-5">
        <div class="mb-2">
            <label for="email" class="form-label">E-mail</label>
            <input name="email" class="form-control" placeholder="E-mail" value="<?php echo $Userinfo['Email'] ?> "type="email" required>
        </div>
        <select class="form-select" name="role" aria-label="Default select example" required>
          <option value="Admin" <?php if($Userinfo['Role'] == 'Admin'){ echo "selected";}  ?>>Admin</option>
          <option value="User" <?php if($Userinfo['Role'] == 'User'){ echo "selected";}  ?>>User</option>
        </select>
        <button type="submit" name="changeinfo" class="btn btn-primary btn-block w-100 my-2">Account Wijzigen</button>
      </form>
      <form method="post">
        <div class="mb-2">
            <label for="NieuwWachtwoord" class="form-label">Nieuw wachtwoord</label>
            <input name="passNieuw" class="form-control" type="password" required>
        </div>
        <button type="submit" name="changepass" class="btn btn-primary btn-block w-100 my-2 ">Wachtwoord Wijzigen</button>
    </form>
  </div>
</body>

<?php
include_once('admin-footer.php');
?>
