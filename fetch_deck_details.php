<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sw_cards";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(array('error' => 'Connection failed: ' . $conn->connect_error));
    exit();
}

$deck_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($deck_id == 0) {
    echo json_encode(array('error' => 'Invalid deck ID'));
    exit();
}

// Fetch deck details
$deck_query = '
SELECT 
    deck.id, 
    deck.name, 
    deck.hero_id, 
    card.name AS hero_name
FROM deck
LEFT JOIN card ON deck.hero_id = card.id
WHERE deck.id = ?
';

$deck_stmt = $conn->prepare($deck_query);
if (!$deck_stmt) {
    echo json_encode(array('error' => 'Prepare failed: ' . $conn->error));
    exit();
}
$deck_stmt->bind_param('i', $deck_id);
$deck_stmt->execute();
$deck_result = $deck_stmt->get_result();
$deck = $deck_result->fetch_assoc();

if (!$deck) {
    echo json_encode(array('error' => 'Deck not found'));
    exit();
}

// Fetch cards in the deck
$cards_query = '
SELECT 
    card.id, 
    card.name, 
    card.image_path, 
    card_type.name AS card_type_name, 
    faction.name AS main_faction_name, 
    rarity.name AS rarity_name
FROM card
LEFT JOIN card_type ON card.card_type_id = card_type.id
LEFT JOIN faction ON card.main_faction_id = faction.id
LEFT JOIN rarity ON card.rarity_id = rarity.id
LEFT JOIN deck_card ON card.id = deck_card.card_id
WHERE deck_card.deck_id = ?
';

$cards_stmt = $conn->prepare($cards_query);
if (!$cards_stmt) {
    echo json_encode(array('error' => 'Prepare failed: ' . $conn->error));
    exit();
}
$cards_stmt->bind_param('i', $deck_id);
$cards_stmt->execute();
$cards_result = $cards_stmt->get_result();
$cards = array();

while ($row = $cards_result->fetch_assoc()) {
    $cards[] = $row;
}

$deck['cards'] = $cards;

$conn->close();

echo json_encode($deck);
?>
