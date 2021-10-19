<?php

class Review
{
  public $bestemmingID; //ID van bestemming van waar het om gaat
  private $voornaam;
  private $achternaam;
  private $tussenvoegsel; //(mogelijk) Tussenvoegsel
  private $score; //Score die de klant geeft aan de review
  private $review; //Text van review
  private $datum; //Wanneer de review geschreven is

  //Maak review instance aan en met de meegegeven info
  function __construct($bestemmingID, $voornaam, $achternaam, $tussenvoegsel, $score, $review, $datum)
  {
    $this->bestemmingID = $bestemmingID;
    $this->voornaam = $voornaam;
    $this->achternaam = $achternaam;
    $this->tussenvoegsel = $tussenvoegsel;
    $this->score = $score;
    $this->review = $review;
    $this->datum = $datum;
  }


  public function CreateReview($database){ //Zet review in database
    $db = $database->connection();

    $sql = "INSERT INTO `review`(`BestemmingID`,`Voornaam`, `Achternaam`, `Tussenvoegsel`, `Score`, `Opmerking`,`Datum`) VALUES(?,?,?,?,?,?,?)";

    $stmt= $db->prepare($sql);
    $stmt->execute([$this->bestemmingID, $this->voornaam, $this->achternaam, $this->tussenvoegsel, $this->score, $this->review, $this->datum]);

    $db = NULL;
  }

  public function ShowReview(){ //laat review zien met een card, info uit de instance
  echo  '<div class="card">';
    echo  '<div class="card-body">';
      echo  '<h5 class="card-title">'.$this->voornaam. " " ;
          if($this->tussenvoegsel!= ""){
             echo " " .$this->tussenvoegsel. " ";
          }
          echo $this->achternaam.'</h5>';
          echo '<h6 class="card-subtitle mb-2 text-muted">'.$this->datum.'</h6>';
          echo '<p class="card-text">'.$this->score.'</p>';
          echo '<p class="card-text">'.$this->review.'</p>';
      echo '</div>';
  echo  '</div>';
  }

}
?>
