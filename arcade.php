<?php
require __DIR__ . '/includes/bootstrap.php';
require_city();
$city = current_city();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Arcade | Hextech Spark</title>
  <link rel="stylesheet" href="site.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="ambient.css">
</head>
<body data-city="<?= h($city) ?>">
<?php require __DIR__ . '/includes/header.php'; ?>
<main class="page-main">
  <section class="page-heading" aria-labelledby="arcade-title">
    <p class="eyebrow">The arcade</p>
    <h1 class="h1" id="arcade-title">Four games, no lives to waste</h1>
    <p>Test your reflexes, memory, and timing across four quick games. Your best scores stay on this device.</p>
  </section>
  <section class="arcade" aria-label="Arcade games">
    <div class="tabs" role="group" aria-label="Choose a game">
      <button class="tab" type="button" data-g="fuse" aria-pressed="true">Fuse Frenzy</button>
      <button class="tab" type="button" data-g="guard" aria-pressed="false">Perfect Guard</button>
      <button class="tab" type="button" data-g="echo" aria-pressed="false">Hex Echo</button>
      <button class="tab" type="button" data-g="rush" aria-pressed="false">Gold Rush</button>
    </div>
    <div class="gbox">
      <div class="hud">
        <div>
          <h3 id="gTitle">Fuse Frenzy</h3>
          <p id="gRules">Tap each bomb before its ring shrinks away. Three misses and the lights go out. Chain pops for a bigger multiplier.</p>
        </div>
        <div class="stat"><span id="gStatLabel">Time</span><b id="gTime">20</b></div>
        <div class="stat"><span>Score</span><b id="gScore">0</b></div>
        <div class="stat"><span>Best</span><b id="gBest">0</b></div>
      </div>
      <div class="arena" id="arena" tabindex="-1"></div>
      <div class="grow">
        <button class="btn" type="button" id="gStart">Start</button>
        <p class="ginfo" id="gInfo" aria-live="polite"></p>
      </div>
    </div>
  </section>
  <div class="dashboard-shortcuts">
    <a class="btn alt" href="landing.php#story">Return to the city map <span aria-hidden="true">&#9654;</span></a>
    <a class="btn" href="dashboard.php">Open dashboard <span aria-hidden="true">&#9654;</span></a>
  </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="arcade.js"></script>
</body>
</html>
