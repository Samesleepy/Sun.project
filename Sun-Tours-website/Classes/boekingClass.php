<?php

class Boeking
{
  private $bestemmingID;
  private $klantID;
  private $land;
  private $plaats;
  private $prijs;
  private $personen;
  private $vertrekdatum;
  private $boekingsdatum;
  private $duur;

  function __construct($bestemmingID, $klantID, $land, $plaats, $prijs, $personen, $vertrekdatum, $boekingsdatum, $duur)
  {
    $this->bestemmingID = $bestemmingID;
    $this->klantID = $klantID;
    $this->land = $land;
    $this->plaats = $plaats;
    $this->prijs = $prijs;
    $this->personen = $personen;
    $this->vertrekdatum = $vertrekdatum;
    $this->boekingsdatum = $boekingsdatum;
    $this->duur = $duur;
  }

  function ShowBoekingForm(){

  }


  function Boeken($database){
    $db = $database->connection();
    $query = $db->prepare("INSERT INTO `boeking` (`BestemmingID`, `KlantID`, `Land`,`Plaats`, `Prijs`, `Personen`, `Vertrekdatum`,`Boekingsdatum`, `Duur`)
    VALUES ('$this->bestemmingID','$this->klantID','$this->land',
      '$this->plaats','$this->prijs','$this->personen','$this->vertrekdatum','$this->boekingsdatum','$this->duur')");
    $query->execute();
  }
}






 ?>
