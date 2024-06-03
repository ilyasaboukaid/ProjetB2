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

// SQL query with LEFT JOIN to get the card details along with the names of the type, faction, and rarity
$sql = "
SELECT 
    card.id, 
    card.name, 
    card.image_path, 
    card_type.name AS card_type_name, 
    faction.name AS main_faction_name, 
    rarity.name AS rarity_name
FROM card
JOIN card_type ON card.card_type_id = card_type.id
JOIN faction ON card.main_faction_id = faction.id
JOIN rarity ON card.rarity_id = rarity.id
";

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
