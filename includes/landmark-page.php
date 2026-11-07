<?php
require __DIR__ . '/bootstrap.php';
require_city();
$city = current_city() ?? $place['city'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($place['title']) ?> | Hextech Spark</title>
  <link rel="stylesheet" href="site.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="ambient.css">
</head>
<body data-city="<?= h($city) ?>" data-landmark-page="<?= h(strtolower(str_replace(' ', '-', $place['title']))) ?>">
<?php require __DIR__ . '/header.php'; ?>
<main class="page-main">
  <section class="landmark-hero<?= $place['city'] === 'zaun' ? ' zaun' : '' ?><?= isset($place['hero_image']) ? ' landmark-hero-custom' : '' ?>"<?= isset($place['hero_image']) ? ' style="--landmark-hero-image: url(\'' . h($place['hero_image']) . '\')"' : '' ?> aria-labelledby="landmark-title">
    <p class="eyebrow"><?= h($place['eyebrow']) ?></p>
    <h1 class="h1" id="landmark-title"><?= $place['heading'] ?></h1>
    <p><?= h($place['lead']) ?></p>
  </section>

  <article class="sec academy-article" aria-labelledby="landmark-story-title">
    <header class="sec-head">
      <span class="eyebrow"><?= h($place['article_eyebrow']) ?></span>
      <h2 class="h2" id="landmark-story-title"><?= h($place['article_title']) ?></h2>
      <p class="academy-article-lead"><?= h($place['article_lead']) ?></p>
    </header>
    <div class="academy-article-body">
      <?php foreach ($place['sections'] as $section): ?>
        <section>
          <h3><?= h($section['heading']) ?></h3>
          <?php foreach ($section['paragraphs'] as $paragraph): ?>
            <p><?= h($paragraph) ?></p>
          <?php endforeach; ?>
        </section>
      <?php endforeach; ?>
      <blockquote>
        <p><?= h($place['quote']) ?></p>
        <cite><?= h($place['quote_by']) ?></cite>
      </blockquote>
    </div>
  </article>

  <section class="sec" aria-labelledby="landmark-spotlights-title">
    <div class="sec-head">
      <span class="eyebrow">Character spotlight</span>
      <h2 class="h2" id="landmark-spotlights-title"><?= h($place['spotlight_title']) ?></h2>
      <p><?= h($place['spotlight_lead']) ?></p>
    </div>
    <div class="character-grid">
      <?php foreach ($place['characters'] as $character): ?>
        <article class="character-card" data-character="<?= h($character['id']) ?>">
          <div class="character-portrait"><img src="<?= h($character['image']) ?>" alt="<?= h($character['name']) ?>"></div>
          <div class="character-copy">
            <p class="eyebrow"><?= h($character['eyebrow']) ?></p>
            <h4><?= h($character['name']) ?></h4>
            <p><?= h($character['description']) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <nav class="landmark-actions" aria-label="Landmark page actions">
    <a class="btn alt" href="landing.php#story">Return to the city map <span aria-hidden="true">&#9654;</span></a>
    <a class="btn" href="dashboard.php">Open dashboard <span aria-hidden="true">&#9654;</span></a>
  </nav>
</main>
<?php require __DIR__ . '/footer.php'; ?>
</body>
</html>
