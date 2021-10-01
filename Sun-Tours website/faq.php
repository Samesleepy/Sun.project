<?php include_once 'header.php' ?>

  <head>
    <meta charset="utf-8">
    <title>FAQ</title>
        <link rel="stylesheet" href="test.css"/>
  </head>
  <body>
    <body>
    <?php
      $db = $database->connection();
      $stmt = $db->prepare("SELECT `QID`,`Vraag-NL`,`Antwoord-NL`,`Vraag-EN`,`Antwoord-EN` FROM `FAQ`");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $FAQs = $result;

      ?><div id="faqpage">
      <h1>Welkom op de FAQ!</h1>
        <h3>hier kunt u antwoorden voor veelgestelde vragen vinden.</h3><?php
       foreach ($FAQs as $FAQ) {
          ?>
          <div id="faq" class="card border-primary" >
             <div class="card-body">
                <h2 class="card-header text-white bg-primary"><?php echo $FAQ['Vraag-NL']?></h5>
                <h4 class="card-text"><?php echo $FAQ['Antwoord-NL']?></h4>
             </div>
          </div>
       </a>
    <?php } ?>
    <h2>Is uw vraag nog niet beantwoord?</h2>
      <form action='contact.php'>
         <button type='submit' name='contact' class='btn btn-primary btn-block'>Terug naar contact</button>
      </form>
    </div>
  </body>

<?php include_once 'footer.php' ?>
