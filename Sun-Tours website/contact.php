<?php
include_once 'header.php';

if(isset($_GET['submit'])){
  echo "test";
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
    <div class="card bg-light">
      <div class="card-body mx-auto" style="max-width: 800px;min-width: 700px;">
        <div class="jumbotron text-center">
          <h1>Neem contact op<h1>
          <form method="post">
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
        </div>
      </div>
    </div>
  </body>
</html>

<?php
include_once 'footer.php';
?>
