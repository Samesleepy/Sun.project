<?php include_once 'header.php' ?>

<!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <title>FAQ</title>
  </head>
  <body>
    <body>
    <?php
      $db = $database->connection();
      $stmt = $db->prepare("SELECT `QID`,`Vraag-NL`,`Antwoord-NL`,`Vraag-EN`,`Antwoord-EN` FROM `FAQ`");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $FAQs = $result;

       foreach ($FAQs as $FAQ) {
          ?>
          <div class="card text-white bg-primary" id="faq">
             <div class="card-body">
                <h2 class="card-title"><?php echo $FAQ['Vraag-NL']?></h5>
                <h4 class="card-text"><?php echo $FAQ['Antwoord-NL']?></h4>
             </div>
          </div>
       </a>
    <?php } ?>
    </body>
  </body>


<?php include_once 'footer.php' ?>
