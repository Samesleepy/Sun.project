<?php

class Bestemming
{
  private $id;
  private $land;
  private $plaats;
  private $type;
  private $prijs;
  private $limiet;
  private $plaatje;
  private $score;
  private $boekingen;

   function __construct($id, $land, $plaats, $type, $prijs, $limiet, $plaatje, $score, $boekingen)
  //function __construct($database,$id)
  {
    $this->id = $id;
    $this->land = $land;
    $this->plaats = $plaats;
    $this->type = $type;
    $this->prijs = $prijs;
    $this->limiet = $limiet;
    $this->plaatje = $plaatje;
    $this->score = $score;
    $this->boekingen = $boekingen;

    // $db = $database->connection();
    // $stmt = $db->prepare("SELECT bestemming.`ID`, bestemming.`Land`, bestemming.`Plaats`, `Type`, bestemming.`Prijs`,`Limiet`,`Plaatje`,
    // AVG(`Score`), SUM(`Personen`)
    // FROM `bestemming`
    // LEFT JOIN review
    // ON bestemming.ID = review.BestemmingID
    // LEFT JOIN boeking
    // ON bestemming.ID = boeking.BoekingID
    // GROUP BY bestemming.ID;");
    // $stmt->execute();
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //
    // $this->id = $result['ID'];
    // $this->land = $result['Land'];
    // $this->plaats = $result['ID'];
    // $this->type = $result['ID'];
    // $this->prijs = $result['ID'];
    // $this->limiet = $result['ID'];
    // $this->plaatje = $result['ID'];
    // $this->score = $result['ID'];
    // $this->boekingen = $result['ID'];

  }

  // public function FillBestemming($database){
  //   $db = $database->connection();
  //   $stmt = $db->prepare("SELECT bestemming.`ID`, bestemming.`Land`, bestemming.`Plaats`, `Type`, bestemming.`Prijs`,`Limiet`,`Plaatje`,
  //   AVG(`Score`), SUM(`Personen`)
  //   FROM `bestemming`
  //   LEFT JOIN review
  //   ON bestemming.ID = review.BestemmingID
  //   LEFT JOIN boeking
  //   ON bestemming.ID = boeking.BoekingID
  //   GROUP BY bestemming.ID;");
  //   $stmt->execute();
  //   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //   return $result;
  // }

  public function ShowBestemming(){
    echo '<a href="boeken.php?id='.$this->id.'">';
      echo '<div class="card" id="bestemmingen">';
        echo '<img src="data:image/png;base64,'.base64_encode($this->plaatje).'"/>';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">'.$this->plaats.", ".$this->land.'</h5>';
        //  echo '<a class="card-link">';
          //if($countlimit >= $this->limiet){echo "Volgeboekt";}else{ echo $this->prijs. " Euro p.p.";}
          //echo '</a>';
         echo '<a class="card-link">';
        if(isset($this->score)){echo "Score: " . $this->score;}
      echo '</a>';
     echo '</div>';
  echo '</div>';
  echo '</a>';
  }


  public function GetBestemmingFromId($database,$id){
    $db = $database->connection();
    $stmt = $db->prepare("SELECT `ID`, `Land`,`Plaats`,`Type`,`Prijs`,`Plaatje`,`Limiet` FROM `bestemming`WHERE `ID` = '".$id."'");
    $stmt->execute();
    $result = $stmt->fetch();
      $this->id = $result['ID'];
      $this->land = $result['Land'];
      $this->plaats = $result['Plaats'];
      $this->type = $result['Type'];
      $this->prijs = $result['Prijs'];
      $this->plaatje = $result['Plaatje'];
      $this->limiet = $result['Limiet'];
    }
}

//Moet op pagina waar ik het wil laten zien
// $db = $database->connection();
// $stmt = $db->prepare("SELECT bestemming.`ID`, bestemming.`Land`, bestemming.`Plaats`, `Type`, bestemming.`Prijs`,`Limiet`,`Plaatje`,
// AVG(`Score`), SUM(`Personen`)
// FROM `bestemming`
// LEFT JOIN review
// ON bestemming.ID = review.BestemmingID
// LEFT JOIN boeking
// ON bestemming.ID = boeking.BoekingID
// GROUP BY bestemming.ID;");
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $Bestemmingresult = $result;
//
// foreach ($Bestemmingresult as $bestemming) {
//   $Bestemmingen[] = new Bestemming($bestemming['ID'], $bestemming['Land'], $bestemming['Plaats'], $bestemming['Type'], $bestemming['Prijs'], $bestemming['Limiet'], $bestemming['Plaatje'], $bestemming['AVG(`Score`)'], $bestemming['SUM(`Personen`)']);
// }
//////////////////////////////////////////////////////////

 ?>
