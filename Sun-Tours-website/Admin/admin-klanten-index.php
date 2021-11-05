<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `klant` ORDER BY `KlantID` ASC;"); //Haal klanten uit database geordend ascending, begint bij 1
$stmt->execute();
$klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);
$db = NULL;

//Als delete knop geklikt is
if(isset($_POST['delete'])){
    $db = $database->connection();
    $stmt = $db->prepare("DELETE FROM `klant` WHERE `KlantID` = '".$_POST['UserID']."'"); //Verander klant uit database met ingevoerde ID
    $stmt->execute();
    $db = NULL;
    header("Refresh:0");
}

?>
<div class="container py-4">
    <h1 class="text-center">Alle klanten</h1>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Role</th>
                <th>E-mail</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Echo data gehaald uit de database van klanten
            foreach ($klanten as $key => $klant) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='UserID' value='".$klant['KlantID']."'>";
                        echo "<th>". $klant['KlantID'] ."</th>";
                        echo "<td>". $klant['Voornaam'] ."</td>";
                        echo "<td>". $klant['Tussenvoegsel'] ."</td>";
                        echo "<td>". $klant['Achternaam'] ."</td>";
                        echo "<td>". $klant['Role'] ."</td>";
                        echo "<td>". $klant['Email'] ."</td>";
                        echo "<td><a type='button' href='admin-klanten-edit.php?KlantID=".$klant['KlantID']."' class='btn btn-primary'>Edit</a></td>";
                        echo "<td><button type='submit' name='delete' class='btn btn-danger'>Delete</button></td>";
                    echo "</form>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include_once('admin-footer.php');
?>
