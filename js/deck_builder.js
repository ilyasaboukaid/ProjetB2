document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_cards.php')
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById('card-container');
            const heroSelect = document.getElementById('hero-select');
            data.forEach(card => {
                const cardElement = document.createElement('div');
                cardElement.className = 'col-md-4';
                cardElement.innerHTML = `
                    <div class="card">
                        <img src="${card.image_path}" class="card-img-top" alt="${card.name}">
                        <div class="card-body">
                            <h5 class="card-title">${card.name}</h5>
                            <p class="card-text">Type: ${card.card_type_id}</p>
                            <p class="card-text">Faction: ${card.main_faction_id}</p>
                            <p class="card-text">Rarity: ${card.rarity_id}</p>
                            <button class="btn btn-primary add-to-deck" data-card-id="${card.id}">Add to Deck</button>
                        </div>
                    </div>
                `;
                cardContainer.appendChild(cardElement);

                if (card.card_type_id === '5') {
                    const option = document.createElement('option');
                    option.value = card.id;
                    option.innerText = card.name;
                    heroSelect.appendChild(option);
                }
            });

            document.querySelectorAll('.add-to-deck').forEach(button => {
                button.addEventListener('click', addToDeck);
            });
        });

    const deck = [];

    function addToDeck(event) {
        const cardId = event.target.getAttribute('data-card-id');
        const cardName = event.target.closest('.card-body').querySelector('.card-title').innerText;

        deck.push(cardId);

        const deckElement = document.createElement('li');
        deckElement.className = 'list-group-item';
        deckElement.innerText = cardName;
        deckElement.innerHTML += '<button class="btn btn-danger btn-sm ml-auto remove-from-deck">Remove</button>';
        document.getElementById('deck').appendChild(deckElement);

        deckElement.querySelector('.remove-from-deck').addEventListener('click', function() {
            removeFromDeck(deckElement, cardId);
        });
    }

    function removeFromDeck(element, cardId) {
        const index = deck.indexOf(cardId);
        if (index > -1) {
            deck.splice(index, 1);
        }
        element.remove();
    }

    document.getElementById('save-deck').addEventListener('click', function() {
        const heroId = document.getElementById('hero-select').value;
        if (!heroId) {
            alert('Please select a hero before saving the deck.');
            return;
        }

        const deckName = prompt("Enter deck name:");
        if (deckName) {
            fetch('save_deck.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name: deckName, hero_id: heroId, cards: deck })
            })
            .then(response => response.text())
            .then(data => {
                alert("Deck saved successfully!");
                document.getElementById('deck').innerHTML = "";
                deck.length = 0; // Clear the deck array
                document.getElementById('hero-select').selectedIndex = 0; // Reset hero selection
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Failed to save deck.");
            });
        }
    });
});
