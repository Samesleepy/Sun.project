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

    //$this->klantID = $klantID;
    // $this->voornaam = $voornaam;
    // $this->achternaam = $achternaam;
    // $this->tussenvoegsel = $tussenvoegsel;
    // $this->email = $email;
    // $this->telefoonnummer = $telefoonnummer;
    // $this->hashed_wachtwoord = $hashed_wachtwoord;
    // $this->land = $land;
    // $this->woonplaats = $woonplaats;
    // $this->postcode = $postcode;
    // $this->straatnaam = $straatnaam;
    // $this->huisnummer = $huisnummer;
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
      if($e->errorInfo[1] == 1062){ // duplicate entry
        echo "Email al in gebruik";
      }else{
        echo "Er is iets misgegaan";
      }
    }
    Header('Location: Login.php');

    $db = NULL;
  }

  public function UpdateUserInfo($database, $voornaam, $achternaam, $tussenvoegsel, $email, $telefoonnummer, $land, $woonplaats, $postcode, $straatnaam, $huisnummer){
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

        $db = NULL;
  }

  public function GetUserInfo(){
    $Userinfo = array();
    $Userinfo = ['KlantID'=>$this->klantID, 'Voornaam'=>$this->voornaam, 'Achternaam'=>$this->achternaam, 'Tussenvoegsel'=>$this->tussenvoegsel, 'Email'=>$this->email, 'Telefoonnummer'=>$this->telefoonnummer,
    'Land'=>$this->land, 'Woonplaats'=>$this->woonplaats,'Postcode'=>$this->postcode,
    'Straatnaam'=>$this->straatnaam, 'Huisnummer'=>$this->huisnummer];
    return $Userinfo;
  }

  public function ChangePass($database, $User){
    $db = $database->connection();
    if(isset($_POST['submit'])) {
      $stmt = $db->query("SELECT `Wachtwoord` FROM `klant` WHERE `KlantID`='".$User->GetUserInfo()['KlantID']."'");
      $resultinfo = $stmt->fetch(PDO::FETCH_ASSOC);

      $passOud = $_POST['passOud'];
      $passNieuw_hashed = password_hash($_POST['passNieuw'], PASSWORD_DEFAULT);

      if(password_verify($passOud, $resultinfo['Wachtwoord'])){
          if($_POST['passNieuw'] === $_POST['passHerhaal']){
              $stmt = $db->prepare("UPDATE `klant` SET `Wachtwoord` = '".$passNieuw_hashed."' WHERE `KlantID` = '".$User->GetUserInfo()['KlantID']."'");
              $stmt->execute();
              header("Location: profiel.php");
          }else{
              echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Fout! Herhaal het nieuwe wachtwoord</div>";
          }
      }else{
          echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;'>Fout! Je oude wachtwoord is verkeerd</div>";
      }
    }
  }
}
?>
