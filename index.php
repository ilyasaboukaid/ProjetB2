<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dreamborn Ink - Disney Lorcana Deck Builder</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #0f0f25;
      color: #fff;
    }

    .header {
      padding: 50px 0;
      text-align: center;
    }

    .header h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .header p {
      font-size: 1.2rem;
    }

    .btn-primary {
      background-color: #6c63ff;
      border-color: #6c63ff;
    }

    .navbar {
      padding: 1rem;
    }

    .navbar-nav .nav-link {
      color: #fff !important;
    }
  </style>
</head>

<body>


  <?php
  require_once ('include/navbar.php');

  ?>

  <!-- Header Section -->
  <div class="header">
    <h1>A deck building website for<br>Disney Lorcana.</h1>
    <p>Browse thousands of popular decks, or create your own!</p>
    <a href="#" class="btn btn-primary btn-lg mr-3">Create a deck</a>
    <a href="#" class="btn btn-outline-light btn-lg">Browse decks</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>