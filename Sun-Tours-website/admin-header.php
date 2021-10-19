<?php
//Include alle classes
include_once('Classes/db.php');
include_once('Classes/bestemmingClass.php');
include_once('Classes/userClass.php');
include_once('Classes/boekingClass.php');
include_once('Classes/faqClass.php');
include_once('Classes/reviewClass.php');
include_once('Classes/contactClass.php');

//for testing
function dd($x){
    echo "<pre>";
    print_r($x);
    die();
    echo "</pre>";
}

session_start();
$database = new Database();
if(isset($_SESSION['user'])){
    $User = $_SESSION['user'];
}else{
    $User = new User();
}

if ($_SESSION['user']->role == "Admin") {
}else{
    header("Location: home.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: home.php");
}

$db = $database->connection();
$stmt = $db->prepare("SELECT COUNT(*) FROM `contact`;");
$stmt->execute();
$countVragen = $stmt->fetch();
$count = $countVragen[0];
$db = NULL
?>

<html lang="nl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="test.css"/>
        <script src="https://kit.fontawesome.com/e1d19818da.js" crossorigin="anonymous"></script>
        <link href="https://getbootstrap.com/docs/5.1/examples/sidebars/sidebars.css" rel="stylesheet">
        <style>
            body{
                background-color: #ededed;
            }
            .sun-logo{
                max-width: 150px;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
                <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto" style="margin-left: 45px;">
                    <img src="Pics\Sun-Tours-logo.png" class="sun-logo" alt="Suntours" style="filter: brightness(0) invert(1);">
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="admin.php" class="nav-link text-white">
                            <i class="fas fa-tachometer-alt" width="16" height="16" style="padding-right: 5px"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="admin-boekingen.php" class="nav-link text-white">
                            <i class="fas fa-globe-americas" width="16" height="16" style="padding-right: 7px"></i>
                            Boekingen
                        </a>
                    </li>
                    <li>
                        <a href="admin-klanten.php" class="nav-link text-white">
                            <i class="fas fa-users" width="16" height="16" style="padding-right: 3px"></i>
                            Klanten
                        </a>
                    </li>
                    <li>
                        <a href="admin-vragen.php" class="nav-link text-white">
                            <i class="far fa-question-circle" width="16" height="16" style="padding-right: 7px"></i>
                            Vragen
                            <span class="badge bg-light text-dark rounded-pill align-text-bottom"><?php echo $count ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-faq.php" class="nav-link text-white">
                        <i class="far fa-comments" width="16" height="16" style="padding-right: 5px"></i>
                            FAQ's
                        </a>
                    </li>
                    <li>
                        <a href="admin-reviews.php" class="nav-link text-white">
                            <i class="far fa-star" width="16" height="16" style="padding-right: 5px"></i>
                            Reviews
                        </a>
                    </li>
                </ul>
                <a href="../readme.txt" style="color: white;"><hr></a>
                <div class="d-flex align-items-center text-white text-decoration-none">
                    <i class='fas fa-user' style="padding-right: 10px"></i>
                    <strong> <?php echo $User->voornaam . " " .  $User->tussenvoegsel . " " . $User->achternaam; ?></strong>
                </div>
            </div>
