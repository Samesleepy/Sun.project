<?php

class Faq
{
  private $qID;
  private $vraagNL;
  private $antwoordNL;
  private $vraagEN;
  private $antwoordEN;

  function __construct($qID, $vraagNL, $antwoordNL, $vraagEN, $antwoordEN)
  {
    $this->qID = $qID;
    $this->vraagNL = $vraagNL;
    $this->antwoordNL = $antwoordNL;
    $this->vraagEN = $vraagEN;
    $this->antwoordEN = $antwoordEN;


  }

  public function ShowFaq($key){
    echo '<div style="margin-top: 10px;" class="d-flex justify-content-center">';
      echo '<div class="accordion accordion-flush" id="accordionFlushExample" style="width: 50%;border: 1px solid black">';
        echo '<div class="accordion-header">';
          echo '<h2 class="accordion-item" id="flush-heading'.$key. '">';
          echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse'.$key.'aria-expanded="false" aria-controls="flush-collapse'. $key. '">';
             echo $this->vraagNL;
            echo '</button>';
          echo '</h2>';
          echo '<div id="flush-collapse<?php echo $key; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading'.$key.'" data-bs-parent="#accordionFlushExample">';
          echo '<div class="accordion-body">'; echo $this->antwoordNL; '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }


}






//
// $db = $database->connection();
// $stmt = $db->prepare("SELECT `QID`,`Vraag-NL`,`Antwoord-NL`,`Vraag-EN`,`Antwoord-EN` FROM `FAQ`");
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $FAQs = $result;






 ?>
