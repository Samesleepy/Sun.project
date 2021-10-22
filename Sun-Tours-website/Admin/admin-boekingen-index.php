<?php
include_once('admin-header.php');

$db = $database->connection();
$stmt = $db->prepare("SELECT * FROM `boeking` ORDER BY `BoekingID` ASC");
$stmt->execute();

$results_per_page = 12;
$number_of_results = $stmt->rowCount();
$number_of_pages = ceil($number_of_results/$results_per_page);
if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$results_per_page;

if(isset($_POST['delete'])){
    $db = $database->connection();
    $stmt = $db->prepare("DELETE FROM `boeking` WHERE `ID` = '".$_POST['BoekingID']."'");
    $stmt->execute();
    $db = NULL;
    header("Refresh:0");
}
?>
<div class="container py-4">
    <h1 class="text-center">Alle boekingen</h1>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>KlantID</th>
                <th>Land</th>
                <th>Plaats</th>
                <th>Prijs</th>
                <th>Personen</th>
                <th>Hotel</th>
                <th>Vervoer</th>
                <th>Vertrekdatum</th>
                <th>Boekingsdatum</th>
                <th>Duur</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //  LIMIT " . $this_page_first_result . "," . $results_per_page
            $stmt = $db->prepare("SELECT * FROM `boeking` ORDER BY `BoekingID` ASC LIMIT " . $this_page_first_result . "," . $results_per_page);
            $stmt->execute();
            $boekingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($boekingen as $key => $boeking) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='BestemmingID' value='".$boeking['BoekingID']."'>";
                        echo "<th>". $boeking['BoekingID'] ."</th>";
                        echo "<td>". $boeking['KlantID'] ."</td>";
                        echo "<td>". $boeking['Land'] ."</td>";
                        echo "<td>". $boeking['Plaats'] ."</td>";
                        echo "<td>". $boeking['Prijs'] ."</td>";
                        echo "<td>". $boeking['Personen'] ."</td>";
                        echo "<td>". $boeking['Hotel'] ."</td>";
                        echo "<td>". $boeking['Vervoer'] ."</td>";
                        echo "<td>". $boeking['Vertrekdatum'] ."</td>";
                        echo "<td>". $boeking['Boekingsdatum'] ."</td>";
                        echo "<td>". $boeking['Duur'] ."</td>";
                        echo "<td><a type='button' href='admin-boekingen-edit.php?BestemmingID=".$boeking['BoekingID']."' class='btn btn-primary'>Edit</a></td>";
                        echo "<td><button type='submit' name='delete' class='btn btn-danger'>Delete</button></td>";
                    echo "</form>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-8 offset-md-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                        for ($i=1;$i<=$number_of_pages;$i++) { 
                            echo "<li class='page-item'><a class='btn btn-primary page-link ";
                            if($page == $i){echo "active";}
                            echo "' href='admin-boekingen-index.php?page=" . $i . "'>" . $i . " </a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
include_once('admin-footer.php');
?>
