<?php
include_once 'header.php';
?>
  <body>
    <div class="card bg-light">
      <div class="card-body mx-auto" style="max-width: 800px;min-width: 700px;">
        <div class="jumbotron text-center">
          <h1>Neem contact op<h1>
          <form method="post">
            <div class="input-group mb-3">
              <select class="form-select form-select-sm" id="inputGroupSelect01" name="score" required>
                <option value="">Soort: </option>
                <option value="klacht">Klacht</option>
                <option value="vraag">Vraag</option>
                <option value="feedback">Feedback</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="onderwerp" placeholder="Onderwerp">
            </div>
            <div class="input-group mb-4">
              <textarea class="form-control" name="opmerking" rows="5" placeholder="Opmerking"></textarea>
            </div>
            <div class="form-group">
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-block w-100">Verstuur</button>
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
