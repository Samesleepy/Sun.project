<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sunproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT KlantID, Voornaam, Achternaam FROM klant";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["KlantID"]. " - Name: ". $row["Voornaam"]. " " . $row["Achternaam"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boeken</title>
    <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 30%;
  margin-left: 20px;
  margin-top: 20px;
  float: left;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
  background-color: lightblue;
}
img {
    float: left;
    width:  100px;
    height: 200px;
    object-fit: cover;
}
#filter {
    height: 100px;
    width: 20%;
    border: 1px solid black;
    float: left;
}
#bestemmingen {
    position: relative;
    border: 1px solid black;
    float: left;
    width: 79.7%;
    height: auto;
}
</style>
</head>
<body>
    <div id="filter"></div>
    <div id="bestemmingen">
        <a href="">
            <div class="card">
                <img src="Mallorca.jpg" alt="Bestemming" style="width:100%">
                <div class="container">
                    <h4><b>Mallorca</b></h4> 
                    <p>Prijs</p> 
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <img src="Turkije.jpg" alt="Bestemming" style="width:100%">
                <div class="container">
                    <h4><b>Turkije</b></h4> 
                    <p>Prijs</p> 
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <img src="Turkije.jpg" alt="Bestemming" style="width:100%">
                <div class="container">
                    <h4><b>Turkije</b></h4> 
                    <p>Prijs</p> 
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <img src="Turkije.jpg" alt="Bestemming" style="width:100%">
                <div class="container">
                    <h4><b>Turkije</b></h4> 
                    <p>Prijs</p> 
                </div>
            </div>
        </a>
    </div>
</body>
</html>