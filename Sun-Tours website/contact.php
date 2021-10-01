<?php
include_once 'header.php';

$db = $database->connection();

if(isset($_POST['submit'])){
  $KlantID = $_SESSION['KlantID'];
  $Soort = $_POST['soort'];
  $Onderwerp = $_POST['onderwerp'];
  $Opmerking = $_POST['opmerking'];

  $query = $db->prepare("INSERT INTO `contact` (`KlantID`, `Type`, `Onderwerp`, `Opmerking`)
  VALUES ('$KlantID','$Soort','$Onderwerp','$Opmerking')");
  $query->execute();
}

?>
  <head>
    <script>
      function updateSoort(){
        document.getElementById("opmerking").placeholder = document.getElementById("soort").value;
      }
    </script>
  </head>
  <body>
    <a class="nav-link active" aria-current="page" href="FAQ.php">FAQ</a>
    <div class="card bg-light">
      <div class="card-body mx-auto" style="max-width: 800px;min-width: 700px;">
        <div class="jumbotron text-center">
          <h1>Neem contact op<h1>
          <?php if(isset($_SESSION['Voornaam'])){ ?>
          <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="input-group mb-3">
              <select id="soort" class="form-select form-select-sm" id="inputGroupSelect01" name="soort" onchange="updateSoort()" required>
                <option value="" disabled selected hidden>Soort: </option>
                <option value="Klacht">Klacht</option>
                <option value="Vraag">Vraag</option>
                <option value="Feedback">Feedback</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="onderwerp" placeholder="Onderwerp" required>
            </div>
            <div class="input-group mb-4">
              <textarea id="opmerking" class="form-control" name="opmerking" rows="5" placeholder="Opmerking" required></textarea>
            </div>
            <div class="form-group">
              <div class="text-center">
                <button id="contactButton" type="submit" name="submit" class="btn btn-primary btn-block w-100">Verstuur</button>
              </div>
            </div>
          </form>
          <?php ;}else{ ?>
          <p class="text-danger">Log eerst in</p>
          <?PHP ;} ?>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
include_once 'footer.php';
?>
