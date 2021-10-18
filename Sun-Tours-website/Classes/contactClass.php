<?php

class Contact
{
  private $klantID; //ID van klant die contact opneemt
  private $soort; //Vraag, klacht, feedback
  private $onderwerp; //gekozen onderwerp door klant
  private $opmerking; //vraag, klacht, feedback van klant

  //Maak contact(vraag,klacht,feedback) instance aan en met de meegegeven info
  function __construct($klantID, $soort, $onderwerp, $opmerking)
  {
    $this->klantID = $klantID;
    $this->soort = $soort;
    $this->onderwerp = $onderwerp;
    $this->opmerking = $opmerking;
  }

  public function CreateContact($database){//zet ingegeven info in de database
    $db = $database->connection();
    $query = $db->prepare("INSERT INTO `contact` (`KlantID`, `Type`, `Onderwerp`, `Opmerking`)
    VALUES ('$this->klantID','$this->soort','$this->onderwerp','$this->opmerking')");
    $query->execute();

    $db = NULL; //verbreek verbinding met database
  }
}






 ?>
