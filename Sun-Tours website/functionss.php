<?php
include_once('db.php');

function GetScore($BestemmingID,$conn){
  $stmt = $conn->prepare("SELECT `Score` FROM `Review` WHERE `BestemmingID` = '".$BestemmingID."'");
  $stmt->execute();

  $results = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      array_push($results, $row['Score']);
  }

  if(count($results)) {
      $score = array_sum($results)/count($results);

  }
  if(isset($score)){
    return $score;
  }
}

function CheckLimit($BestemmingPlaats,$conn){
  $stmt = $conn->prepare("SELECT COUNT(*) FROM `Boeking` WHERE `Plaats` = '".$BestemmingPlaats."'");
  $stmt->execute();
  $countlimit = $stmt->fetchColumn();

  return $countlimit;
}

function CheckDuplicateEmail($email, $db){
   $sql = "SELECT COUNT(*) FROM `Klant` WHERE `Email` ='".$email."'";
   $result = $db->query($sql);
   $count = $result->fetchColumn();

   if($count != 0){
      return False;
   }else{
      return True;
   }
}

 ?>
