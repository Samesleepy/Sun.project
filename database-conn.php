<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function Debug($v){
  echo "<pre>";
  print_r($v);
  die();
}

$host =
$username =
$password =
$databaseName =

//connect to database
$conn = mysqli_connect($host, $username, $password, $databaseName);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected Successfully. </br>";

//
// echo "<table border='1'>";
//    while ($row = mysqli_fetch_assoc($result)) {
//       echo '<tr>';
//       foreach ($row as $key => $value)
//       {
//         echo "<td>".$value."</td>";
//       }
//         echo "</tr></br>";
//     }
//     "</table>"
//



//  mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sun-Tours</title>
  </head>
  <body>
  </body>
</html>
