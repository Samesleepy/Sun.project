<?php
//include_once 'db.php';

class User
{
//$wachtwoord = $_POST['wachtwoord'];
  private $klantID; //ID van klant
  public $voornaam;
  public $achternaam;
  public $tussenvoegsel; //(mogelijk) Tussenvoegsel
  private $email;
  private $telefoonnummer;
  private $hashed_wachtwoord; //Wachtwoord nadat deze gehasht is
  private $role;
  private $land;
  private $woonplaats;
  private $postcode;
  private $straatnaam;
  private $huisnummer;

  function __construct()//Maak user instance aan met default waardes
  {
    $this->voornaam = "";
    $this->achternaam = "";
    $this->tussenvoegsel = "";
    $this->email = "";
    $this->telefoonnummer = 0;
    $this->land = "";
    $this->woonplaats = "";
    $this->postcode = "";
    $this->straatnaam = "";
    $this->huisnummer = "";
  }

  private function CheckCredentials($database,$email,$wachtwoord){ //Controleer of email bestaat, controleer daarna of wachtwoord overeenkomt met wachtwoord van email's account
    $db = $database->connection();
    $stmt = $db->prepare("SELECT * FROM `Klant` WHERE `Email`='".$email."'");
    $stmt->execute();
    $result = $stmt->fetch();
    if($result){
      if(password_verify($wachtwoord, $result['Wachtwoord'])){
        $db = NULL; //verbreek verbinding met database
        return $result;
      }else{
        $result = "Fout";
        $db = NULL; //verbreek verbinding met database
        return $result;
      }
    }else{
      $result = "Fout";
      $db = NULL; //verbreek verbinding met database
      return $result;
    }
  }

  public function Login($database,$email,$wachtwoord){ //log de user in, update de default waardes van de instance
    $result = $this->CheckCredentials($database,$email,$wachtwoord);
    if($result != "Fout"){
      $this->klantID = $result['KlantID'];
      $this->voornaam = $result['Voornaam'];
      $this->achternaam = $result['Achternaam'];
      $this->tussenvoegsel = $result['Tussenvoegsel'];
      $this->email = $result['Email'];
      $this->telefoonnummer = $result['Telefoonnummer'];
      $this->role = $result['Role'];
      $this->land = $result['Land'];
      $this->woonplaats = $result['Woonplaats'];
      $this->postcode = $result['Postcode'];
      $this->straatnaam = $result['Straatnaam'];
      $this->huisnummer = $result['Huisnummer'];

      return True;
    }else{
      return False;
    }
  }

  public function Signup($database, $voornaam, $achternaam, $tussenvoegsel, $email, $telefoonnummer, $hashed_wachtwoord, $land, $woonplaats, $postcode, $straatnaam, $huisnummer){
    try {
      $db = $database->connection();
      $sql = "INSERT INTO `klant` (`Voornaam`, `Achternaam`, `Tussenvoegsel`, `Email`, `Wachtwoord`, `Telefoonnummer`,`Land`,`Woonplaats`, `Postcode`, `Straatnaam`, `Huisnummer`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
      $stmt= $db->prepare($sql);
      $success = $stmt->execute([$voornaam, $achternaam, $tussenvoegsel, $email,
      $hashed_wachtwoord, $telefoonnummer, $land , $woonplaats, $postcode, $straatnaam, $huisnummer]);
    } catch (PDOException $e) {
      if($e->errorInfo[1] == 1062){ // 1062 is duplicate entry
        echo "Email al in gebruik";
      }else{
        echo "Er is iets misgegaan";
      }
    }
    Header('Location: Login.php');

    $db = NULL; //verbreek verbinding met database
  }

  public function UpdateUserInfo($database, $voornaam, $achternaam, $tussenvoegsel, $email, $telefoonnummer, $land, $woonplaats, $postcode, $straatnaam, $huisnummer){ //Update info van het ingelogde account
        $db = $database->connection();

        $sql = "UPDATE `klant` SET
        `Voornaam` = '".$voornaam."',
        `Achternaam` = '".$achternaam."',
        `Tussenvoegsel` = '".$tussenvoegsel."',
        `Email` = '".$email."',
        `Telefoonnummer` = '".$telefoonnummer."',
        `Land` = '".$land."',
        `Woonplaats` = '".$woonplaats."',
        `Postcode` = '".$postcode."',
        `Straatnaam` = '".$straatnaam."',
        `Huisnummer` = '".$huisnummer."'
        WHERE `KlantID` = '".$this->klantID."'";
        $stmt= $db->prepare($sql);
        $stmt->execute();

        $stmt = $db->prepare("SELECT * FROM `Klant` WHERE `KlantID`='".$this->klantID."'");
        $stmt->execute();
        $result = $stmt->fetch();
        $this->klantID = $result['KlantID'];
        $this->voornaam = $result['Voornaam'];
        $this->achternaam = $result['Achternaam'];
        $this->tussenvoegsel = $result['Tussenvoegsel'];
        $this->email = $result['Email'];
        $this->telefoonnummer = $result['Telefoonnummer'];
        $this->land = $result['Land'];
        $this->woonplaats = $result['Woonplaats'];
        $this->postcode = $result['Postcode'];
        $this->straatnaam = $result['Straatnaam'];
        $this->huisnummer = $result['Huisnummer'];

        $db = NULL; //verbreek verbinding met database
  }

  public function GetUserInfo(){ //Omdat userinfo private is moet je hem met een functie uit de instance halen
    $Userinfo = array();
    $Userinfo = ['KlantID'=>$this->klantID, 'Voornaam'=>$this->voornaam, 'Achternaam'=>$this->achternaam, 'Tussenvoegsel'=>$this->tussenvoegsel, 'Email'=>$this->email, 'Telefoonnummer'=>$this->telefoonnummer,
    'Land'=>$this->land, 'Woonplaats'=>$this->woonplaats,'Postcode'=>$this->postcode,
    'Straatnaam'=>$this->straatnaam, 'Huisnummer'=>$this->huisnummer];
    return $Userinfo;
  }

  public function ChangePass($database, $klantID, $newPass, $oldPass, $rePass){ //Verander wachtwoord van ingelogde account, repass is het herhaalde wachtwoord
    $db = $database->connection();
    //if(isset($_POST['submit'])) {
      $stmt = $db->query("SELECT `Wachtwoord` FROM `klant` WHERE `KlantID`='".$klantID."'");
      $resultpass = $stmt->fetch(PDO::FETCH_ASSOC);
      $passNew_hashed = password_hash($newPass, PASSWORD_DEFAULT);

      if(password_verify($oldPass, $resultpass['Wachtwoord'])){
          if($newPass === $rePass){
              $stmt = $db->prepare("UPDATE `klant` SET `Wachtwoord` = '".$passNew_hashed."' WHERE `KlantID` = '".$klantID."'");
              $stmt->execute();
              header("Location: profiel.php");
          }else{
              echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Fout! Herhaal het nieuwe wachtwoord</div>";
          }
      }else{
          echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Fout! Je oude wachtwoord is verkeerd</div>";
      }
      $db = NULL; //verbreek verbinding met database
    //}
  }

  public function CheckIfBooked($database, $BestemmingID){
    $geboekt = False;
    $db = $database->connection();
    $stmt = $db->query("SELECT * FROM `Boeking` WHERE `BestemmingID` = '".$BestemmingID."' AND `KlantID` = '".$this->klantID."'");
    $result = $stmt->fetch();
    if($result){
      $geboekt = True;
    }else{
      $geboekt = False;
    }
    return $geboekt;
  }

  public function DeleteUser($database, $KlantID){//verwijderd een klant
    $db = $database->connection();
    $stmt = $db->prepare("DELETE FROM `klant` WHERE `KlantID` = '".$this->klantID."'");
    $stmt->execute();
    $db = NULL; //verbreek verbinding met database
  }

}
?>
