<?php
//header
include_once('admin-header.php');

//database connectie
$db = $database->connection();
//haalt alle faqs' op
$stmt = $db->prepare("SELECT * FROM `faq` ORDER BY `QID` ASC;");
$stmt->execute();
$FAQs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$db = NULL;

if(isset($_POST['delete'])){
    $db = $database->connection();
    $stmt = $db->prepare("DELETE FROM `FAQ` WHERE `QID` = '".$_POST['QID']."'");
    $stmt->execute();
    $db = NULL;
    header("Refresh:0");
}

?>
<div class="container py-4">
    <h1 class="text-center">Alle FAQs</h1>
    <a type="button" class="btn btn-primary mb-3" style="float: right; margin-top: -40px;" name="button" href="admin-faq-add.php">FAQ toevoegen</a>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Vraag-NL</th>
                <th>Vraag-EN</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FAQs as $key => $FAQ) {
                echo "<tr>";
                    echo "<form method='post'>";
                        echo "<input type='hidden' name='QID' value='".$FAQ['QID']."'>";
                        echo "<th>". $FAQ['QID'] ."</th>";
                        echo "<td>". $FAQ['Vraag-NL'] ."</td>";
                        echo "<td>". $FAQ['Vraag-EN'] ."</td>";
                        echo "<td><a type='button' href='admin-faq-edit.php?QID=".$FAQ['QID']."' class='btn btn-primary'>Edit</a></td>";
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
