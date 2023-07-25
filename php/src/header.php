<?php
require_once("includes/mindset.php");

?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Center Div Element with Bootstrap</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarExample01"
        aria-controls="navbarExample01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link feature" id="feature" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link pricing" id="pricing" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link about" id="about" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

  <!-- Jumbotron -->
  <div class="p-5 text-center bg-light">
    <h1 class="mb-3">Dialectica</h1>
    <h4 class="mb-3">Diskussionsplattform für jegliche Fragen!</h4>
    <a class="btn btn-primary" href="https://github.com/desertrockxxx/" role="button">Auf zum Git! Und noch viel viel weiter!</a>
  </div>
  <!-- Jumbotron -->
</header>
