<?php
include_once('admin-header.php');
//$KlantID;
// if(isset($_GET['KlantID'])){
//     $KlantID = $_GET['KlantID'];
// }else{
//     //header("Location: home.php");
// }
$UserToEdit = new User();
$UserToEdit->SetUserInfo($database, $_GET['KlantID']);
$Userinfo = $UserToEdit->GetUserInfo();
?>

<body>
    <div class="card bg-light">
        <div class="card-body mx-auto" style="width: 800px;">
            <div class="jumbotron text-center">
                <h1>Account wijzigen<h1>
            </div>
            <form action="" method="post">
                <div class="row">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">E-mail</label>
                    <input name="email" class="form-control" placeholder="E-mail" value="<?php echo $Userinfo['Email'] ?> "type="email" required>
                </div>
                <div class="mb-2">
                    <label for="role" class="form-label">Role</label>
                    <input name="role" class="form-control" placeholder="Role" value="<?php echo $Userinfo['Role'] ?>
                    " type="text" required>
                </div>
            </form>
        </div>
    </div>
</body>

<?php
include_once('admin-footer.php');
?>
