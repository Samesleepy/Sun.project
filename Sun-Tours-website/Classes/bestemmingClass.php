<?php

class Bestemming
{
  private $ID; //ID van bestemming
  private $land;
  private $plaats; //plaats(stad, etc.)
  private $type; //type(cultuur,stedentrip etc.)
  private $prijs; //prijs per persoon
  private $limiet; //hoeveel boekingen er mogen zijn
  private $plaatje;
  private $score; //gemiddelde score van reviews
  private $boekingen; //hoeveel boekingen er NU zijn
  private $beschrijving;

  //Maak bestemming instance aan en met de meegegeven info
  function __construct($ID, $land, $plaats, $type, $prijs, $beschrijving, $limiet, $plaatje, $score, $boekingen )
    {
      $this->ID = $ID;
      $this->land = $land;
      $this->plaats = $plaats;
      $this->type = $type;
      $this->prijs = $prijs;
      $this->beschrijving = $beschrijving;
      $this->limiet = $limiet;
      $this->plaatje = $plaatje;
      $this->score = $score;
      $this->boekingen = $boekingen;
    }

  public function ShowBestemming($width){ //laat bestemming zien met een card, informatie uit de instance
    echo '<a href="boeken.php?id='.$this->ID.'" style="text-decoration:none;color:black;">';
      echo '<div class="card" id="bestemmingen" style="width: '.$width.';">';
        echo '<img src="data:image/png;base64,'.base64_encode($this->plaatje).'"/>';
          echo '<div class="card-body">';
            echo '<h5 class="card-title">'.$this->plaats.", ".$this->land.'</h5>';
            echo '<a class="card-link" style="text-decoration:none;color:black;">';
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

  public function GetBestemmingInfo(){ //Omdat variabelen private zijn moet je hiermee info ophalen
    $Bestemminginfo = array(); //associative array
    $Bestemminginfo = ['ID'=>$this->ID, 'Land'=>$this->land, 'Plaats'=>$this->plaats, 'Type'=>$this->type, 'Prijs'=>$this->prijs, 'Limiet'=>$this->limiet, 'Plaatje'=>$this->plaatje, 'Score'=>$this->score, 'Beschrijving'=>$this->beschrijving];

    return $Bestemminginfo;
  }

  public function AdminUpdateBestemming($database, $land, $plaats, $type, $prijs, $limiet, $beschrijving){
    $db = $database->connection();
    $stmt = $db->prepare("UPDATE `bestemming` SET `Land` = '".$land."', `Plaats` = '".$plaats."', `Type` = '".$type."', `Prijs` = '".$prijs."', `Limiet` = '".$limiet."', `Beschrijving` = '".$beschrijving."'
    WHERE `ID` = '".$this->ID."';");
    $stmt->execute();
    $db = NULL;
  }

  public function AdminAddBestemming($database){
    $db = $database->connection();
    $stmt = $db->prepare("INSERT INTO `bestemming`(`Land`, `Plaats`, `Type`, `Beschrijving`, `Prijs`, `Limiet`, `Plaatje`) VALUES ('$this->land','$this->plaats','$this->type','$this->beschrijving','$this->prijs','$this->limiet','$this->plaatje')");
    $stmt->execute();
  }
}

?>
