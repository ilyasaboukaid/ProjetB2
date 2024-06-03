<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sw_cards";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM card";
$result = $conn->query($sql);

$cards = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cards[] = $row;
    }
} 
$conn->close();

header('Content-Type: application/json');
echo json_encode($cards);
?>
