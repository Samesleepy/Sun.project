<?php

class Boeking
{
  private $bestemmingID; //ID van bestemming die je wil boeken
  private $klantID; //ID van klant die aan het boeken is
  private $land; //land van bestemming
  private $plaats; //plaats van bestemming
  private $prijs; //totale prijs van boeking
  private $personen; //hoeveel personen mee gaan
  private $vertrekdatum;
  private $boekingsdatum; //wanneer er geboekt is
  private $duur; //hoelang (in dagen) de reis is
  private $hotel;
  private $vervoer;
  public  $BoekingID; //ID dat wordt aangemaakt als een boeking geplaatst is(nodig voor factuur)

  //Maak boeking instance aan en met de meegegeven info
  function __construct($bestemmingID, $klantID, $land, $plaats, $prijs, $personen, $vertrekdatum, $boekingsdatum, $duur, $hotel, $vervoer)
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
    $this->hotel = $hotel;
    $this->vervoer = $vervoer;
  }

  function ShowBoekingForm(){

  }

 //maak cancel optie of factuur pagina, laat boeking gebeuren

  function Boeken($database){ //stuur boekinginfo naar database en geef boekingID terug, om id te laten zien
    $db = $database->connection();
    $query = $db->prepare("INSERT INTO `boeking` (`BestemmingID`,`KlantID`,`Land`,`Plaats`,`Prijs`,`Hotel`,`Vervoer`,`Personen`,`Vertrekdatum`,`Boekingsdatum`,`Duur`)
    VALUES ('$this->bestemmingID','$this->klantID','$this->land',
      '$this->plaats','$this->prijs','$this->hotel','$this->vervoer','$this->personen','$this->vertrekdatum','$this->boekingsdatum','$this->duur')");
    $query->execute();
    $result = $db->lastInsertId();
    // $stmt = $db->prepare("SELECT LAST_INSERT_ID();");
    // $stmt = $db->execute();
    $BoekingID = $result;
    $this->BoekingID = $BoekingID;

    $db = NULL; //verbreek verbinding met database
  }
}






?>
