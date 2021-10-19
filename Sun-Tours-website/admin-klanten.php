<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `klant` ORDER BY `KlantID` ASC;");
$stmt->execute();
$klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);
$db = NULL;

if(isset($_POST['delete'])){
    $db = $database->connection();
    $stmt = $db->prepare("DELETE FROM `klant` WHERE `KlantID` = '".$_POST['userid']."'");
    $stmt->execute();
    $db = NULL;
    header("Refresh:0");
}

?>
<div class="container py-4">
    <h1>Alle klanten</h1>
    <br>
    <table class="table table-dark table-hover" style="border-radius: 5%">
        <thead>
            <tr>
                <th>#</th>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>E-mail</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($klanten as $key => $klant) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='userid' value='".$klant['KlantID']."'>";
                        echo "<th>". $klant['KlantID'] ."</th>";
                        echo "<td>". $klant['Voornaam'] ."</td>";
                        echo "<td>". $klant['Tussenvoegsel'] ."</td>";
                        echo "<td>". $klant['Achternaam'] ."</td>";
                        echo "<td>". $klant['Email'] ."</td>";
                        echo "<td><button type='button' href='#' class='btn btn-primary'>Edit</button></td>";
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