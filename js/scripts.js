document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_cards.php')
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById('card-container');
            data.forEach(card => {
                const cardElement = document.createElement('div');
                cardElement.className = 'col-md-4 mb-4'; // ajout d'un margin-bottom pour espacer les cartes
                cardElement.innerHTML = `
                    <div class="card h-100">
                        <img src="${card.image_path}" class="card-img-top img-fluid" alt="${card.name}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">${card.name}</h5>
                            <p class="card-text">Type: ${card.card_type_id}</p>
                            <p class="card-text">Faction: ${card.main_faction_id}</p>
                            <p class="card-text">Rarity: ${card.rarity_id}</p>
                        </div>
                    </div>
                `;
                cardContainer.appendChild(cardElement);
            });
        });
});
