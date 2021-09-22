<?php
include_once 'header.php';
 ?>

  <head>
    <title>Contact</title>
  </head>
  <body>
    <div class="card bg-light">
       <div class="card-body mx-auto" style="max-width: 800px;">
          <div class="jumbotron text-center">
             <h1>Heeft u een klacht?<h1>
    <form method="post">
      <select class="form-select form-select-sm" id="inputGroupSelect01" name="betreffend" required>
          <option value="">Klacht betreffend: </option>
          <option value="Hotel">Hotel</option>
          <option value="Vliegreis">Vliegreis</option>
          <option value="Website">Website</option>
      </select>
       <div class="input-group">
         <span class="input-group-text">Omschrijf het probleem dat u ervaart: </span>
         <textarea class="form-control"  name="probleem"></textarea>
      </div>
      <div class="input-group">
        <span class="input-group-text">Wat verwacht u van ons? </span>
        <textarea class="form-control"  name="verwachting"></textarea>
     </div>

       <div class="form-group">
          <div class="text-center">
             <button type="submit" name="submit" class="btn btn-primary btn-block">Verstuur</button>
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
