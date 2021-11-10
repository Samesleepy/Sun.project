<?php
//header
include_once('admin-header.php');

//maakt database connectie aan
$db = $database->connection();
//haalt alle bestemmingen op en zet ze in een array
$stmt = $db->prepare("SELECT * FROM `bestemming` ORDER BY `ID` ASC;");
$stmt->execute();
$bestemmingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
$db = NULL;

if(isset($_POST['delete'])){
    //als er op delete wordt geklikt verwijderd die de bestemming met het geklikte ID
    $db = $database->connection();
    $stmt = $db->prepare("DELETE FROM `bestemming` WHERE `ID` = '".$_POST['BestemmingID']."'");
    $stmt->execute();
    $db = NULL;
    header("Refresh:0");
}

?>
<div class="container py-4">
    <h1 class="text-center">Alle bestemmingen</h1>
    <a type="button" class="btn btn-primary mb-3" style="float: right; margin-top: -40px;" name="button" href="admin-bestemmingen-add.php">Bestemming toevoegen</a>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Land</th>
                <th>Plaats</th>
                <th>Beschrijving</th>
                <th>Prijs</th>
                <th>Limiet</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //loopt door alle bestemmingen heen en zet deze in een tabel
            foreach ($bestemmingen as $key => $bestemming) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='BestemmingID' value='".$bestemming['ID']."'>";
                        echo "<th>". $bestemming['ID'] ."</th>";
                        echo "<td>". $bestemming['Land'] ."</td>";
                        echo "<td>". $bestemming['Plaats'] ."</td>";
                        echo "<td>". substr($bestemming['Beschrijving'],0,80) ."...</td>";
                        echo "<td>". $bestemming['Prijs'] ."</td>";
                        echo "<td>". $bestemming['Limiet'] ."</td>";
                        echo "<td><a type='button' href='admin-bestemmingen-edit.php?BestemmingID=".$bestemming['ID']."' class='btn btn-primary'>Edit</a></td>";
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
