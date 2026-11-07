<?php
require __DIR__ . '/includes/bootstrap.php';
require_city();
$city = current_city();
$cityName = $city === 'piltover' ? 'Piltover' : 'Zaun';
$cityCopy = $city === 'piltover'
    ? 'Topside · City of Progress. Gold, blue, invention, and ambition.'
    : 'Undercity · City of ingenuity. Neon green, deep violet, and resilience.';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Hextech Spark</title>
  <link rel="stylesheet" href="site.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="ambient.css">
  <link rel="stylesheet" href="city-experience.css">
</head>
<body class="dashboard-page" data-city="<?= h($city) ?>">
<?php require __DIR__ . '/includes/header.php'; ?>
<main class="page-main">
  <section class="dashboard dashboard-command-center" aria-labelledby="dashboard-title">
    <div class="sec-head">
      <span class="eyebrow">Step 3 of 3 · Field station</span>
      <h1 class="h1" id="dashboard-title">Your <span class="hl"><i>dashboard</i></span></h1>
      <p>A quick route back into the places, people, and games that make up your Arcane experience.</p>
    </div>
    <div class="dashboard-grid">
      <article class="dashboard-card" data-dashboard-card>
        <span class="dashboard-card-index" aria-hidden="true">01</span>
        <p class="eyebrow">Current allegiance</p>
        <h3><?= h($cityName) ?></h3>
        <p><?= h($cityCopy) ?></p>
        <a class="btn city-dashboard-switch" href="city.php">Change city-state</a>
      </article>
      <article class="dashboard-card" data-dashboard-card>
        <span class="dashboard-card-index" aria-hidden="true">02</span>
        <p class="eyebrow">Explore</p>
        <h3>Two cities, many stories</h3>
        <p>Open the interactive map and uncover landmark lore from Topside to the Undercity.</p>
        <a class="btn alt" href="landing.php#story">Open the city map <span aria-hidden="true">&#9654;</span></a>
      </article>
      <article class="dashboard-card" data-dashboard-card>
        <span class="dashboard-card-index" aria-hidden="true">03</span>
        <p class="eyebrow">Take a break</p>
        <h3>Four quick games</h3>
        <p>Test your timing and reflexes in the Hextech Spark arcade.</p>
        <a class="btn" href="arcade.php">Enter the arcade <span aria-hidden="true">&#9654;</span></a>
      </article>
    </div>
    <div class="dashboard-shortcuts">
      <a class="btn alt" href="landing.php">Return to landing page <span aria-hidden="true">&#9654;</span></a>
    </div>
  </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="city-experience.js"></script>
</body>
</html>
