<?php

class Contact
{
  private $klantID;
  private $soort;
  private $onderwerp;
  private $opmerking;

  function __construct($klantID, $soort, $onderwerp, $opmerking)
  {
    $this->klantID = $klantID;
    $this->soort = $soort;
    $this->onderwerp = $onderwerp;
    $this->opmerking = $opmerking;
  }

  public function CreateContact($database){
    $db = $database->connection();
    $query = $db->prepare("INSERT INTO `contact` (`KlantID`, `Type`, `Onderwerp`, `Opmerking`)
    VALUES ('$this->klantID','$this->soort','$this->onderwerp','$this->opmerking')");
    $query->execute();

    $db = NULL;
  }
}






 ?>
