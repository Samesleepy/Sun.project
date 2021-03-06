<?php

class Faq
{
  private $qID; //ID van faq
  private $vraagNL; //Vraag in het Nederlands
  private $antwoordNL; //Antwoord in het Nederlands
  private $vraagEN; //Vraag in het Engels
  private $antwoordEN; //Antwoord in het Engels

  //Maak faq instance aan en met de meegegeven info
  function __construct($qID, $vraagNL, $antwoordNL, $vraagEN, $antwoordEN)
  {
    $this->qID = $qID;
    $this->vraagNL = $vraagNL;
    $this->antwoordNL = $antwoordNL;
    $this->vraagEN = $vraagEN;
    $this->antwoordEN = $antwoordEN;
  }

  public function ShowFaq($key){//Laat faq zien met accordion ?>
    <div class="accordion-item">
      <h2 class="accordion-header" id="heading<?php echo $key ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key ?>" aria-expanded="true" aria-controls="collapse<?php echo $key ?>">
          <?php echo $this->vraagNL; ?>
        </button>
      </h2>
      <div id="collapse<?php echo $key ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $key ?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <?php echo $this->antwoordNL; ?>
        </div>
      </div>
    </div>
  <?php }


}






//
// $db = $database->connection();
// $stmt = $db->prepare("SELECT `QID`,`Vraag-NL`,`Antwoord-NL`,`Vraag-EN`,`Antwoord-EN` FROM `FAQ`");
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $FAQs = $result;






 ?>
