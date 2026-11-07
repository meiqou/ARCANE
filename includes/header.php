<?php
$city = current_city();
$isLanding = basename($_SERVER['SCRIPT_NAME'] ?? '') === 'landing.php';
?>
<header class="top">
  <a class="mark" href="<?= $city ? 'landing.php' : 'login.php' ?>">ARCANE</a>
  <div class="sub">A fan-made interactive website</div>
  <nav class="site-nav" aria-label="Main navigation">
    <a href="index.php">Home</a>
    <?php if ($city !== null): ?>
      <a href="landing.php#story">The city</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="landing.php#characters">Characters</a>
      <a href="arcade.php">Arcade</a>
      <?php if ($isLanding): ?>
        <button class="city-switch" type="button" aria-haspopup="dialog" aria-controls="city-dialog">City: <?= h($city === 'piltover' ? 'Piltover' : 'Zaun') ?></button>
      <?php else: ?>
        <a href="city.php">Change city</a>
      <?php endif; ?>
      <a href="logout.php">Log out</a>
    <?php else: ?>
      <a href="login.php?mode=login">Log in</a>
      <a href="login.php?mode=register">Register</a>
    <?php endif; ?>
  </nav>
</header>
