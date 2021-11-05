<?php
include_once("admin-header.php");

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `contact` ORDER BY `Afgehandeld` DESC;");
$stmt->execute();
$vragen = $stmt->fetchAll(PDO::FETCH_ASSOC);

$db = NULL;

//Als klaar wordt geklikt
if(isset($_POST['klaar'])){
    $db = $database->connection();
    $stmt = $db->prepare("UPDATE `contact` SET `Afgehandeld` = 'Y' WHERE `VraagID` = '".$_POST['VraagID']."'"); //Zet vraag op afgehandeld
    $stmt->execute();
    $db = NULL;
    header("Refresh:0");
}

//dd($vragen);
?>

<div class="container py-4">
    <h1 class="text-center">Alle vragen</h1>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>KlantID</th>
                <th>E-mail</th>
                <th>Type</th>
                <th>Onderwerp</th>
                <th>Opmerking</th>
                <th>Afgehandeld</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //echo data van de vragen gehaald uit de database
            foreach ($vragen as $key => $vraag) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='VraagID' value='".$vraag['VraagID']."'>";
                        echo "<th>". $vraag['VraagID'] ."</th>";
                        echo "<td>". $vraag['KlantID'] ."</td>";
                        echo "<td><a href='mailto:". $vraag['Email'] ."'>". $vraag['Email'] ."</a></td>";
                        echo "<td>". $vraag['Type'] ."</td>";
                        echo "<td>". $vraag['Onderwerp'] ."</td>";
                        echo "<td>". $vraag['Opmerking'] ."</td>";
                        if($vraag['Afgehandeld'] == "Y"){ //Als vraag afgehandeld is
                            echo "<td><i class='fas fa-check-circle mt-2' style='font-size: 25px; margin-left: 38px; height: 30px; color: #33dd33;'></i></td>";
                        }else{
                            echo "<td><button class='btn btn-primary' type='submit' name='klaar' style='margin-left: 20px;' href=''>Klaar</button>";
                        }
                        echo "</td>";
                    echo "</form>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>

<?php
include_once("admin-footer.php");
?>
