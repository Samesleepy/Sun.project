<?php include_once 'header.php' ?>

  <head>
    <meta charset="utf-8">
    <title>FAQ</title>
        <link rel="stylesheet" href="test.css"/>
  </head>
  <body>
    <?php
      $db = $database->connection();
      $stmt = $db->prepare("SELECT `QID`,`Vraag-NL`,`Antwoord-NL`,`Vraag-EN`,`Antwoord-EN` FROM `FAQ`");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $FAQs = $result;
      ?>
      <h1 style="text-align: center;">Welkom op de FAQ!</h1>
      <h3 style="text-align: center;">hier kunt u antwoorden voor veelgestelde vragen vinden.</h3>
      <?php foreach ($FAQs as $key => $FAQ){ ?>
      <div style="margin-top: 10px;" class="d-flex justify-content-center">
        <div class="accordion accordion-flush" id="accordionFlushExample" style="width: 50%;border: 1px solid black">
          <div class="accordion-header">
            <h2 class="accordion-item" id="flush-heading<?php echo $key; ?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $key; ?>">
                <?php echo $FAQ['Vraag-NL']?>
              </button>
            </h2>
            <div id="flush-collapse<?php echo $key; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $key; ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body"><?php echo $FAQ['Antwoord-NL']?></div>
            </div>
          </div>
        </div>
      </div>
      <?php ;} ?>
    <h2 style="text-align: center;">Is uw vraag nog niet beantwoord?</h2>
    <form action='contact.php' style="text-align: center;">
      <button type='submit' name='contact' class='btn btn-primary btn-block'>Terug naar contact</button>
    </form>
  </body>

<?php include_once 'footer.php'; ?>