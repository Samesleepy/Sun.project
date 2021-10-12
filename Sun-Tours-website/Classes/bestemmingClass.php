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
  private $beschrijving;

  function __construct($id, $land, $plaats, $type, $prijs, $beschrijving, $limiet, $plaatje, $score, $boekingen )
    {
      $this->id = $id;
      $this->land = $land;
      $this->plaats = $plaats;
      $this->type = $type;
      $this->prijs = $prijs;
      $this->beschrijving = $beschrijving;
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

  public function ShowBestemming(){
    echo '<a href="boeken.php?id='.$this->id.'" style="text-decoration:none;color:black;">';
      echo '<div class="card" id="bestemmingen">';
        echo '<img src="data:image/png;base64,'.base64_encode($this->plaatje).'"/>';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">'.$this->plaats.", ".$this->land.'</h5>';
          echo '<a class="card-link">';
          if($this->boekingen >= $this->limiet){echo "Volgeboekt";}else{ echo $this->prijs. " Euro p.p.";}
          echo '</a>';
          echo '<a class="card-link" style="text-decoration:none;color:black;">';
          if(isset($this->score)){$this->score = substr($this->score, 0, -3);}
        if(isset($this->score)){echo "Score: " . $this->score;}else{echo "Geen score";}
      echo '</a>';
    echo '</div>';
  echo '</div>';
  echo '</a>';
  }

  // public function GetBestemmingFromId($database,$id){
  //   $db = $database->connection();
  //   $stmt = $db->prepare("SELECT `ID`, `Land`,`Plaats`,`Type`,`Prijs`,`Limiet`,`Plaatje` FROM `bestemming`WHERE `ID` = '".$id."'");
  //   $stmt->execute();
  //   $result = $stmt->fetch();
  //   $this->id = $result['ID'];
  //   $this->land = $result['Land'];
  //   $this->plaats = $result['Plaats'];
  //   $this->type = $result['Type'];
  //   $this->prijs = $result['Prijs'];
  //   $this->limiet = $result['Limiet'];
  //   $this->plaatje = $result['Plaatje'];
  // }

  public function GetBestemmingInfo(){
    $Bestemminginfo = array();
    $Bestemminginfo = ['ID'=>$this->id, 'Land'=>$this->land, 'Plaats'=>$this->plaats, 'Type'=>$this->type, 'Prijs'=>$this->prijs, 'Limiet'=>$this->limiet, 'Plaatje'=>$this->plaatje, 'Score'=>$this->score, 'Beschrijving'=>$this->beschrijving];

    return $Bestemminginfo;
  }
}

?>
