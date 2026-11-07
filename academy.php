<?php
require __DIR__ . '/includes/bootstrap.php';
require_city();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Academy | Hextech Spark</title>
  <link rel="stylesheet" href="site.css">
  <link rel="stylesheet" href="pages.css">
  <link rel="stylesheet" href="ambient.css">
</head>
<body data-city="<?= h(current_city() ?? 'piltover') ?>">
<?php require __DIR__ . '/includes/header.php'; ?>
<main class="page-main">
  <section class="landmark-hero landmark-hero-custom" style="--landmark-hero-image: url('images/theacademy.jpg')" aria-labelledby="academy-title">
    <p class="eyebrow">Topside · Piltover landmark</p>
    <h1 class="h1" id="academy-title">The <span class="hl"><i>Academy</i></span></h1>
    <p>Piltover's finest minds gather here to study, debate, and push the limits of hextech.</p>
  </section>

  <article class="sec academy-article" aria-labelledby="academy-story-title">
    <header class="sec-head">
      <span class="eyebrow">A closer look · Piltover</span>
      <h2 class="h2" id="academy-story-title">Where progress is put to the test</h2>
      <p class="academy-article-lead">The Academy is more than a place to study. It is where Piltover's faith in invention meets the difficult question of what progress should serve.</p>
    </header>

    <div class="academy-article-body">
      <section>
        <h3>Learning at the heart of the city</h3>
        <p>Piltover presents itself as a city built on knowledge, engineering, and discovery. Its Academy gathers scholars and ambitious young minds who want to understand how the world works—and how it might be changed.</p>
        <p>That promise gives the institution a special place in the city. Ideas developed in its halls do not stay theoretical for long: they can shape public life, create new opportunities, and change who holds influence.</p>
      </section>

      <section>
        <h3>When hextech changes everything</h3>
        <p>The possibility of hextech turns study into a high-stakes pursuit. Jayce and Viktor share a belief that magic and technology might be brought together, but a breakthrough also asks whether an invention is ready to leave the laboratory—and who will bear the consequences if it goes wrong.</p>
        <p>Their work captures the Academy's central tension: curiosity can open extraordinary doors, while responsible research requires patience, scrutiny, and a clear sense of purpose.</p>
      </section>

      <section>
        <h3>Different generations, different risks</h3>
        <p>Professor Heimerdinger's long experience gives him a different perspective from researchers eager to move quickly. His caution is not simply a rejection of new ideas; it reflects an awareness that powerful discoveries can have effects their creators did not intend.</p>
        <p>That disagreement makes the Academy a fitting symbol of Piltover itself. The city wants to lead the future, but must decide whether speed, ambition, and responsibility can advance together.</p>
      </section>

      <blockquote>
        <p>It is not enough to simply create. We must answer to what we've wrought</p>
        <cite>- Viktor</cite>
      </blockquote>
    </div>
    <p class="academy-source">Further reading: <a href="https://arcane.fandom.com/wiki/The_University_of_Piltover" target="_blank" rel="noopener noreferrer">The University of Piltover</a></p>
  </article>

  <section class="sec" aria-labelledby="inventors-title">
    <div class="sec-head">
      <span class="eyebrow">Character spotlight</span>
      <h2 class="h2" id="inventors-title">Meet the inventors</h2>
      <p>Three brilliant minds whose work shapes Piltover's future—and raises difficult questions about the cost of progress.</p>
    </div>
    <div class="character-grid">
      <article class="character-card" data-character="jayce">
        <div class="character-portrait"><img src="images/jayce.webp" alt="Jayce"></div>
        <div class="character-copy">
          <p class="eyebrow">The inventor</p>
          <h4>Jayce</h4>
          <p>An ambitious innovator whose discoveries bring influence and responsibility in equal measure.</p>
        </div>
      </article>
      <article class="character-card" data-character="viktor">
        <div class="character-portrait"><img src="images/ViktorCommune.webp" alt="Viktor"></div>
        <div class="character-copy">
          <p class="eyebrow">The visionary</p>
          <h4>Viktor</h4>
          <p>Born in Zaun and driven to overcome its limits, Viktor pursues progress with extraordinary resolve.</p>
        </div>
      </article>
      <article class="character-card" data-character="heimerdinger">
        <div class="character-portrait"><img src="images/heimer.png" alt="Heimerdinger"></div>
        <div class="character-copy">
          <p class="eyebrow">The professor</p>
          <h4>Heimerdinger</h4>
          <p>A celebrated scholar whose long experience makes him cautious about the risks hidden inside new discoveries.</p>
        </div>
      </article>
    </div>
  </section>

  <nav class="landmark-actions" aria-label="Academy page actions">
    <a class="btn alt" href="landing.php#story">Return to the city map <span aria-hidden="true">&#9654;</span></a>
    <a class="btn" href="dashboard.php">Open dashboard <span aria-hidden="true">&#9654;</span></a>
  </nav>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
