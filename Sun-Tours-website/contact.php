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
<body>

  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Neem contact op</h1>
        <p class="col-lg-10 fs-3">Mocht je contact willen opnemen met ons dan kan dat hier. Vul het formulier hiernaast in en verstuur je vraag</p>
        <p class="col-lg-10 fs-5">Tel: 06 12345678</p>
        <p class="col-lg-10 fs-5">Locatie: Woonstraat 11, Weert</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <?php if(isset($_SESSION['user'])){ ?>
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
          <div class="form-floating mb-3">
            <select id="soort" class="form-select form-select-sm" name="soort" onchange="updateSoort()" required>
              <option value="" disabled selected hidden>Soort: </option>
              <option value="Klacht">Klacht</option>
              <option value="Vraag">Vraag</option>
              <option value="Feedback">Feedback</option>
            </select>
            <label for="floatingInput">Soort vraag</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="onderwerp" placeholder="Onderwerp" required>
            <label for="onderwerp">Onderwerp</label>
          </div>
          <div class="form-floating mb-3" >
            <textarea  style="height: auto !important" class="form-control" name="opmerking" rows="5" required></textarea>
            <label id="label" for="onderwerp">Soort</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Verstuur</button>
          <hr class="my-4">
          <small class="text-muted">Kijk hier of je vraag er al bij staat. <a class="active" aria-current="page" href="FAQ.php">FAQ</a></small>
        </form>
          <?php }else{ ?>
            <p class="display-4 fw-2 text-danger lh-2 mb-3">log eerst in</p>
          <?php } ?>
      </div>
    </div>
  </div>
  <script>
    function updateSoort(){
      document.getElementById("label").innerHTML = document.getElementById("soort").value;
    }
  </script>
</body>

<?php
include_once 'footer.php';
?>
