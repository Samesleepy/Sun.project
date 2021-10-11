<?php
//include_once 'db.php';

class User
{
//$wachtwoord = $_POST['wachtwoord'];
  private $klantID;
  public $voornaam;
  public $achternaam;
  public $tussenvoegsel;
  private $email;
  private $telefoonnummer;
  private $hashed_wachtwoord;
  private $land;
  private $woonplaats;
  private $postcode;
  private $straatnaam;
  private $huisnummer;

  //function __construct($voornaam, $achternaam, $tussenvoegsel, $email, $telefoonnummer, $hashed_wachtwoord, $land, $woonplaats, $postcode, $straatnaam, $huisnummer)
  function __construct()
  {
    $this->klantID = 0;
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

  private function CheckCredentials($database,$email,$wachtwoord){
    $db = $database->connection();
    $stmt = $db->prepare("SELECT * FROM `Klant` WHERE `Email`='".$email."'");
    $stmt->execute();
    $result = $stmt->fetch();
    if($result){
      if(password_verify($wachtwoord, $result['Wachtwoord'])){
        $db = NULL;
        return $result;
      }else{
        $result = "Fout";
        $db = NULL;
        return $result;
      }
    }else{
      $result = "Fout";
      $db = NULL;
      return $result;
    }
  }

  public function Login($database,$email,$wachtwoord){
    $result = $this->CheckCredentials($database,$email,$wachtwoord);
    if($result != "Fout"){
      $this->klantID = $result['KlantID'];
      $this->voornaam = $result['Voornaam'];
      $this->achternaam = $result['Achternaam'];
      $this->tussenvoegsel = $result['Tussenvoegsel'];
      $this->email = $result['Email'];
      $this->telefoonnummer = $result['Telefoonnummer'];
      $this->land = $result['Land'];
      $this->woonplaats = $result['Woonplaats'];
      $this->straatnaam = $result['Straatnaam'];
      $this->huisnummer = $result['Huisnummer'];

      return True;
    }else{
      return False;
    }
  }

  public function Signup($database){
    $db = $database->connection();
    $sql = "INSERT INTO `klant` (`Voornaam`, `Achternaam`, `Tussenvoegsel`, `Email`, `Wachtwoord`, `Telefoonnummer`,`Land`,`Woonplaats`, `Postcode`, `Straatnaam`, `Huisnummer`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt= $db->prepare($sql);
    $success = $stmt->execute([$this->voornaam, $this->achternaam, $this->tussenvoegsel, $this->email,
    $this->hashed_wachtwoord, $this->telefoonnummer,$this->land , $this->woonplaats, $this->postcode, $this->straatnaam, $this->huisnummer]);

    if(!$success){//error
      if($stmt->errorCode()==23000){ // duplicate enrty
        echo "Email is al in gebruik";
      }else{
        echo "Er is iets misgegaan";
      }
    }else{
      if($success){
        Header('Location: Login.php');
      }
    }
    $db = NULL;
  }
  public function GetUserInfo(){
    $Userinfo = array();
    $Userinfo = ['klantID'=>$this->klantID, 'Voornaam'=>$this->voornaam, 'Achternaam'=>$this->achternaam, 'Tussenvoegsel'=>$this->tussenvoegsel, 'Email'=>$this->email, 'Telefoonnummer'=>$this->telefoonnummer,
    'Land'=>$this->land, 'Woonplaats'=>$this->woonplaats,'Postcode'=>$this->postcode,
    'Straatnaam'=>$this->straatnaam, 'Huisnummer'=>$this->huisnummer];
    return $Userinfo;
  }

}






 ?>
