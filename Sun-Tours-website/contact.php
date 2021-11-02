<?php
include_once 'header.php';

if(isset($_POST['submit'])){
  $Contact = new Contact($User->GetUserInfo()['KlantID'], $User->GetUserInfo()['Email'], $_POST['soort'], $_POST['onderwerp'], $_POST['opmerking']);
  $Contact->CreateContact($database);

  echo "<div class='alert alert-success' role='alert' style='margin-bottom: 0px;'>Succesvol verstuurd!</div>";
}

?>
<body>

  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3"><?=  $text[$_SESSION['lang']]['contact'][1] ?></h1>
        <p class="col-lg-10 fs-3"><?=  $text[$_SESSION['lang']]['contact'][2] ?></p>
        <p class="col-lg-10 fs-5"><?=  $text[$_SESSION['lang']]['contact'][3] ?></p>
        <p class="col-lg-10 fs-5"><?=  $text[$_SESSION['lang']]['contact'][4] ?></p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <?php if(isset($_SESSION['user'])){ ?>
        <form class="p-4 p-md-5 border rounded-3 bg-light" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
          <div class="form-floating mb-3">
            <select id="soort" class="form-select form-select-sm" name="soort" onchange="updateSoort()" required>
              <option value="" disabled selected hidden></option>
              <option value="Klacht"><?=  $text[$_SESSION['lang']]['contact'][5] ?></option>
              <option value="Vraag"><?=  $text[$_SESSION['lang']]['contact'][6] ?></option>
              <option value="Feedback"><?=  $text[$_SESSION['lang']]['contact'][7] ?></option>
            </select>
            <label for="floatingInput"><?=  $text[$_SESSION['lang']]['contact'][8] ?></label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="onderwerp" placeholder="Onderwerp" required>
            <label for="onderwerp"><?=  $text[$_SESSION['lang']]['contact'][9] ?></label>
          </div>
          <div class="form-floating mb-3" >
            <textarea  style="height: auto !important" class="form-control" name="opmerking" rows="5" required></textarea>
            <label id="label" for="onderwerp"><?=  $text[$_SESSION['lang']]['contact'][10] ?></label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" style="font-size: 1rem;" name="submit" type="submit"><?=  $text[$_SESSION['lang']]['contact'][11] ?></button>
          <hr class="my-4">
          <small class="text-muted"><?=  $text[$_SESSION['lang']]['contact'][12] ?><a class="active" aria-current="page" href="FAQ.php"><?=  $text[$_SESSION['lang']]['contact'][13] ?></a></small>
        </form>
          <?php }else{ ?>
            <p class="display-4 fw-2 text-danger lh-2 mb-3"><?=  $text[$_SESSION['lang']]['contact'][14] ?></p>
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
