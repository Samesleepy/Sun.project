<?php include_once 'header.php' ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container col-xl-10 col-xxl-6 px-4 py-5">
      <h2><?=  $text[$_SESSION['lang']]['covid'][1] ?></h2>
      <p><?=  $text[$_SESSION['lang']]['covid'][2] ?></p>
      <h3><?=  $text[$_SESSION['lang']]['covid'][3] ?></h3>
      <p><?=  $text[$_SESSION['lang']]['covid'][4] ?> <strong><?=  $text[$_SESSION['lang']]['covid'][5] ?></strong><?=  $text[$_SESSION['lang']]['covid'][6] ?></p>
      <a href="https://www.nederlandwereldwijd.nl/documenten/vragen-en-antwoorden/welke-landen-hebben-welke-kleurcode" class="d-flex justify-content-center" target="_blank"><?=  $text[$_SESSION['lang']]['covid'][7] ?></a>
      <a href="https://www.nederlandwereldwijd.nl/reizen/reisadviezen" class="d-flex justify-content-center" target="_blank"><?=  $text[$_SESSION['lang']]['covid'][8] ?></a>
    </div>
  </body>
</html>

<?php include_once 'footer.php' ?>
