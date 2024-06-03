<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deck Builder</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
  require_once ('include/navbar.php');
  ?>
    <div class="container">
        <h1 class="my-4 text-center">Deck Builder</h1>
        <div class="row">
            <div class="col-md-8">
                <h2 class="text-center">Available Cards</h2>
                <div id="card-container" class="row"></div>
            </div>
            <div class="col-md-4">
                <h2 class="text-center">Your Deck</h2>
                <div class="form-group">
                    <label for="hero-select">Select a Hero:</label>
                    <select id="hero-select" class="form-control">
                        <option value="">Choose a hero</option>
                    </select>
                </div>
                <ul id="deck" class="list-group"></ul>
                <button id="save-deck" class="btn btn-warning btn-block mt-3">Save Deck</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/deck_builder.js"></script>
</body>
</html>
