<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sw_cards";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Connection failed: ' . $conn->connect_error)));
}

// Modified SQL query to get the decks and their cards without using a non-existent table
$query = '
SELECT 
    deck.id, 
    deck.name, 
    deck.hero_id, 
    card.name AS hero_name
FROM deck
LEFT JOIN card ON deck.hero_id = card.id
';

$result = $conn->query($query);

if (!$result) {
    die(json_encode(array('error' => 'Query failed: ' . $conn->error)));
}

$decks = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $decks[] = $row;
    }
} else {
    echo json_encode(array('message' => 'No decks found'));
    exit();
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($decks);
?>
