<?php
include_once("admin-header.php");

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `contact` ORDER BY `VraagID` ASC;");
$stmt->execute();
$vragen = $stmt->fetchAll(PDO::FETCH_ASSOC);
$db = NULL;

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
                <th>Type</th>
                <th>Onderwerp</th>
                <th>Opmerking</th>
                <th>Afgehandeld</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($vragen as $key => $vraag) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='userid' value='".$vraag['VraagID']."'>";
                        echo "<th>". $vraag['VraagID'] ."</th>";
                        echo "<td>". $vraag['KlantID'] ."</td>";
                        echo "<td>". $vraag['Type'] ."</td>";
                        echo "<td>". $vraag['Onderwerp'] ."</td>";
                        echo "<td>". $vraag['Opmerking'] ."</td>";
                        echo "<td>". $vraag['Afgehandeld'] ."</td>";
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