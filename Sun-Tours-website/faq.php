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
    <h1 style="text-align: center;"><?=  $text[$_SESSION['lang']]['faq'][1] ?></h1>
    <h3 style="text-align: center;"><?=  $text[$_SESSION['lang']]['faq'][2] ?></h3>

    <div class="container col-xl-10 col-xxl-6 px-4 py-5">
      <div class="accordion" id="accordionExample">
        <?php
        foreach ($FAQs as $key => $FAQ){
          $FAQ[$key] = new Faq($FAQ['QID'], $FAQ['Vraag-NL'], $FAQ['Antwoord-NL'], $FAQ['Vraag-EN'], $FAQ['Antwoord-EN']);
          $FAQ[$key]->ShowFaq($key);
        }
        ?>
      </div>
    </div>
    <h2 style="text-align: center;"><?=  $text[$_SESSION['lang']]['faq'][3] ?></h2>
    <form action='contact.php' style="text-align: center;">
      <button type='submit' name='contact' class='btn btn-primary btn-block'><?=  $text[$_SESSION['lang']]['faq'][4] ?></button>
    </form>
  </body>

<?php include_once 'footer.php'; ?>
