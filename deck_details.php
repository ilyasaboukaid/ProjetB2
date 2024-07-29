<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deck Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
  require_once ('include/navbar.php');
  ?>
    <div class="container mt-5">
        <h1>Deck Details</h1>
        <div id="deck-details" class="row">
            <!-- Deck details will be loaded here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const deckId = params.get('id');
            
            if (!deckId) {
                document.getElementById('deck-details').innerHTML = '<p>Deck ID not provided.</p>';
                return;
            }

            fetch(`fetch_deck_details.php?id=${deckId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }

                    const deckDetails = document.getElementById('deck-details');
                    const heroSection = `
                        <div class="col-12 mb-4">
                            <h2>${data.name}</h2>
                            <p><strong>Hero:</strong> ${data.hero_name}</p>
                        </div>
                    `;
                    deckDetails.innerHTML = heroSection;

                    data.cards.forEach(card => {
                        const cardElement = document.createElement('div');
                        cardElement.className = 'col-md-4';
                        cardElement.innerHTML = `
                            <div class="card mb-4">
                                <img src="${card.image_path}" class="card-img-top" alt="${card.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${card.name}</h5>
                                    <p class="card-text">Type: ${card.card_type_name}</p>
                                    <p class="card-text">Faction: ${card.main_faction_name}</p>
                                    <p class="card-text">Rarity: ${card.rarity_name}</p>
                                </div>
                            </div>
                        `;
                        deckDetails.appendChild(cardElement);
                    });
                })
                .catch(error => {
                    const deckDetails = document.getElementById('deck-details');
                    deckDetails.innerHTML = `<p>Error loading deck details. ${error.message}</p>`;
                });
        });
    </script>
</body>
</html>
