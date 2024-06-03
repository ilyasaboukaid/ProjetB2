<?php
// Fetch card data using cURL
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://omgvamp-hearthstone-v1.p.rapidapi.com/cards",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: omgvamp-hearthstone-v1.p.rapidapi.com",
        "X-RapidAPI-Key: SIGN-UP-FOR-KEY"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $cards = json_decode($response, true);
    $imageUrls = [];
    
    foreach ($cards as $card) {
        if (isset($card['img'])) {
            $imageUrls[] = $card['img'];
        }
    }
    
    // Generate HTML for the gallery
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Disney Lorcana Card Gallery</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <style>
        body {
          background-color: #0f0f25;
          color: #fff;
        }
        .gallery {
          padding: 20px;
        }
        .card {
          margin-bottom: 20px;
        }
      </style>
    </head>
    <body>
      <!-- Navigation Bar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">dreamborn.ink <span class="text-warning">✨</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Deck Builder</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cards</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Collection</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Decks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Trade</a>
            </li>
            <li class="nav-item">
              <button class="btn btn-primary">Sign in</button>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Gallery Section -->
      <div class="container gallery">
        <div class="row">';
    
    foreach ($imageUrls as $url) {
        echo '
          <div class="col-md-3 col-sm-6">
            <div class="card">
              <img src="' . $url . '" class="card-img-top" alt="Card">
            </div>
          </div>';
    }
    
    echo '
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>';
}
?>
