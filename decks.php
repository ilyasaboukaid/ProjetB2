<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
  require_once ('include/navbar.php');
  ?>
    <div class="container mt-5">
        <h1>Decks</h1>
        <div id="deck-container" class="row">
            <!-- Decks will be loaded here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('fetch_decks.php')
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

                    const deckContainer = document.getElementById('deck-container');
                    if (data.length === 0) {
                        deckContainer.innerHTML = '<p>No decks found.</p>';
                    } else {
                        data.forEach(deck => {
                            const deckElement = document.createElement('div');
                            deckElement.className = 'col-md-4';
                            deckElement.innerHTML = `
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">${deck.name}</h5>
                                        <p class="card-text">Hero: ${deck.hero_name}</p>
                                        <a href="deck_details.php?id=${deck.id}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            `;
                            deckContainer.appendChild(deckElement);
                        });
                    }
                })
                .catch(error => {
                    const deckContainer = document.getElementById('deck-container');
                    deckContainer.innerHTML = `<p>Error loading decks. ${error.message}</p>`;
                });
        });
    </script>
</body>
</html>
