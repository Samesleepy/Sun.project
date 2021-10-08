<?php

class Boeking
{

  function __construct()
  {

  }

  function ShowBoekingForm(){

  }


  function Boeken($BestemmingID,$KlantID,$Land,$Plaats,$Personen,$Vertrekdatum,$Duur){

    $query = $db->prepare("INSERT INTO `boeking` (`BestemmingID`, `KlantID`, `Land`,`Plaats`, `Prijs`, `Personen`, `Vertrekdatum`, `Duur`)
    VALUES ('$BestemmingID','$KlantID','$Land','$Plaats','$prijs','$Personen','$Vertrekdatum','$Duur')");
    $query->execute();
  }
}






 ?>
