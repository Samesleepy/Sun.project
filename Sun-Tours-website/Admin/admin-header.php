<?php
//Include alle classes
include_once('../Classes/db.php');
include_once('../Classes/userClass.php');
include_once('../Classes/bestemmingClass.php');
include_once('../Classes/boekingClass.php');
include_once('../Classes/faqClass.php');

//for testing
function dd($x){
    echo "<pre>";
    print_r($x);
    die();
    echo "</pre>";
}

//start de sessie 
session_start();
//maakt de connectie met de database via de class
$database = new Database();
//maakt een nieuwe user aan als die nog niet bestond
if(isset($_SESSION['user'])){
    $User = $_SESSION['user'];
}else{
    $User = new User();
}

//zodra je geen admin bent wordt je terug gestuurd
if ($_SESSION['user']->role == "Admin") {
}else{
    header("Location: ../home.php");
}

//maakt database connectie aan
$db = $database->connection();
//kijkt hoeveel vragen er zijn en zet deze in een variable
$stmt = $db->prepare("SELECT COUNT(*) FROM `contact`;");
$stmt->execute();
$countVragen = $stmt->fetch();
$count = $countVragen[0];
$db = NULL;
?>

<html lang="nl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../test.css"/>
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
                <a href="../home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto" style="margin-left: 45px;">
                    <img src="../Pics/Sun-Tours-logo.png" class="sun-logo" alt="Suntours" style="filter: brightness(0) invert(1);">
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
                        <a href="admin-boekingen-index.php" class="nav-link text-white">
                            <i class="fas fa-globe-americas" width="16" height="16" style="padding-right: 7px"></i>
                            Boekingen
                        </a>
                    </li>
                    <li>
                        <a href="admin-bestemmingen-index.php" class="nav-link text-white">
                            <i class="fas fa-map-marker-alt" width="16" height="16" style="padding-right: 9px"></i>
                            Bestemmingen
                        </a>
                    </li>
                    <li>
                        <a href="admin-klanten-index.php" class="nav-link text-white">
                            <i class="fas fa-users" width="16" height="16" style="padding-right: 3px"></i>
                            Klanten
                        </a>
                    </li>
                    <li>
                        <a href="admin-vragen-index.php" class="nav-link text-white">
                            <i class="far fa-question-circle" width="16" height="16" style="padding-right: 7px"></i>
                            Vragen
                            <?php if(!$count == 0){ //checkt of er vragen zijn en zet deze achter de vragen neer
                                echo "<span class='badge bg-light text-dark rounded-pill align-text-bottom'>".$count." </span>";
                            } ?>
                        </a>
                    </li>
                    <li>
                        <a href="admin-faq-index.php" class="nav-link text-white">
                        <i class="far fa-comments" width="16" height="16" style="padding-right: 5px"></i>
                            FAQ's
                        </a>
                    </li>
                </ul>
                <a href="../../readme.txt" style="color: white;"><hr></a>
                <div class="d-flex align-items-center text-white text-decoration-none">
                    <i class='fas fa-user' style="padding-right: 10px"></i>
                    <strong> <?php echo $User->voornaam . " " .  $User->tussenvoegsel . " " . $User->achternaam; ?></strong>
                </div>
            </div>
