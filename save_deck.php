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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deck = json_decode(file_get_contents('php://input'), true);
    $deck_name = $deck['name'];
    $hero_id = $deck['hero_id'];
    $cards = $deck['cards'];

    $stmt = $conn->prepare("INSERT INTO deck (name, hero_id) VALUES (?, ?)");
    $stmt->bind_param("si", $deck_name, $hero_id);
    $stmt->execute();
    $deck_id = $stmt->insert_id;
    $stmt->close();

    foreach ($cards as $card_id) {
        $stmt = $conn->prepare("INSERT INTO deck_card (deck_id, card_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $deck_id, $card_id);
        $stmt->execute();
    }
    $stmt->close();
}

$conn->close();
?>
