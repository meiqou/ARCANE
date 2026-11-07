<?php
require __DIR__ . '/includes/bootstrap.php';
require_city();
?>
<!doctype html><html><head><meta name="csrf-token" content="<?= h(csrf_token()) ?>"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><link rel="stylesheet" href="ambient.css"><style>[hidden]:not([hidden=until-found i]){display:none!important}</style></head><body data-city="<?= h(current_city() ?? 'piltover') ?>" data-flow-step="landing">
<title>ARCANE</title>
<meta name="claude:viewport-fit-sides" content="cover">
<style>
/* Original fan-made editorial landing page with an immersive hero, story features, character spotlights, and a compact arcade. */
@font-face {
  font-family: 'Arcane Nine';
  src: url("Arcane Nine.otf") format("opentype");
  font-display: swap;
}
:root {
  color-scheme: dark;
  --ink: #07060f;
  --panel: #0d0a1c;
  --card: #151030;
  --violet: #2b1763;
  --pink: #ff2f92;
  --pink-soft: #ff6ab8;
  --blue: #5b86ff;
  --lav: #b9a8ff;
  --bone: #f4f0ff;
  --mute: #9d94c4;
  --line: rgba(185, 168, 255, 0.16);
  --font-display: 'Arcane Nine', Georgia, serif;
  --font-mark: 'Arcane Nine', Georgia, serif;
  --font-logo: 'Arcane Nine', Georgia, serif;
}
body[data-city="piltover"] {
  --pink: #c69b42;
  --pink-soft: #e8ca7a;
  --blue: #477eb8;
  --lav: #b7c8dd;
  --line: rgba(192, 164, 105, 0.28);
  --violet: #18304a;
  --city-wash: rgba(60, 120, 180, 0.12);
}
body[data-city="zaun"] {
  --pink: #a7ef45;
  --pink-soft: #c4ff68;
  --blue: #a34ce0;
  --lav: #d3a3f4;
  --line: rgba(167, 239, 69, 0.24);
  --violet: #251334;
  --city-wash: rgba(127, 46, 172, 0.15);
}
* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  margin: 0;
  background: #07060f;
  color: var(--bone);
  font-family: var(--font-display);
  font-size: 16px;
  line-height: 1.55;
  padding: 0;
  overflow-x: hidden;
  position: relative;
  isolation: isolate;
}
a { color: inherit; }
button { font-family: inherit; }
svg text { font-family: var(--font-display); }
:focus-visible { outline: 2px solid var(--pink-soft); outline-offset: 3px; }

#fx { position: fixed; inset: 0; width: 100%; height: 100%; z-index: 2; pointer-events: none; }

/* masthead */
.top { position: relative; z-index: 3; min-height: 88px; display: grid; grid-template-columns: auto minmax(0, 1fr) auto; align-items: center; gap: 24px; padding: 14px 24px; background: rgba(7, 6, 15, 0.94); border-bottom: 1px solid var(--line); }
.mark { font-family: var(--font-logo); font-size: clamp(2rem, 4vw, 3.2rem); line-height: 1; letter-spacing: 0.16em; padding-left: 0.16em; color: #d4af37; text-decoration: none; }
.sub { font-size: 0.62rem; letter-spacing: 0.24em; text-transform: uppercase; color: var(--mute); }
.site-nav { display: flex; width: clamp(420px, 48vw, 600px); align-items: center; justify-content: space-between; gap: clamp(12px, 1.5vw, 24px); }
.site-nav a { color: var(--bone); font-size: 0.72rem; letter-spacing: 0.18em; text-decoration: none; text-transform: uppercase; }
.site-nav a:hover { color: var(--pink-soft); }
.city-switch { padding: 8px 11px; border: 1px solid var(--line); background: rgba(7, 6, 15, 0.45); color: var(--pink-soft); font: inherit; font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase; cursor: pointer; white-space: nowrap; }
.city-switch:hover { border-color: var(--pink-soft); }

/* immersive opening */
.hero { position: relative; min-height: calc(100svh - 88px); display: grid; align-items: end; overflow: hidden; background: #07060f; }
.hero::before { content: ""; position: absolute; inset: 0; z-index: 1; pointer-events: none; background: linear-gradient(90deg, rgba(7, 6, 15, 0.56), rgba(7, 6, 15, 0.06) 80%), linear-gradient(0deg, rgba(7, 6, 15, 0.52), transparent 70%), linear-gradient(110deg, var(--city-wash, transparent), transparent 68%); }
.hero-video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center 42%; }
.hero-video-toggle { position: absolute; z-index: 3; top: 24px; right: clamp(18px, 4vw, 48px); display: inline-flex; align-items: center; gap: 9px; padding: 10px 14px; border: 1px solid rgba(244, 240, 255, 0.45); background: rgba(7, 6, 15, 0.72); color: var(--bone); font: inherit; font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; cursor: pointer; backdrop-filter: blur(8px); }
.hero-video-toggle:hover { border-color: var(--pink-soft); color: var(--pink-soft); }
.hero-video-toggle:focus-visible { outline: 2px solid var(--pink-soft); outline-offset: 3px; }
.hero-video-toggle .sound-icon { font-size: 1rem; line-height: 1; }
.collage { position: relative; z-index: 2; width: 100%; min-width: 0; }
.c-head { width: min(900px, 72vw); min-width: 0; min-height: calc(100svh - 88px); margin: 0 auto 0 0; padding: clamp(90px, 14vh, 160px) 28px 32px; display: flex; flex-direction: column; align-items: flex-start; justify-content: center; gap: 24px; text-align: left; transform: translateY(-68px); }
.c-head .eyebrow { margin: 0; }
.hero-media-row { width: calc(100vw - 56px); min-width: 0; margin-top: auto; padding-top: 64px; transform: translateY(-24px); }
.hero-media-heading { margin: 0 0 12px; color: rgba(244, 240, 255, 0.78); font-size: 0.68rem; letter-spacing: 0.24em; text-transform: uppercase; }
.hero-media-list { display: grid; width: 100%; min-width: 0; grid-auto-columns: clamp(260px, 20vw, 380px); grid-auto-flow: column; gap: 14px; overflow-x: auto; overscroll-behavior-x: contain; padding: 2px 2px 12px; cursor: grab; user-select: none; scrollbar-width: none; }
.hero-media-list::-webkit-scrollbar { display: none; }
.hero-media-list.is-dragging { cursor: grabbing; }
.hero-media-list.is-dragging .hero-media-card { pointer-events: none; }
.hero-media-card { position: relative; display: block; aspect-ratio: 16 / 9; min-width: 0; overflow: hidden; border: 1px solid rgba(185, 168, 255, 0.3); background: #100b21; color: inherit; text-decoration: none; box-shadow: 0 8px 26px rgba(0, 0, 0, 0.28); transition: transform .28s ease, border-color .28s ease, box-shadow .28s ease; }
.hero-media-card img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease, filter .4s ease; }
.hero-media-card::after { content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(7, 6, 15, 0.08) 10%, rgba(7, 6, 15, 0.2) 42%, rgba(7, 6, 15, 0.92) 100%); }
.hero-media-card:hover img, .hero-media-card:focus-visible img { transform: scale(1.07); filter: brightness(1.16); }
.hero-media-card:focus-visible { outline: 2px solid var(--pink-soft); outline-offset: 3px; }
.hero-media-play { position: absolute; z-index: 1; top: 50%; left: 50%; display: grid; place-items: center; width: 46px; height: 46px; padding-left: 3px; border: 1px solid rgba(255, 255, 255, 0.82); border-radius: 50%; background: rgba(7, 6, 15, 0.55); color: #fff; font-size: 1rem; transform: translate(-50%, -50%); transition: background .25s ease, border-color .25s ease, box-shadow .25s ease, scale .25s ease; }
.hero-media-card:hover .hero-media-play, .hero-media-card:focus-visible .hero-media-play { border-color: #fff; background: var(--pink); box-shadow: 0 0 22px rgba(255, 47, 146, 0.65); scale: 1.12; }
.hero-media-title { position: absolute; z-index: 1; right: 14px; bottom: 12px; left: 14px; margin: 0; color: #fff; font-family: var(--font-display); font-size: clamp(0.7rem, 1vw, 0.84rem); font-weight: 800; letter-spacing: 0.09em; line-height: 1.3; text-transform: uppercase; text-shadow: 0 2px 8px rgba(0, 0, 0, 0.85); transition: transform .25s ease; }
.hero-media-card:hover .hero-media-title, .hero-media-card:focus-visible .hero-media-title { transform: translateY(-3px); }
.hero .h1 { max-width: 1000px; }
.h1 { margin: 0; font-weight: 800; line-height: 0.95; letter-spacing: -0.02em; font-size: clamp(3rem, 7.2vw, 5.6rem); }
.hl { display: block; overflow: hidden; padding-bottom: 0.06em; }
.hl i { font-style: normal; color: var(--pink); }
.hl.g span { background: linear-gradient(90deg, #b9a8ff, #ff8cc8); -webkit-background-clip: text; background-clip: text; color: transparent; }
.btn { display: inline-flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1rem; text-decoration: none; color: #fff; background: var(--pink); border: 0; padding: 15px 30px; cursor: pointer; transition: transform .2s, filter .2s; }
.btn:hover { filter: brightness(1.12); transform: translateY(-2px); }
.btn:active { transform: translateY(0); }
.btn.alt { background: var(--blue); }
.btn[disabled] { filter: saturate(0.4) brightness(0.8); cursor: default; transform: none; }
.intro-copy { max-width: 58ch; margin: 0; color: #e2dcff; font-size: clamp(1rem, 1.5vw, 1.2rem); }
.fine { margin: 0; font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--mute); }

.card { position: relative; min-width: 0; overflow: hidden; background: var(--card); }
.c-chaos { grid-column: 1; grid-row: 2; min-height: 540px; background: #0d0916; }
.c-quote { grid-column: 1; grid-row: 3; padding: 26px 8px 10px 18px; display: flex; flex-direction: column; justify-content: center; gap: 12px; }
.c-quote .q { font-family: var(--font-mark); font-size: clamp(1.4rem, 2.6vw, 2rem); line-height: 1.25; color: var(--pink-soft); transform: rotate(-3deg); margin: 0; }
.c-quote .by { font-family: var(--font-mark); color: var(--pink-soft); opacity: 0.85; font-size: 1rem; margin-left: 24px; }
.c-bul { grid-column: 2; grid-row: 2; min-height: 420px; background: #0b1030; }
.c-thumb { grid-column: 1; grid-row: 2; display: grid; grid-template-columns: 112px minmax(0, 1fr); background: #120d26; border: 1px solid var(--line); }
.thumb-art { background: linear-gradient(135deg, #2a2fc2, #8a0f4f); display: grid; place-items: center; padding: 10px; }
.thumb-art svg { width: 100%; height: auto; }
.thumb-text { padding: 14px; display: grid; gap: 6px; align-content: center; }
.thumb-text b { font-weight: 700; font-size: 0.95rem; }
.thumb-text span { font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--mute); }
.play { justify-self: start; display: inline-grid; place-items: center; width: 34px; height: 34px; border: 1px solid var(--pink); color: var(--pink); text-decoration: none; font-size: 0.8rem; transition: background .2s, color .2s; }
.play:hover { background: var(--pink); color: #fff; }
.c-info { grid-column: 2; grid-row: 2; padding: 22px 24px 24px; background: linear-gradient(160deg, #5a2bd0, #2a0f6e 70%, #7a1170); display: grid; gap: 10px; align-content: start; }
.c-info h3 { margin: 0; font-size: 1.35rem; font-weight: 500; letter-spacing: 0.04em; text-transform: uppercase; line-height: 1.15; }
.c-info p { margin: 0; font-size: 0.82rem; color: #e2dcff; }
.art-svg { position: absolute; inset: 0; width: 100%; height: 100%; }
.art-label { position: absolute; left: 18px; bottom: 16px; right: 18px; display: grid; gap: 2px; }
.art-label b { font-size: 1.25rem; font-weight: 800; letter-spacing: 0.02em; }
.art-label span { font-size: 0.74rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--lav); }

/* sections */
.sec { width: min(1280px, 100%); margin: 0 auto; padding: 100px 28px 0; }
.sec-head { display: grid; gap: 10px; max-width: 700px; margin-bottom: 28px; }
.eyebrow { font-size: 0.7rem; letter-spacing: 0.3em; text-transform: uppercase; color: var(--pink-soft); }
.h2 { margin: 0; font-weight: 800; font-size: clamp(2rem, 5vw, 3.2rem); line-height: 1.04; letter-spacing: -0.015em; text-wrap: balance; }
.sec-head p { margin: 0; color: #c8c0ea; max-width: 56ch; }

.story-layout { display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(280px, 0.85fr); min-height: 460px; border: 1px solid var(--line); background: rgba(13, 10, 28, 0.86); }
.story-image { min-height: 420px; overflow: hidden; }
.story-image img { display: block; width: 100%; height: 100%; min-height: inherit; object-fit: cover; }
.story-copy { display: flex; flex-direction: column; align-items: flex-start; justify-content: center; gap: 18px; padding: clamp(28px, 5vw, 64px); }
.story-copy h3 { margin: 0; font-size: clamp(2rem, 4vw, 3.6rem); line-height: 1; }
.story-copy p { margin: 0; max-width: 42ch; color: #d6d0f0; }
.faction { margin-top: 44px; }
.faction-heading { display: flex; align-items: baseline; gap: 16px; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid var(--line); }
.faction-heading h3 { margin: 0; font-size: clamp(1.7rem, 3.5vw, 2.5rem); }
.faction-heading p { margin: 0; color: var(--mute); }
.faction.zaun .faction-heading h3 { color: var(--pink-soft); }
.faction.piltover .faction-heading h3 { color: #8fb0ff; }
.city-dialog { position: fixed; inset: 0; width: min(900px, calc(100% - 32px)); max-width: none; max-height: min(92vh, 900px); margin: auto; padding: clamp(24px, 5vw, 52px); overflow-y: auto; border: 1px solid var(--line); background: linear-gradient(145deg, rgba(20, 17, 36, 0.98), rgba(7, 6, 15, 0.98)); color: var(--bone); box-shadow: 0 28px 100px rgba(0, 0, 0, 0.78); }
.city-dialog::backdrop { background: rgba(4, 3, 10, 0.82); backdrop-filter: blur(9px); }
.city-dialog-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 28px; }
.city-dialog-head .eyebrow { margin: 0 0 8px; }
.city-dialog-head h2 { margin: 0; font-size: clamp(2rem, 5vw, 3.4rem); line-height: 1; }
.city-dialog-copy { max-width: 56ch; margin: 12px 0 0; color: #d0cbe0; }
.city-options { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
.city-option { position: relative; display: flex; min-height: 250px; flex-direction: column; justify-content: flex-end; gap: 10px; padding: clamp(22px, 4vw, 36px); overflow: hidden; border: 1px solid var(--line); color: var(--bone); text-align: left; cursor: pointer; isolation: isolate; transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease; }
.city-option::before, .city-option::after { position: absolute; z-index: -1; content: ""; pointer-events: none; }
.city-option:hover, .city-option:focus-visible { transform: translateY(-4px); }
.city-option strong { font-size: clamp(1.8rem, 4vw, 2.8rem); line-height: 1; letter-spacing: .04em; }
.city-option span { max-width: 34ch; color: rgba(255,255,255,.82); font-size: .88rem; }
.city-option.piltover { border-color: rgba(232, 202, 122, .5); background: linear-gradient(0deg, rgba(7, 12, 24, .9), rgba(13, 30, 48, .26)), linear-gradient(120deg, rgba(39, 82, 122, .48), rgba(190, 156, 80, .16)), url("images/piltover.jpg") center 42% / cover no-repeat; box-shadow: inset 0 0 40px rgba(111, 168, 225, .12); }
.city-option.piltover::before { top: -50px; right: -15px; width: 180px; height: 180px; border: 1px solid rgba(232,202,122,.5); border-radius: 50%; box-shadow: 0 0 0 16px rgba(232,202,122,.06), 0 0 0 38px rgba(111,168,225,.08); }
.city-option.piltover strong { color: #f0d48b; }
.city-option.zaun { border-color: rgba(167, 239, 69, .42); background: linear-gradient(0deg, rgba(9, 14, 17, .9), rgba(32, 13, 45, .26)), linear-gradient(120deg, rgba(27, 71, 34, .42), rgba(108, 40, 151, .22)), url("images/zaun.jpg") center 42% / cover no-repeat; box-shadow: inset 0 0 42px rgba(167, 239, 69, .08), 0 0 22px rgba(136, 55, 190, .12); }
.city-option.zaun::before { top: -16px; right: 24px; width: 22px; height: 115px; border: 5px solid rgba(167,239,69,.55); border-top: 0; border-radius: 0 0 16px 16px; filter: drop-shadow(0 0 8px rgba(167,239,69,.5)); }
.city-option.zaun::after { top: 85px; right: 25px; width: 80px; height: 14px; border: 4px solid rgba(163,76,224,.8); border-right: 0; border-radius: 12px 0 0 12px; }
.city-option.zaun strong { color: #b8ff62; }
.city-dialog-status { min-height: 1.4em; margin: 16px 0 0; color: var(--pink-soft); font-size: .82rem; }
.city-map { margin-top: clamp(64px, 8vw, 112px); }
.city-map-toolbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 20px; padding: clamp(18px, 2.4vw, 30px); border: 1px solid var(--line); background: linear-gradient(110deg, rgba(20, 17, 36, .96), rgba(7, 6, 15, .84)); }
.city-map-toolbar h3 { margin: 0; font-size: clamp(1.8rem, 3.4vw, 2.7rem); line-height: 1.05; }
.map-city-tabs { display: flex; gap: 8px; }
.map-city-tab { min-height: 48px; padding: 11px 18px; border: 1px solid var(--line); background: rgba(13, 10, 28, .84); color: var(--bone); font: inherit; font-size: .76rem; letter-spacing: .1em; text-transform: uppercase; cursor: pointer; }
.map-city-tab[aria-pressed="true"] { border-color: var(--pink-soft); color: var(--pink-soft); box-shadow: inset 0 -2px var(--pink-soft); }
.city-map-layout { display: grid; grid-template-columns: minmax(0, 1.55fr) minmax(320px, .75fr); min-height: 560px; border: 1px solid var(--line); background: rgba(13, 10, 28, .94); box-shadow: 0 24px 70px rgba(0, 0, 0, .28); }
.city-map-visual { position: relative; min-width: 0; min-height: 560px; overflow: hidden; background-position: center; background-size: cover; isolation: isolate; }
.city-map-visual::before { position: absolute; z-index: -1; inset: 0; content: ""; background: linear-gradient(0deg, rgba(5, 6, 12, .8), rgba(5, 6, 12, .12) 65%), linear-gradient(110deg, rgba(12, 21, 33, .45), transparent 75%); }
.city-map-visual[data-map-city="piltover"] { background-image: url("images/piltover.jpg"); }
.city-map-visual[data-map-city="zaun"] { background-image: url("images/zaun.jpg"); }
.city-map-label { position: absolute; top: 18px; left: 20px; margin: 0; color: #fff; font-size: .72rem; letter-spacing: .22em; text-transform: uppercase; text-shadow: 0 2px 8px #000; }
.map-landmark { position: absolute; display: inline-flex; align-items: center; gap: 9px; max-width: min(260px, 48%); padding: 11px 15px; border: 1px solid rgba(255,255,255,.62); background: rgba(7, 6, 15, .84); color: #fff; font: inherit; font-size: .82rem; line-height: 1.25; text-align: left; cursor: pointer; backdrop-filter: blur(7px); transform: translate(-50%, -50%); transition: border-color .2s ease, background .2s ease, box-shadow .2s ease; }
.map-landmark::before { width: 8px; height: 8px; flex: 0 0 auto; border-radius: 50%; background: var(--pink-soft); box-shadow: 0 0 12px var(--pink-soft); content: ""; }
.map-landmark[aria-pressed="true"], .map-landmark:hover { border-color: var(--pink-soft); background: rgba(13, 10, 28, .94); box-shadow: 0 0 20px color-mix(in srgb, var(--pink-soft) 28%, transparent); }
.map-landmark[data-city="piltover"][hidden], .map-landmark[data-city="zaun"][hidden] { display: none; }
.map-landmark[data-landmark="academy"] { top: 35%; left: 29%; }
.map-landmark[data-landmark="council"] { top: 53%; left: 68%; }
.map-landmark[data-landmark="last-drop"] { top: 39%; left: 32%; }
.map-landmark[data-landmark="stillwater"] { top: 62%; left: 72%; }
.map-landmark[data-landmark="firelights"] { top: 53%; left: 48%; }
.city-map-hint { position: absolute; right: 22px; bottom: 20px; left: 22px; margin: 0; color: rgba(255,255,255,.86); font-size: .76rem; letter-spacing: .1em; text-shadow: 0 1px 5px #000; }
.landmark-detail { display: flex; flex-direction: column; align-items: flex-start; justify-content: center; gap: 20px; padding: clamp(30px, 4vw, 52px); }
.landmark-detail .eyebrow { margin: 0; }
.landmark-detail h4 { margin: 0; font-size: clamp(2rem, 3.5vw, 2.8rem); line-height: 1; }
.landmark-detail p { margin: 0; color: #d6d0f0; font-size: 1rem; line-height: 1.7; }
.landmark-detail .landmark-spotlight { color: var(--pink-soft); font-size: .9rem; line-height: 1.55; }
.landmark-detail .btn { margin-top: 6px; }
.dashboard { width: calc(100% + 56px); margin: clamp(96px, 11vw, 148px) 0 0 -28px; padding: clamp(30px, 5vw, 64px); border: 1px solid var(--line); background: linear-gradient(145deg, rgba(13, 10, 28, .96), rgba(7, 6, 15, .88)); box-shadow: 0 28px 80px rgba(0, 0, 0, .25); }
.dashboard .sec-head { max-width: 850px; margin-bottom: 36px; }
.dashboard-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
.dashboard-card { position: relative; display: flex; min-height: 270px; flex-direction: column; align-items: flex-start; justify-content: space-between; gap: 18px; padding: clamp(24px, 3vw, 36px); overflow: hidden; border: 1px solid var(--line); background: linear-gradient(145deg, rgba(20, 17, 36, .96), rgba(7, 6, 15, .92)); }
.dashboard-card::before { position: absolute; top: 0; left: 0; width: 100%; height: 3px; background: linear-gradient(90deg, var(--pink-soft), var(--blue)); content: ""; opacity: .8; }
.dashboard-card .eyebrow { margin: 0; }
.dashboard-card h3 { margin: 0; font-size: clamp(1.5rem, 2.4vw, 2.2rem); line-height: 1.08; }
.dashboard-card p { margin: 0; color: #d6d0f0; font-size: .98rem; line-height: 1.65; }
.dashboard-card .btn { margin-top: auto; }
.account-start { display: grid; gap: 14px; }
.account-start .account-panel > p { margin-bottom: 10px; }
.account-start-actions { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
.account-start-actions .btn { justify-content: center; }
.account-flow-note { margin: 4px 0 8px; padding: 12px 14px; border-left: 2px solid var(--blue); background: rgba(91, 134, 255, .1); color: #d6d0f0; font-size: .82rem; }
.account-guest { justify-content: center; width: 100%; }
.account-continue { width: 100%; justify-content: center; margin-top: 16px; }
body[data-flow-step="account"] .city-switch { visibility: hidden; }
@media (max-width: 760px) {
  .city-map-toolbar { align-items: flex-start; }
  .map-city-tabs { width: 100%; }
  .map-city-tab { flex: 1; padding-inline: 10px; font-size: .65rem; }
  .city-map-layout { grid-template-columns: minmax(0, 1fr); }
  .city-map-visual { min-height: 460px; }
  .landmark-detail { min-height: 320px; }
  .dashboard { width: 100%; margin-left: 0; padding: 26px 20px; }
  .dashboard-grid { grid-template-columns: minmax(0, 1fr); }
  .dashboard-card { min-height: 240px; }
}
@media (max-width: 600px) {
  .city-options { grid-template-columns: minmax(0, 1fr); }
  .city-option { min-height: 190px; }
  .account-start-actions { grid-template-columns: minmax(0, 1fr); }
  .map-landmark { max-width: 46%; gap: 6px; padding: 7px 8px; font-size: .67rem; }
}
.account-dialog { position: fixed; inset: 0; width: min(560px, calc(100% - 32px)); max-width: none; max-height: min(90vh, 900px); margin: auto; padding: clamp(22px, 4vw, 40px); overflow-y: auto; border: 1px solid var(--line); background: var(--panel); color: var(--bone); box-shadow: 0 24px 80px rgba(0, 0, 0, 0.7); }
.account-dialog::backdrop { background: rgba(4, 3, 10, 0.78); backdrop-filter: blur(5px); }
.account-dialog-heading { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 22px; }
.account-dialog-heading .sec-head { margin: 0; }
.account-close { flex: 0 0 auto; display: grid; place-items: center; width: 40px; height: 40px; border: 1px solid var(--line); background: transparent; color: var(--bone); font: inherit; font-size: 1.4rem; cursor: pointer; }
.account-close:hover { border-color: var(--pink-soft); color: var(--pink-soft); }
.account-grid { display: grid; grid-template-columns: minmax(0, 1fr); gap: 18px; }
.account-panel { min-width: 0; padding: clamp(22px, 4vw, 40px); border: 1px solid var(--line); background: rgba(13, 10, 28, 0.9); }
.account-dialog .account-panel { padding: 0; border: 0; background: transparent; }
.account-panel h3 { margin: 0 0 8px; font-size: clamp(1.7rem, 3vw, 2.2rem); }
.account-panel > p { margin: 0 0 22px; color: #c8c0ea; }
.account-form { display: grid; gap: 14px; }
.account-form label { display: grid; gap: 6px; color: var(--lav); font-size: 0.8rem; letter-spacing: 0.08em; }
.account-form input { width: 100%; min-height: 46px; padding: 10px 12px; border: 1px solid var(--line); border-radius: 0; background: rgba(7, 6, 15, 0.88); color: var(--bone); font: inherit; letter-spacing: normal; }
.account-form input:focus { border-color: var(--pink-soft); outline: 2px solid rgba(255, 106, 184, 0.28); }
.account-form .btn { justify-content: center; margin-top: 4px; }
.account-notice { margin: 0 0 22px; padding: 10px 12px; border-left: 2px solid var(--blue); background: rgba(91, 134, 255, 0.1); color: #d6d0f0; font-size: 0.8rem; }
.account-status { min-height: 1.5em; margin: 0; color: var(--pink-soft); font-size: 0.82rem; }
.account-switch { margin: 16px 0 0 !important; color: var(--mute) !important; font-size: 0.82rem; }
.account-switch a { color: var(--lav); }
.character-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
.character-card { position: relative; display: grid; grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr); align-items: stretch; min-height: 320px; border: 1px solid var(--line); background: rgba(13, 10, 28, 0.86); transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease; }
.character-portrait { position: relative; min-width: 0; min-height: 320px; overflow: hidden; background: rgba(13, 10, 28, 0.42); }
.character-portrait img { --portrait-visible: 41.667%; position: absolute; top: 0; left: 50%; display: block; width: auto; height: 240%; max-width: none; object-fit: contain; object-position: top center; clip-path: inset(0 0 calc(100% - var(--portrait-visible)) 0); transform: translateX(-50%); transition: height .45s ease, transform .45s ease, filter .45s ease; }
.character-card:hover, .character-card:focus-within { z-index: 5; transform: translateY(-7px); border-color: rgba(185, 168, 255, 0.7); box-shadow: 0 18px 42px rgba(0, 0, 0, 0.4), 0 0 24px rgba(185, 168, 255, 0.12); }
.character-card:hover .character-portrait, .character-card:focus-within .character-portrait { overflow: visible; }
.character-card:hover .character-portrait img, .character-card:focus-within .character-portrait img { height: 270%; transform: translateX(-50%) translateY(-30px) scale(1.12); filter: brightness(1.12) drop-shadow(0 12px 12px rgba(0, 0, 0, 0.4)); }
.character-card:active { transform: translateY(-2px) scale(0.995); }
.character-card[data-character="vi"] .character-portrait img { --portrait-visible: 60; height: 240%; }
.character-card:hover[data-character="vi"] .character-portrait img, .character-card:focus-within[data-character="vi"] .character-portrait img { --portrait-visible: 44.5%; height: 250%; }
.character-card[data-character="caitlyn"] .character-portrait img { left: calc(70% + 48px); }
.character-card[data-character="jayce"] .character-portrait img { left: 30%; }
.character-card[data-character="heimerdinger"] .character-portrait img { --portrait-visible: 79%; left: 60%; height: 130%; }
.character-card:hover[data-character="heimerdinger"] .character-portrait img, .character-card:focus-within[data-character="heimerdinger"] .character-portrait img { --portrait-visible: 70.3%; height: 150%; }
.character-card[data-character="mel"] .character-portrait img { left: 100%; }
.character-card[data-character="ekko"] .character-portrait img { left: 30%; }
.character-card[data-character="ambessa"] .character-portrait img { left: 55%; }
.character-copy { align-self: center; padding: clamp(18px, 2.5vw, 32px); }
.character-copy .eyebrow { margin: 0 0 10px; }
.character-copy h4 { margin: 0 0 12px; font-size: clamp(1.6rem, 2.5vw, 2.4rem); line-height: 1; }
.character-card[data-character="jinx"] .character-copy h4 { position: relative; width: fit-content; }
.character-card[data-character="jinx"]:hover .character-copy h4, .character-card[data-character="jinx"]:focus-within .character-copy h4 { color: #c084fc; text-shadow: 0 0 10px rgba(168, 85, 247, 0.8), 0 0 24px rgba(168, 85, 247, 0.5); }
.character-card[data-character="jinx"] .character-copy h4::before { content: ""; position: absolute; top: 2px; right: -25px; width: 18px; height: 18px; border-radius: 50%; opacity: 0; background: radial-gradient(circle at 50% 65%, #a855f7 0 42%, #4c1d95 48% 62%, transparent 66%), linear-gradient(135deg, transparent 42%, #ffd166 45% 55%, transparent 58%); background-size: 15px 15px, 8px 8px; background-position: center, right top; background-repeat: no-repeat; filter: drop-shadow(0 0 6px #a855f7); transform: translate(-8px, 8px) scale(.5) rotate(-35deg); }
.character-card[data-character="jinx"] .character-copy h4::after { content: ""; position: absolute; top: -3px; right: -31px; width: 12px; height: 12px; opacity: 0; background: #e9b8ff; clip-path: polygon(50% 0, 62% 36%, 100% 50%, 62% 64%, 50% 100%, 38% 64%, 0 50%, 38% 36%); filter: drop-shadow(0 0 5px #c084fc); }
.character-card[data-character="jinx"]:hover .character-copy h4::before, .character-card[data-character="jinx"]:focus-within .character-copy h4::before { opacity: 1; animation: jinx-bomb-pop .65s cubic-bezier(.2, .8, .2, 1) both, jinx-bomb-fuse 1.1s .65s ease-in-out infinite; }
.character-card[data-character="jinx"]:hover .character-copy h4::after, .character-card[data-character="jinx"]:focus-within .character-copy h4::after { opacity: 1; animation: jinx-spark-burst .8s .45s ease-out infinite; }
@keyframes jinx-bomb-pop { to { transform: translate(0, 0) scale(1) rotate(0); } }
@keyframes jinx-bomb-fuse { 50% { transform: translateY(-3px) rotate(9deg); } }
@keyframes jinx-spark-burst { 0%, 100% { transform: scale(.35) rotate(0); opacity: .35; } 45% { transform: scale(1.15) rotate(55deg); opacity: 1; } }
.character-card[data-character="vi"] { --character-accent: #ff1493; --character-icon: "✊︎"; }
.character-card[data-character="ekko"] { --character-accent: #00f5ff; --character-icon: "⌛"; }
.character-card[data-character="viktor"] { --character-accent: #fff2bd; --character-icon: "⬡"; }
.character-card[data-character="silco"] { --character-accent: #ffb000; --character-icon: "◉"; }
.character-card[data-character="sevika"] { --character-accent: #dc143c; --character-icon: "🗡"; }
.character-card[data-character="vander"] { --character-accent: #ffb347; --character-icon: "🐺︎"; }
.character-card[data-character="singed"] { --character-accent: #b6ff00; --character-icon: "☣"; }
.character-card[data-character="caitlyn"] { --character-accent: #2563eb; --character-icon: "⛊"; }
.character-card[data-character="jayce"] { --character-accent: #ffd700; --character-icon: "⚒"; }
.character-card[data-character="mel"] { --character-accent: #d4af37; --character-icon: "☀"; }
.character-card[data-character="heimerdinger"] { --character-accent: #cd7f32; --character-icon: "🔧︎"; }
.character-card[data-character="ambessa"] { --character-accent: #b00020; --character-icon: "🐺︎"; }
.character-card[data-character="maddie"] { --character-accent: #c9a227; --character-icon: "⬟"; }
.character-card:not([data-character="jinx"]) .character-copy h4 { position: relative; width: fit-content; text-shadow: 0 0 0 transparent; transition: text-shadow .25s ease; }
.character-card:not([data-character="jinx"]):hover .character-copy h4, .character-card:not([data-character="jinx"]):focus-within .character-copy h4 { color: var(--character-accent); text-shadow: 0 0 10px var(--character-accent), 0 0 24px var(--character-accent); }
.character-card:not([data-character="jinx"]) .character-copy h4::before { content: var(--character-icon); position: absolute; top: -.15em; right: -1.35em; display: block; color: var(--character-accent); font: 700 .7em/1 "Segoe UI Symbol", "Apple Symbols", sans-serif; font-variant-emoji: text; opacity: 0; filter: drop-shadow(0 0 6px var(--character-accent)); transform: translate(-8px, 8px) scale(.5) rotate(-25deg); }
.character-card:not([data-character="jinx"]) .character-copy h4::after { content: ""; position: absolute; top: -.4em; right: -1.65em; width: .45em; height: .45em; background: #fff; clip-path: polygon(50% 0, 62% 36%, 100% 50%, 62% 64%, 50% 100%, 38% 64%, 0 50%, 38% 36%); filter: drop-shadow(0 0 5px var(--character-accent)); opacity: 0; }
.character-card:not([data-character="jinx"]):hover .character-copy h4::before, .character-card:not([data-character="jinx"]):focus-within .character-copy h4::before { opacity: 1; animation: character-icon-pop .55s cubic-bezier(.2, .8, .2, 1) both, character-icon-pulse 1.2s .55s ease-in-out infinite; }
.character-card:not([data-character="jinx"]):hover .character-copy h4::after, .character-card:not([data-character="jinx"]):focus-within .character-copy h4::after { opacity: 1; animation: jinx-spark-burst .8s .25s ease-out infinite; }
@keyframes character-icon-pop { to { transform: translate(0, 0) scale(1) rotate(0); } }
@keyframes character-icon-pulse { 50% { transform: translateY(-3px) rotate(8deg); } }
.character-copy p { margin: 0; color: #e2dcff; font-size: 0.9rem; }
.character-card:nth-child(even) .character-portrait { grid-column: 2; grid-row: 1; }
.character-card:nth-child(even) .character-copy { grid-column: 1; grid-row: 1; }
.character-placeholder { display: grid; place-items: center; background: radial-gradient(circle at 50% 35%, rgba(255, 47, 146, 0.3), transparent 58%), #100b21; }
.piltover .character-placeholder { background: radial-gradient(circle at 50% 35%, rgba(91, 134, 255, 0.34), transparent 58%), #0b1030; }
.character-placeholder span { font-size: clamp(3rem, 8vw, 6rem); color: rgba(244, 240, 255, 0.66); }

/* team vote */
.teams { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
.team { position: relative; min-width: 0; padding: 30px 28px 28px; display: grid; gap: 14px; align-content: start; border: 1px solid var(--line); transition: transform .3s, border-color .3s, box-shadow .3s; overflow: hidden; }
.team:hover { transform: translateY(-4px); }
.team.chaos { background: linear-gradient(160deg, #2b0f3a, #12081f 70%); }
.team.bulwark { background: linear-gradient(160deg, #101a52, #0a0d26 70%); }
.team.mine.chaos { border-color: var(--pink); box-shadow: 0 0 0 1px var(--pink), 0 20px 50px rgba(255, 47, 146, 0.22); }
.team.mine.bulwark { border-color: var(--blue); box-shadow: 0 0 0 1px var(--blue), 0 20px 50px rgba(91, 134, 255, 0.24); }
.team .tag { font-size: 0.7rem; letter-spacing: 0.28em; text-transform: uppercase; color: var(--mute); }
.team h3 { margin: 0; font-size: clamp(2rem, 4.4vw, 3rem); font-weight: 800; line-height: 1; }
.team.chaos h3 { color: var(--pink-soft); }
.team.bulwark h3 { color: #8fb0ff; }
.team p { margin: 0; color: #d6d0f0; max-width: 46ch; }
.traits { display: flex; flex-wrap: wrap; gap: 8px; margin: 2px 0 6px; padding: 0; list-style: none; }
.traits li { font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase; padding: 6px 12px; border: 1px solid var(--line); color: var(--lav); }
.badge { position: absolute; top: 20px; right: 20px; font-size: 0.68rem; letter-spacing: 0.2em; text-transform: uppercase; padding: 6px 12px; background: var(--ink); border: 1px solid currentColor; display: none; }
.team.chaos .badge { color: var(--pink-soft); }
.team.bulwark .badge { color: #8fb0ff; }
.team.mine .badge { display: block; }

/* count */
.results { position: relative; margin-top: 18px; padding: 30px 28px 26px; background: linear-gradient(180deg, #120d26, #0b0818); border: 1px solid var(--line); display: grid; gap: 22px; overflow: hidden; }
.res-top { display: flex; justify-content: space-between; align-items: baseline; gap: 14px; flex-wrap: wrap; }
.res-top h3 { margin: 0; font-size: 1.1rem; letter-spacing: 0.2em; text-transform: uppercase; font-weight: 500; }
#total { font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--mute); font-variant-numeric: tabular-nums; }
.tally { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 18px; }
.tally > div { display: grid; gap: 2px; }
.tally .r { text-align: right; }
.num { font-size: clamp(3rem, 9vw, 5.6rem); font-weight: 800; line-height: 0.95; font-variant-numeric: tabular-nums; letter-spacing: -0.03em; }
.tally .c .num { color: var(--pink-soft); }
.tally .b .num { color: #8fb0ff; }
.nm { font-size: 0.72rem; letter-spacing: 0.26em; text-transform: uppercase; color: var(--mute); }
.track { position: relative; height: 18px; display: flex; background: #1b1540; overflow: hidden; clip-path: polygon(10px 0, 100% 0, calc(100% - 10px) 100%, 0 100%); }
#barC { width: 50%; background: linear-gradient(90deg, #c01775, var(--pink)); }
#barB { width: 50%; background: linear-gradient(90deg, #3f66e8, #7aa0ff); }
#lead { margin: 0; font-size: 1.05rem; color: #e5dfff; min-height: 1.6em; }
#note { margin: 0; font-size: 0.82rem; color: var(--mute); min-height: 1.2em; }
.lock { position: absolute; inset: 0; z-index: 3; display: grid; place-content: center; justify-items: center; gap: 10px; text-align: center; padding: 20px; background: rgba(10, 8, 24, 0.82); backdrop-filter: blur(7px); -webkit-backdrop-filter: blur(7px); }
.lock b { font-size: 1.35rem; font-weight: 700; }
.lock span { color: var(--mute); font-size: 0.9rem; }
.results.open .lock { display: none; }

/* arcade */
.arcade { display: grid; gap: 16px; }
.tabs { display: flex; flex-wrap: wrap; gap: 10px; }
.tab { font-weight: 500; font-size: 0.92rem; padding: 12px 20px; color: var(--lav); background: transparent; border: 1px solid var(--line); cursor: pointer; transition: background .2s, color .2s, border-color .2s; }
.tab:hover { border-color: var(--lav); }
.tab[aria-pressed="true"] { background: var(--pink); border-color: var(--pink); color: #fff; }
.tab[data-g="guard"][aria-pressed="true"] { background: var(--blue); border-color: var(--blue); }
.tab[data-g="echo"][aria-pressed="true"] { background: #7a4cf0; border-color: #7a4cf0; }
.tab[data-g="rush"][aria-pressed="true"] { background: #e6a02f; border-color: #e6a02f; color: #1a1030; }
.gbox { background: linear-gradient(180deg, #120d26, #0b0818); border: 1px solid var(--line); padding: 20px; display: grid; gap: 16px; }
.hud { display: grid; grid-template-columns: minmax(0, 1fr) auto auto auto; gap: 10px 26px; align-items: end; }
.hud h3 { margin: 0; font-size: 1.4rem; font-weight: 800; line-height: 1.1; }
.hud p { margin: 4px 0 0; font-size: 0.85rem; color: #c8c0ea; max-width: 54ch; }
.stat { display: grid; gap: 0; text-align: right; }
.stat span { font-size: 0.62rem; letter-spacing: 0.22em; text-transform: uppercase; color: var(--mute); }
.stat b { font-size: 1.6rem; font-weight: 700; font-variant-numeric: tabular-nums; line-height: 1.1; }
.arena { position: relative; height: 340px; overflow: hidden; border: 1px solid var(--line); background: radial-gradient(80% 90% at 50% 100%, rgba(122, 40, 200, 0.28), transparent 70%), #0a0716; touch-action: manipulation; user-select: none; -webkit-user-select: none; }
.arena .msg { position: absolute; inset: 0; display: grid; place-content: center; text-align: center; gap: 6px; padding: 20px; pointer-events: none; }
.arena .msg b { font-size: 1.6rem; font-weight: 800; }
.arena .msg span { color: var(--mute); font-size: 0.9rem; }
.ginfo { margin: 0; min-height: 1.5em; font-size: 0.95rem; color: #e5dfff; }
.grow { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }

.bomb { position: absolute; width: 68px; height: 68px; margin: -34px 0 0 -34px; padding: 0; border: 0; background: transparent; cursor: pointer; }
.b-core { position: absolute; inset: 12px; border-radius: 50%; background: radial-gradient(circle at 35% 30%, #ff9ccf, #c0176b 60%, #4a0a2d); box-shadow: 0 0 20px rgba(255, 47, 146, 0.7); }
.b-ring { position: absolute; inset: 0; border-radius: 50%; border: 2px solid var(--pink-soft); }
.spark { position: absolute; width: 6px; height: 6px; margin: -3px; border-radius: 50%; background: var(--pink-soft); pointer-events: none; }
.hearts { letter-spacing: 0.15em; color: var(--pink-soft); }

.guard-svg { position: absolute; inset: 0; width: 100%; height: 100%; cursor: crosshair; }
.pads { height: 100%; display: grid; grid-template-columns: repeat(2, 128px); gap: 14px; justify-content: center; align-content: center; }
.pad { width: 128px; height: 140px; padding: 0; border: 0; cursor: pointer; clip-path: polygon(50% 0, 100% 25%, 100% 75%, 50% 100%, 0 75%, 0 25%); }
.pad[data-i="0"] { background: #ff2f92; }
.pad[data-i="1"] { background: #5b86ff; }
.pad[data-i="2"] { background: #e6a02f; }
.pad[data-i="3"] { background: #3fd6c0; }
.pad[disabled] { cursor: default; }
.rush-target { position: absolute; width: 84px; height: 84px; margin: -42px 0 0 -42px; border: 0; padding: 0; background: #e6a02f; cursor: pointer; clip-path: polygon(50% 0, 100% 25%, 100% 75%, 50% 100%, 0 75%, 0 25%); }
.rush-target.decoy { background: #4a3a7a; }

footer { margin-top: 100px; padding: 36px 24px; text-align: center; border-top: 1px solid var(--line); background: rgba(7, 6, 15, 0.8); }
footer p { margin: 0 auto; max-width: 62ch; font-size: 0.8rem; color: var(--mute); }

@media (max-width: 900px) {
  .top { display: flex; align-items: flex-start; flex-direction: column; padding: 20px 24px; }
  .site-nav { width: 100%; flex-wrap: wrap; justify-content: space-between; }
  .c-head { width: 100%; padding: 100px 24px 32px; }
  .hero-media-row { width: 100%; }
  .hero-media-list { grid-auto-columns: 74vw; }
  .story-layout { grid-template-columns: 1fr; }
  .city-map-layout { grid-template-columns: minmax(0, 1.25fr) minmax(280px, .75fr); }
  .city-map-visual, .city-map-layout { min-height: 500px; }
  .landmark-detail { padding: 28px; }
  .dashboard { width: 100%; margin-left: 0; padding: 32px 24px; }
  .dashboard-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .dashboard-card:first-child { grid-column: 1 / -1; }
  .story-image { min-height: 320px; max-height: 480px; }
  .character-grid { grid-template-columns: minmax(0, 1fr); }
  .c-chaos { grid-column: 1; grid-row: 2; }
  .c-bul { grid-column: 1; grid-row: 3; }
  .c-quote { grid-column: 1; grid-row: 4; }
  .c-thumb { grid-column: 1; grid-row: 2; }
  .c-info { grid-column: 1; grid-row: 3; }
  .c-chaos { min-height: 460px; }
  .c-bul { min-height: 380px; }
  .teams { grid-template-columns: minmax(0, 1fr); }
  .hud { grid-template-columns: minmax(0, 1fr) auto auto; }
  .hud > div:first-child { grid-column: 1 / -1; }
}
@media (max-width: 480px) {
  .top { padding: 18px 16px; }
  .site-nav { gap: 12px 18px; }
  .site-nav a { font-size: 0.64rem; }
  .c-head { padding: 86px 18px 24px; gap: 28px; }
  .hero-media-row { padding-top: 40px; transform: translateY(-20px); }
  .hero-media-list { grid-auto-columns: 78vw; gap: 10px; }
  .hero-media-play { width: 40px; height: 40px; }
  .hero-video-toggle { top: 16px; right: 16px; }
  .sec { padding: 72px 18px 0; }
  .story-copy { padding: 28px 22px; }
  .character-card { grid-template-columns: minmax(0, 0.85fr) minmax(0, 1.15fr); min-height: 280px; }
  .character-portrait { min-height: 280px; }
  .character-copy { padding: 18px 12px; }
  .character-copy h3 { font-size: 2rem; }
  .character-copy p { font-size: 0.88rem; }
  .tally .num { font-size: 3rem; }
  .gbox { padding: 14px; }
  .team { padding: 24px 20px; }
  .results { padding: 22px 18px; }
  .arena { height: 320px; }
}
@media (max-width: 760px) {
  .city-map-toolbar { align-items: flex-start; }
  .map-city-tabs { width: 100%; }
  .map-city-tab { flex: 1; padding-inline: 10px; font-size: .65rem; }
  .city-map-layout { grid-template-columns: minmax(0, 1fr); }
  .city-map-visual { min-height: 460px; }
  .landmark-detail { min-height: 320px; }
  .dashboard { width: calc(100% + 36px); margin-left: -18px; padding: 26px 20px; }
  .dashboard-grid { grid-template-columns: minmax(0, 1fr); }
  .dashboard-card:first-child { grid-column: auto; }
  .dashboard-card { min-height: 240px; }
}
@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }
  .team, .btn { transition: none; }
  .character-card, .character-portrait img { transition: none; }
  .character-card:hover, .character-card:active { transform: none; }
  .character-card:hover .character-portrait img, .character-card:focus-within .character-portrait img { height: 240%; transform: translateX(-50%); filter: none; }
  .character-card:hover[data-character="vi"] .character-portrait img, .character-card:focus-within[data-character="vi"] .character-portrait img { --portrait-visible: 45.455%; height: 220%; }
  .character-card:hover[data-character="heimerdinger"] .character-portrait img, .character-card:focus-within[data-character="heimerdinger"] .character-portrait img { --portrait-visible: 76.923%; height: 130%; }
  .character-card[data-character="jinx"] .character-copy h4::before, .character-card[data-character="jinx"] .character-copy h4::after { animation: none !important; }
  .character-card:not([data-character="jinx"]) .character-copy h4 { transition: none; }
  .character-card:not([data-character="jinx"]) .character-copy h4::before, .character-card:not([data-character="jinx"]) .character-copy h4::after { animation: none !important; }
  .hero-media-card, .hero-media-card img, .hero-media-play, .hero-media-title { transition: none; }
  .hero-media-card:hover, .hero-media-card:focus-visible { transform: none; }
  .hero-media-card:hover img, .hero-media-card:focus-visible img { transform: none; filter: none; }
  .hero-media-card:hover .hero-media-play, .hero-media-card:focus-visible .hero-media-play { scale: 1; }
  .hero-media-card:hover .hero-media-title, .hero-media-card:focus-visible .hero-media-title { transform: none; }
}
</style>
<link rel="stylesheet" href="city-experience.css">

<canvas id="fx" aria-hidden="true"></canvas>

  <?php require __DIR__ . '/includes/header.php'; ?>

  <main>
  <section class="hero" aria-labelledby="t">
    <video class="hero-video" autoplay muted loop playsinline aria-hidden="true">
      <source src="jinx scenepack.mp4" type="video/mp4">
    </video>
    <button class="hero-video-toggle" type="button" aria-label="Unmute hero video" aria-pressed="false">
      <span class="sound-icon" aria-hidden="true">♫</span>
      <span class="sound-label">Unmute</span>
    </button>
    <div class="collage">
      <div class="c-head">
        <h1 class="h1" id="t">
          <span class="hl"><span>UP IN LIGHT<i>.</i></span></span>
          <span class="hl"><span>DOWN IN DUST<i>.</i></span></span>
          <span class="hl g"><span>CHOOSE YOUR SIDE<i>.</i></span></span>
        </h1>
        <p class="intro-copy">Explore a world inspired by Arcane and League of Legends, then jump into a four-game arcade.</p>
        <a class="btn" href="#story">Step into the city <span aria-hidden="true">&#9654;</span></a>
        <section class="hero-media-row" aria-label="Featured video thumbnails">
          <p class="hero-media-heading">Featured videos</p>
          <div class="hero-media-list">
            <a class="hero-media-card" href="https://youtu.be/fXmAurh012s?si=MW5WM97Ua-e4VcHz" target="_blank" rel="noopener noreferrer" aria-label="Watch Arcane Official Trailer on YouTube">
              <img src="https://img.youtube.com/vi/fXmAurh012s/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">Arcane | Official Trailer</h2>
            </a>
            <a class="hero-media-card" href="https://youtu.be/HufxpR0KXQQ?si=6WFTUCzf6DAMgh8F" target="_blank" rel="noopener noreferrer" aria-label="Watch Paint the Town Blue on YouTube">
              <img src="https://img.youtube.com/vi/HufxpR0KXQQ/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">Paint the Town Blue</h2>
            </a>
            <a class="hero-media-card" href="https://youtu.be/3jf6xOg6e7Y?si=o4iKjEXSrJ7Qv0ug" target="_blank" rel="noopener noreferrer" aria-label="Watch Come Play on YouTube">
              <img src="https://img.youtube.com/vi/3jf6xOg6e7Y/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">Come Play</h2>
            </a>
            <a class="hero-media-card" href="https://www.youtube.com/watch?v=1F3OGIFnW1k" target="_blank" rel="noopener noreferrer" aria-label="Watch Ma Meilleure Ennemie on YouTube">
              <img src="https://img.youtube.com/vi/1F3OGIFnW1k/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">Ma Meilleure Ennemie</h2>
            </a>
            <a class="hero-media-card" href="https://youtu.be/F5tSoaJ93ac?si=EWAYljUcPAgbSW6w" target="_blank" rel="noopener noreferrer" aria-label="Watch Enemy by Imagine Dragons and JID on YouTube">
              <img src="https://img.youtube.com/vi/F5tSoaJ93ac/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">Enemy | Imagine Dragons &amp; JID</h2>
            </a>
            <a class="hero-media-card" href="https://youtu.be/Gj-jmBi0aK8?si=R5jKLDhaYQqAtQ9G" target="_blank" rel="noopener noreferrer" aria-label="Watch To Ashes and Blood by Woodkid on YouTube">
              <img src="https://img.youtube.com/vi/Gj-jmBi0aK8/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">To Ashes and Blood | Woodkid</h2>
            </a>
            <a class="hero-media-card" href="https://youtu.be/t9mpyRzipww?si=7yLq7vuOqsrnW9jm" target="_blank" rel="noopener noreferrer" aria-label="Watch Fantastic by King Princess on YouTube">
              <img src="https://img.youtube.com/vi/t9mpyRzipww/hqdefault.jpg" alt="" loading="lazy">
              <span class="hero-media-play" aria-hidden="true">&#9654;</span>
              <h2 class="hero-media-title">Fantastic | King Princess</h2>
            </a>
          </div>
        </section>
      </div>
      

      <article class="card c-chaos" aria-label="Team Chaos artwork" hidden>
        <svg class="art-svg" id="artC" viewBox="0 0 400 540" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
          <defs>
            <radialGradient id="cGlow" cx="50%" cy="46%" r="60%">
              <stop offset="0" stop-color="#ff2f92" stop-opacity="0.5"/>
              <stop offset="0.6" stop-color="#7a1fbf" stop-opacity="0.18"/>
              <stop offset="1" stop-color="#0d0916" stop-opacity="0"/>
            </radialGradient>
            <radialGradient id="bombG" cx="35%" cy="30%" r="75%">
              <stop offset="0" stop-color="#4a2a7a"/>
              <stop offset="0.6" stop-color="#1b1030"/>
              <stop offset="1" stop-color="#0a0614"/>
            </radialGradient>
          </defs>
          <rect width="400" height="540" fill="url(#cGlow)"/>
          <image href="images/jinx.jpg" x="0" y="0" width="400" height="540" preserveAspectRatio="xMidYMid slice"/>
          <g id="burst" transform="translate(200 250)">
            <polygon fill="#ff2f92" fill-opacity="0.16" points="0,-190 28,-110 90,-165 70,-85 160,-100 100,-35 190,0 100,35 160,100 70,85 90,165 28,110 0,190 -28,110 -90,165 -70,85 -160,100 -100,35 -190,0 -100,-35 -160,-100 -70,-85 -90,-165 -28,-110"/>
          </g>
          <g id="bomb" transform="translate(200 262)">
            <circle r="74" fill="url(#bombG)" stroke="#ff6ab8" stroke-width="3"/>
            <path d="M-46 -36 C-30 -56 -6 -62 14 -58" fill="none" stroke="#ff8ac6" stroke-opacity="0.7" stroke-width="6" stroke-linecap="round"/>
            <rect x="-14" y="-96" width="28" height="26" fill="#2a1a45" stroke="#ff6ab8" stroke-width="2"/>
            <path class="draw" d="M0 -96 C0 -122 26 -126 38 -146" fill="none" stroke="#ffd2ea" stroke-width="4" stroke-linecap="round"/>
            <g class="fusespark" transform="translate(38 -150)">
              <path d="M0 -16 L4 -4 L16 0 L4 4 L0 16 L-4 4 L-16 0 L-4 -4 Z" fill="#fff2a8"/>
            </g>
          </g>
          <g fill="none" stroke="#ff6ab8" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
            <path class="draw" d="M52 120 L104 86 L96 150 L156 108 L136 186"/>
            <path class="draw" d="M312 120 c-30 -42 -92 -12 -72 30 c20 42 92 22 82 -20 c-8 -32 -52 -32 -57 -6"/>
            <path class="draw" d="M62 396 l30 30 M92 396 l-30 30"/>
            <path class="draw" d="M36 482 C120 446 250 510 366 452"/>
            <path class="draw" d="M318 340 L329 368 L360 370 L336 390 L345 420 L318 403 L291 420 L300 390 L276 370 L307 368 Z"/>
            <path class="draw" d="M336 214 l34 -10 M342 240 l36 4 M330 190 l28 -24"/>
          </g>
          <text x="86" y="436" font-family="'Arcane Nine', Georgia, serif" font-size="62" fill="#ff2f92" transform="rotate(-9 86 436)" class="wob">BOOM!</text>
          <text x="262" y="96" font-family="'Arcane Nine', Georgia, serif" font-size="32" fill="#ffd2ea" transform="rotate(8 262 96)" class="wob">ZAP!</text>
          <text x="40" y="262" font-family="'Arcane Nine', Georgia, serif" font-size="24" fill="#b9a8ff" transform="rotate(-12 40 262)" class="wob">oops.</text>
        </svg>
        <div class="art-label"><b>Team Chaos</b><span>No plan. Maximum noise.</span></div>
      </article>

      <div class="c-quote" hidden>
        <p class="q">&ldquo;Light the fuse first. Plan later.&rdquo;</p>
        <span class="by">&mdash; Team Chaos</span>
      </div>

      <article class="card c-bul" aria-label="Team Bulwark artwork" hidden>
        <svg class="art-svg" id="artB" viewBox="0 0 400 420" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
          <defs>
            <radialGradient id="bGlow" cx="50%" cy="42%" r="62%">
              <stop offset="0" stop-color="#5b86ff" stop-opacity="0.45"/>
              <stop offset="1" stop-color="#0b1030" stop-opacity="0"/>
            </radialGradient>
            <linearGradient id="shG" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0" stop-color="#6f95ff"/>
              <stop offset="1" stop-color="#1f2f8f"/>
            </linearGradient>
          </defs>
          <rect width="400" height="420" fill="url(#bGlow)"/>
          <image href="images/vi.jpg" x="0" y="0" width="400" height="420" preserveAspectRatio="xMidYMid slice"/>
          <g transform="translate(200 190)" fill="none" stroke="#5b86ff" stroke-opacity="0.5">
            <polygon class="ripple" points="0,-130 113,-65 113,65 0,130 -113,65 -113,-65" stroke-width="2"/>
            <polygon class="ripple" points="0,-130 113,-65 113,65 0,130 -113,65 -113,-65" stroke-width="2"/>
            <polygon class="ripple" points="0,-130 113,-65 113,65 0,130 -113,65 -113,-65" stroke-width="2"/>
          </g>
          <g id="shield" transform="translate(200 188)">
            <path d="M0 -112 L96 -78 L96 20 C96 78 52 112 0 134 C-52 112 -96 78 -96 20 L-96 -78 Z" fill="url(#shG)" stroke="#cfdcff" stroke-width="4" stroke-linejoin="round"/>
            <path d="M0 -84 L66 -60 L66 16 C66 56 36 80 0 98 C-36 80 -66 56 -66 16 L-66 -60 Z" fill="none" stroke="#cfdcff" stroke-opacity="0.6" stroke-width="2"/>
            <path class="draw" d="M-38 -10 L0 -48 L38 -10 M-38 28 L0 -10 L38 28" fill="none" stroke="#fff" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <g fill="none" stroke="#8fb0ff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
            <path class="draw" d="M44 70 L28 70 L28 150 L44 150"/>
            <path class="draw" d="M356 70 L372 70 L372 150 L356 150"/>
            <path class="draw" d="M40 372 C120 346 250 392 360 362"/>
          </g>
          <text x="112" y="352" font-family="'Arcane Nine', Georgia, serif" font-size="52" fill="#cfdcff" transform="rotate(-5 112 352)" class="wob">HOLD!</text>
        </svg>
        <div class="art-label"><b>Team Bulwark</b><span>Nobody gets past.</span></div>
      </article>
    </div>
  </section>

  <section class="sec" id="story" aria-labelledby="h-story">
    <div class="sec-head city-section-head">
      <span class="eyebrow">Piltover above · Zaun below</span>
      <h2 class="h2" id="h-story">Explore the city</h2>
      <p>Move between Topside and the Undercity, then choose a landmark to uncover its story and find your next destination.</p>
    </div>
    <div class="city-map">
      <div class="city-map-toolbar">
        <div class="city-map-toolbar-copy">
          <span class="map-toolbar-kicker">District navigation</span>
          <h3>Choose your route</h3>
        </div>
        <div class="map-city-tabs" role="group" aria-label="Choose a city map">
          <button class="map-city-tab piltover" type="button" data-map-city-choice="piltover" aria-pressed="true"><span>01</span> Topside · Piltover</button>
          <button class="map-city-tab zaun" type="button" data-map-city-choice="zaun" aria-pressed="false"><span>02</span> Undercity · Zaun</button>
        </div>
      </div>
      <div class="city-map-layout">
        <div class="city-map-visual" data-map-city="piltover" role="group" aria-label="Interactive city map">
          <div class="city-map-stamp"><span class="map-live-dot" aria-hidden="true"></span><p class="city-map-label" data-map-label>Topside · Piltover</p><span class="city-map-coordinates" data-map-coordinates>SECTOR 01 · ABOVE THE BRIDGE</span></div>
          <button class="map-landmark" type="button" data-landmark="academy" data-city="piltover" data-title="The Academy" data-lore="Piltover's finest minds gather here to study, debate, and push the limits of hextech." data-spotlight="Character spotlight: Jayce, Viktor, and Heimerdinger" data-href="academy.php" data-link-label="Meet the inventors" aria-pressed="true">The Academy</button>
          <button class="map-landmark" type="button" data-landmark="council" data-city="piltover" data-title="Council Hall" data-lore="From this chamber, the ruling council steers the city's future—and weighs the cost of progress." data-spotlight="Character spotlight: Mel Medarda and Caitlyn Kiramman" data-href="council-hall.php" data-link-label="Meet Piltover's leaders" aria-pressed="false">Council Hall</button>
          <button class="map-landmark" type="button" data-landmark="last-drop" data-city="zaun" data-title="The Last Drop" data-lore="A neighborhood bar and refuge where Zaun's families and fighters find shelter, community, and a place to regroup." data-spotlight="Character spotlight: Vander, Vi, and Jinx" data-href="last-drop.php" data-link-label="Explore the Last Drop" aria-pressed="false" hidden>The Last Drop</button>
          <button class="map-landmark" type="button" data-landmark="stillwater" data-city="zaun" data-title="Stillwater Hold" data-lore="A formidable prison on the edge of Piltover's authority, feared by anyone sent behind its walls." data-spotlight="Shortcut: test your reflexes in the arcade" data-href="stillwater-hold.php" data-link-label="Escape to the arcade" aria-pressed="false" hidden>Stillwater Hold</button>
          <button class="map-landmark" type="button" data-landmark="firelights" data-city="zaun" data-title="Firelight Hideout" data-lore="Hidden among the Undercity's industrial ruins, this refuge protects a community determined to build a better future." data-spotlight="Character spotlight: Ekko and the Firelights" data-href="firelight-hideout.php" data-link-label="Meet the Firelights" aria-pressed="false" hidden>Firelight Hideout</button>
          <p class="city-map-hint">Select a landmark to uncover its story.</p>
        </div>
        <aside class="landmark-detail" aria-live="polite" aria-atomic="true">
          <div class="dossier-heading"><p class="eyebrow">Landmark dossier</p><span class="dossier-index" data-dossier-index>01 / 02</span></div>
          <h4 data-landmark-title>The Academy</h4>
          <p data-landmark-lore>Piltover's finest minds gather here to study, debate, and push the limits of hextech.</p>
          <p class="landmark-spotlight" data-landmark-spotlight>Character spotlight: Jayce, Viktor, and Heimerdinger</p>
          <a class="btn alt" data-landmark-link href="#characters">Meet the inventors <span aria-hidden="true">&#9654;</span></a>
          <p class="dossier-footnote"><span class="map-live-dot" aria-hidden="true"></span> Select a marker to inspect a landmark</p>
        </aside>
      </div>
    </div>
    <section class="dashboard" id="dashboard" aria-labelledby="h-dashboard">
      <div class="sec-head">
        <span class="eyebrow">Your field station</span>
        <h2 class="h2" id="h-dashboard">City dashboard</h2>
        <p>A quick route back into the places, people, and games that make up your Arcane experience.</p>
      </div>
      <div class="dashboard-grid">
        <article class="dashboard-card" data-dashboard-card>
          <span class="dashboard-card-index" aria-hidden="true">01</span>
          <p class="eyebrow">Current allegiance</p>
          <h3 data-dashboard-city>Piltover</h3>
          <p data-dashboard-copy>Topside · City of Progress. Gold, blue, invention, and ambition.</p>
          <button class="btn city-dashboard-switch" type="button">Change city-state</button>
        </article>
        <article class="dashboard-card" data-dashboard-card>
          <span class="dashboard-card-index" aria-hidden="true">02</span>
          <p class="eyebrow">Explore</p>
          <h3>Two cities, many stories</h3>
          <p>Open the interactive map and uncover landmark lore from Topside to the Undercity.</p>
          <a class="btn alt" href="#story">Open the city map <span aria-hidden="true">&#9654;</span></a>
        </article>
        <article class="dashboard-card" data-dashboard-card>
          <span class="dashboard-card-index" aria-hidden="true">03</span>
          <p class="eyebrow">Take a break</p>
          <h3>Four quick games</h3>
          <p>Test your timing and reflexes in the Hextech Spark arcade.</p>
          <a class="btn" href="arcade.php">Enter the arcade <span aria-hidden="true">&#9654;</span></a>
        </article>
      </div>
    </section>
  </section>

  <section class="sec" id="characters" aria-labelledby="h-characters">
    <div class="sec-head">
      <span class="eyebrow">People of the twin cities</span>
      <h2 class="h2" id="h-characters">Meet the characters</h2>
      <p>Explore the people, loyalties, and ambitions that define Zaun and Piltover.</p>
    </div>

    <div class="faction zaun">
      <div class="faction-heading">
        <h3>Zaun</h3>
        <p>The Undercity — inventive, defiant, and fiercely alive.</p>
      </div>
      <div class="character-grid">
        <article class="character-card" data-character="jinx">
          <div class="character-portrait"><img src="images/jinx.jpg" alt="Jinx"></div>
          <div class="character-copy"><p class="eyebrow">The loose cannon</p><h4>Jinx</h4><p>A gifted inventor whose turbulent past and unpredictable choices make her impossible to ignore.</p></div>
        </article>
        <article class="character-card" data-character="vi">
          <div class="character-portrait"><img src="images/vi.jpg" alt="Vi"></div>
          <div class="character-copy"><p class="eyebrow">The brawler</p><h4>Vi</h4><p>A streetwise fighter driven by loyalty, grit, and a determination to protect the people she loves.</p></div>
        </article>
        <article class="character-card" data-character="ekko">
          <div class="character-portrait"><img src="images/ekko.webp" alt="Ekko"></div>
          <div class="character-copy"><p class="eyebrow">The Firelight</p><h4>Ekko</h4><p>A resourceful inventor who leads his people with imagination and a belief in a better future for Zaun.</p></div>
        </article>
        <article class="character-card" data-character="viktor">
          <div class="character-portrait"><img src="images/ViktorCommune.webp" alt="Viktor"></div>
          <div class="character-copy"><p class="eyebrow">The visionary</p><h4>Viktor</h4><p>Born in Zaun and driven to overcome its limits, Viktor pursues progress with extraordinary resolve.</p></div>
        </article>
        <article class="character-card" data-character="silco">
          <div class="character-portrait"><img src="images/silco.webp" alt="Silco"></div>
          <div class="character-copy"><p class="eyebrow">The kingpin</p><h4>Silco</h4><p>A calculating leader whose dream of Zaun's independence is matched by the ruthless costs he is willing to accept.</p></div>
        </article>
        <article class="character-card" data-character="sevika">
          <div class="character-portrait"><img src="images/sevika.webp" alt="Sevika"></div>
          <div class="character-copy"><p class="eyebrow">The enforcer</p><h4>Sevika</h4><p>A formidable undercity fighter whose loyalty is earned through strength, conviction, and action.</p></div>
        </article>
        <article class="character-card" data-character="vander">
          <div class="character-portrait"><img src="images/vander.webp" alt="Vander"></div>
          <div class="character-copy"><p class="eyebrow">The Hound of the Underground</p><h4>Vander</h4><p>A former revolutionary who becomes a guardian to Zaun's children and works to keep the peace.</p></div>
        </article>
        <article class="character-card" data-character="singed">
          <div class="character-portrait"><img src="images/singed.webp" alt="Singed"></div>
          <div class="character-copy"><p class="eyebrow">The alchemist</p><h4>Singed</h4><p>A brilliant but ruthless Zaunite scientist whose experiments push the boundaries of what can be done.</p></div>
        </article>
      </div>
    </div>

    <div class="faction piltover">
      <div class="faction-heading">
        <h3>Piltover</h3>
        <p>The City of Progress — influential, inventive, and divided by change.</p>
      </div>
      <div class="character-grid">
        <article class="character-card" data-character="caitlyn">
          <div class="character-portrait"><img src="images/caitlyn.webp" alt="Caitlyn"></div>
          <div class="character-copy"><p class="eyebrow">The sharp-eyed investigator</p><h4>Caitlyn</h4><p>A principled investigator who follows the evidence, even when it challenges the order she was raised to defend.</p></div>
        </article>
        <article class="character-card" data-character="jayce">
          <div class="character-portrait"><img src="images/jayce.webp" alt="Jayce"></div>
          <div class="character-copy"><p class="eyebrow">The inventor</p><h4>Jayce</h4><p>An ambitious innovator whose discoveries bring influence and responsibility in equal measure.</p></div>
        </article>
        <article class="character-card" data-character="mel">
          <div class="character-portrait"><img src="images/mel.webp" alt="Mel Medarda"></div>
          <div class="character-copy"><p class="eyebrow">The councilor</p><h4>Mel Medarda</h4><p>A perceptive political leader who uses diplomacy and strategy to shape Piltover's future.</p></div>
        </article>
        <article class="character-card" data-character="heimerdinger">
          <div class="character-portrait"><img src="images/heimer.png" alt="Heimerdinger"></div>
          <div class="character-copy"><p class="eyebrow">The professor</p><h4>Heimerdinger</h4><p>A celebrated scholar whose long experience makes him cautious about the risks hidden inside new discoveries.</p></div>
        </article>
        <article class="character-card" data-character="ambessa">
          <div class="character-portrait"><img src="images/ambessa.webp" alt="Ambessa Medarda"></div>
          <div class="character-copy"><p class="eyebrow">The Noxian general</p><h4>Ambessa</h4><p>A formidable military leader who enters Piltover's affairs to protect her family's power and legacy.</p></div>
        </article>
        <article class="character-card" data-character="maddie">
          <div class="character-portrait"><img src="images/maddie.png" alt="Maddie"></div>
          <div class="character-copy"><p class="eyebrow">The enforcer</p><h4>Maddie</h4><p>A young Piltover enforcer who serves in the city's police force amid growing tensions.</p></div>
        </article>
      </div>
    </div>
  </section>

  <section class="sec" id="teams" aria-labelledby="h-teams" hidden>
    <div class="sec-head">
      <span class="eyebrow">The vote</span>
      <h2 class="h2" id="h-teams">Pick your side.</h2>
      <p>One pick each. You can switch sides whenever you like, and the count updates for everyone watching.</p>
    </div>

    <div class="teams">
      <article class="team chaos" id="teamChaos">
        <span class="badge">Your team</span>
        <span class="tag">Team Chaos</span>
        <h3>The Wildcards</h3>
        <p>The chaotic, wildly impulsive thrill-seekers who live entirely in the moment without a single backup plan. They thrive on sudden surprises, loud noises and absolute disorder.</p>
        <ul class="traits"><li>Impulsive</li><li>Loud</li><li>No plan B</li></ul>
        <button class="btn" type="button" data-team="chaos" id="pickChaos">Join Team Chaos</button>
      </article>

      <article class="team bulwark" id="teamBulwark">
        <span class="badge">Your team</span>
        <span class="tag">Team Bulwark</span>
        <h3>The Guardians</h3>
        <p>The fiercely protective brawlers who lead with their fists and a stubborn attitude. Loyal to the end, they charge head-first into any fight to defend their circle.</p>
        <ul class="traits"><li>Protective</li><li>Stubborn</li><li>Head-first</li></ul>
        <button class="btn alt" type="button" data-team="bulwark" id="pickBulwark">Join Team Bulwark</button>
      </article>
    </div>

    <div class="results" id="results" aria-live="polite">
      <div class="lock" id="lock">
        <b>The count is hidden</b>
        <span>Pick a team to reveal how many people chose each side.</span>
      </div>
      <div class="res-top">
        <h3>The count</h3>
        <span id="total">0 people so far</span>
      </div>
      <div class="tally">
        <div class="c"><span class="num" id="numC">0</span><span class="nm">Team Chaos</span></div>
        <div class="b r"><span class="num" id="numB">0</span><span class="nm">Team Bulwark</span></div>
      </div>
      <div class="track" aria-hidden="true"><div id="barC"></div><div id="barB"></div></div>
      <p id="lead">Waiting for the first pick.</p>
      <p id="note"></p>
    </div>
  </section>

  <dialog class="city-dialog" id="city-dialog" aria-labelledby="city-dialog-title">
    <div class="city-dialog-head">
      <div>
        <p class="eyebrow">Two cities. One choice.</p>
        <h2 id="city-dialog-title">Choose your city-state</h2>
        <p class="city-dialog-copy">Pick your allegiance to shape the colors and atmosphere of this experience. You can change sides at any time.</p>
      </div>
      <button class="account-close city-dialog-close" type="button" aria-label="Close city selection" hidden>&times;</button>
    </div>
    <div class="city-options">
      <button class="city-option piltover" type="button" data-city-choice="piltover">
        <strong>Piltover</strong>
        <span>Order, invention, and ambition. Gold and blue, with a polished hextech glow.</span>
      </button>
      <button class="city-option zaun" type="button" data-city-choice="zaun">
        <strong>Zaun</strong>
        <span>Resilience, rebellion, and shimmer. Neon green, deep violet, and industrial edge.</span>
      </button>
    </div>
    <p class="city-dialog-status" role="status" aria-live="polite"></p>
  </dialog>
  </main>

  <footer>
    <p>Unofficial fan project, not affiliated with or endorsed by Riot Games or Fortiche. Arcane, League of Legends, their characters, and related artwork belong to their respective owners.</p>
  </footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
(function () {
  if (!window.gsap) { return; }
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var NS = 'http://www.w3.org/2000/svg';
  function lsGet(k) { try { return window.localStorage.getItem(k); } catch (e) { return null; } }
  function lsSet(k, v) { try { window.localStorage.setItem(k, v); } catch (e) {} }

  /* ================= ambient + burst particles ================= */
  var cv = $('#fx'), ctx = cv.getContext('2d');
  var W = 0, H = 0, P = [], B = [];
  function resize() {
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    W = window.innerWidth; H = window.innerHeight;
    cv.width = W * dpr; cv.height = H * dpr;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }
  function spawn(init) {
    return { x: Math.random() * W, y: init ? Math.random() * H : H + 10, r: Math.random() * 1.6 + 0.4, vy: -(Math.random() * 0.35 + 0.08), vx: (Math.random() - 0.5) * 0.18, a: Math.random() * 0.5 + 0.15, ph: Math.random() * 6.28, c: Math.random() < 0.55 ? '255,106,184' : '120,160,255' };
  }
  resize();
  for (var i = 0; i < Math.round(Math.min(80, Math.max(30, W / 18))); i++) { P.push(spawn(true)); }
  window.addEventListener('resize', resize);
  function frame(t) {
    ctx.clearRect(0, 0, W, H);
    ctx.globalCompositeOperation = 'lighter';
    for (var i = 0; i < P.length; i++) {
      var p = P[i];
      p.y += p.vy; p.x += p.vx + Math.sin(t * 0.0006 + p.ph) * 0.1;
      if (p.y < -10) { P[i] = spawn(false); continue; }
      var al = p.a * (0.7 + 0.3 * Math.sin(t * 0.002 + p.ph));
      ctx.fillStyle = 'rgba(' + p.c + ',' + al.toFixed(3) + ')';
      ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, 6.283); ctx.fill();
    }
    for (var j = B.length - 1; j >= 0; j--) {
      var b = B[j];
      b.x += b.vx; b.y += b.vy; b.vy += 0.06; b.vx *= 0.985; b.life -= 0.016;
      if (b.life <= 0) { B.splice(j, 1); continue; }
      ctx.fillStyle = 'rgba(' + b.c + ',' + Math.max(0, b.life).toFixed(3) + ')';
      ctx.beginPath(); ctx.arc(b.x, b.y, b.r, 0, 6.283); ctx.fill();
    }
  }
  if (reduce) { frame(0); } else { gsap.ticker.add(function (time) { frame(time * 1000); }); }
  function burst(x, y, rgb, n) {
    if (reduce) { return; }
    for (var i = 0; i < (n || 70); i++) {
      var a = Math.random() * 6.283, s = Math.random() * 6 + 1.5;
      B.push({ x: x, y: y, vx: Math.cos(a) * s, vy: Math.sin(a) * s - 1.5, r: Math.random() * 2.6 + 0.8, life: 1 + Math.random() * 0.6, c: rgb });
    }
  }
  var RGB_C = '255,106,184', RGB_B = '120,160,255';

  /* ================= intro + artwork motion ================= */
  $$('.draw').forEach(function (p) {
    var len = p.getTotalLength ? p.getTotalLength() : 0;
    p._len = len;
  });
  if (!reduce) {
    var intro = gsap.timeline({ defaults: { ease: 'power4.out' } });
    intro.from('.hl > span', { yPercent: 110, duration: 1, stagger: 0.12 })
         .from('.c-head .btn, .c-head .fine', { y: 20, opacity: 0, duration: 0.7, stagger: 0.1 }, 0.5)
         .from('.c-chaos', { clipPath: 'inset(0 0 100% 0)', duration: 1.1, ease: 'power3.inOut' }, 0.15)
         .from('.c-bul', { clipPath: 'inset(100% 0 0 0)', duration: 1.1, ease: 'power3.inOut' }, 0.3);

    $$('.draw').forEach(function (p, i) {
      if (!p._len) { return; }
      gsap.fromTo(p, { strokeDasharray: p._len, strokeDashoffset: p._len }, { strokeDashoffset: 0, duration: 0.9, delay: 0.7 + i * 0.12, ease: 'power2.inOut', onComplete: function () { p.style.strokeDasharray = 'none'; } });
    });

    gsap.to('#burst', { rotation: 360, svgOrigin: '200 250', duration: 50, repeat: -1, ease: 'none' });
    gsap.to('#burst polygon', { scale: 1.08, svgOrigin: '0 0', duration: 1.4, yoyo: true, repeat: -1, ease: 'sine.inOut' });
    gsap.to('#bomb', { y: '-=8', duration: 1.8, yoyo: true, repeat: -1, ease: 'sine.inOut' });
    gsap.to('.fusespark', { scale: 1.5, rotation: 90, svgOrigin: '0 0', duration: 0.18, yoyo: true, repeat: -1, ease: 'none' });
    $$('#artC .wob, #artB .wob').forEach(function (t, i) {
      gsap.to(t, { y: '+=4', duration: 1.4 + i * 0.2, yoyo: true, repeat: -1, ease: 'sine.inOut' });
    });
    $$('.ripple').forEach(function (r, i) {
      gsap.fromTo(r, { scale: 0.9, opacity: 0.8, svgOrigin: '0 0' }, { scale: 1.8, opacity: 0, svgOrigin: '0 0', duration: 3.2, repeat: -1, delay: i * 1.05, ease: 'power1.out' });
    });
    gsap.to('#shield', { y: '-=6', duration: 2.2, yoyo: true, repeat: -1, ease: 'sine.inOut' });

    /* quick shake on bomb click */
    $('#artC').addEventListener('click', function (e) {
      gsap.fromTo('#bomb', { rotation: -6, svgOrigin: '0 0' }, { rotation: 0, svgOrigin: '0 0', duration: 0.7, ease: 'elastic.out(1,0.3)' });
      burst(e.clientX, e.clientY, RGB_C, 30);
    });
    $('#artB').addEventListener('click', function (e) {
      gsap.fromTo('#shield', { scale: 1.06, svgOrigin: '0 0' }, { scale: 1, svgOrigin: '0 0', duration: 0.7, ease: 'elastic.out(1,0.35)' });
      burst(e.clientX, e.clientY, RGB_B, 30);
    });
  }

  /* ================= team vote ================= */
  var state = { my: null, counts: { chaos: 0, bulwark: 0 }, snap: false, snapHasMe: false, db: null, uid: null, busy: false, note: '', dbState: 'pending' };
  var stored = lsGet('hs-team');
  if (stored === 'chaos' || stored === 'bulwark') { state.my = stored; }
  var disp = { c: 0, b: 0 };
  var results = $('#results');

  function tally() {
    var c = state.counts.chaos, b = state.counts.bulwark;
    if (state.my && !state.snapHasMe) { if (state.my === 'chaos') { c += 1; } else { b += 1; } }
    return { c: c, b: b };
  }
  function plural(n, w) { return n + ' ' + w + (n === 1 ? '' : 's'); }
  function paint() {
    var c = Math.round(disp.c), b = Math.round(disp.b), t = c + b;
    $('#numC').textContent = c;
    $('#numB').textContent = b;
    var pc = t ? (disp.c / (disp.c + disp.b)) * 100 : 50;
    $('#barC').style.width = pc + '%';
    $('#barB').style.width = (100 - pc) + '%';
  }
  function renderCards() {
    $('#teamChaos').classList.toggle('mine', state.my === 'chaos');
    $('#teamBulwark').classList.toggle('mine', state.my === 'bulwark');
    var bc = $('#pickChaos'), bb = $('#pickBulwark');
    bc.textContent = state.my === 'chaos' ? 'You are on Team Chaos' : (state.my ? 'Switch to Team Chaos' : 'Join Team Chaos');
    bb.textContent = state.my === 'bulwark' ? 'You are on Team Bulwark' : (state.my ? 'Switch to Team Bulwark' : 'Join Team Bulwark');
    bc.disabled = state.my === 'chaos';
    bb.disabled = state.my === 'bulwark';
  }
  function render() {
    renderCards();
    var open = !!state.my;
    var wasOpen = results.classList.contains('open');
    results.classList.toggle('open', open);
    var t = tally();
    var total = t.c + t.b;
    $('#total').textContent = open ? plural(total, 'person') + ' so far' : 'Hidden until you pick';
    if (open) {
      if (!wasOpen && !reduce) {
        gsap.from('.tally, .track, #lead', { y: 24, opacity: 0, duration: 0.8, stagger: 0.12, ease: 'power3.out' });
      }
      gsap.to(disp, { c: t.c, b: t.b, duration: reduce ? 0 : 1.1, ease: 'power3.out', onUpdate: paint, onComplete: paint, overwrite: true });
      var lead;
      if (t.c === t.b) { lead = total === 1 ? 'You are the first one in. Share the page and watch the bar move.' : 'Dead even. Someone has to break the tie.'; }
      else if (t.c > t.b) { lead = 'Team Chaos leads by ' + plural(t.c - t.b, 'vote') + '.'; }
      else { lead = 'Team Bulwark leads by ' + plural(t.b - t.c, 'vote') + '.'; }
      $('#lead').textContent = lead;
    } else {
      disp.c = 0; disp.b = 0; paint();
      $('#lead').textContent = 'Waiting for your pick.';
    }
    var note = state.note;
    if (!note && state.dbState === 'none') { note = 'Shared counting is not available in this view, so only your own pick is counted.'; }
    if (!note && state.dbState === 'slow') { note = 'The shared count is slow to answer. The numbers may be out of date.'; }
    $('#note').textContent = note;
  }

  function toggleBtns(dis) { $('#pickChaos').disabled = dis || state.my === 'chaos'; $('#pickBulwark').disabled = dis || state.my === 'bulwark'; }
  async function pick(team, ev) {
    if (state.busy || state.my === team) { return; }
    state.busy = true; state.note = '';
    state.my = team; lsSet('hs-team', team);
    var r = ev && ev.currentTarget ? ev.currentTarget.getBoundingClientRect() : null;
    if (r) { burst(r.left + r.width / 2, r.top + r.height / 2, team === 'chaos' ? RGB_C : RGB_B, 90); }
    render();
    if (!reduce) {
      var el = team === 'chaos' ? '#teamChaos' : '#teamBulwark';
      gsap.fromTo(el, { scale: 0.98 }, { scale: 1, duration: 0.8, ease: 'elastic.out(1,0.4)' });
    }
    if (state.db && state.uid) {
      try { await state.db.doc('picks/' + state.uid).set({ team: team, at: Date.now() }); }
      catch (e) { state.note = 'This link is view-only, so your pick is saved on this device and is not in the shared count.'; }
    } else if (!state.db) { state.dbState = 'none'; }
    state.busy = false;
    render();
  }
  $('#pickChaos').addEventListener('click', function (e) { pick('chaos', e); });
  $('#pickBulwark').addEventListener('click', function (e) { pick('bulwark', e); });
  render();

  (async function initDb() {
    var slow = setTimeout(function () { if (!state.snap) { state.dbState = 'slow'; render(); } }, 10000);
    try {
      var cl = window.claude;
      if (!cl || !cl.use) { throw new Error('none'); }
      var db = await cl.use('db');
      var user = await cl.use('user');
      if (!db) { clearTimeout(slow); state.dbState = 'none'; render(); return; }
      state.db = db;
      state.uid = user && user.id ? await user.id() : null;
      db.collection('picks').onSnapshot(function (snap) {
        var c = 0, b = 0, me = false, mine = null;
        snap.docs.forEach(function (d) {
          var x = d.data() || {};
          if (x.team === 'chaos') { c++; } else if (x.team === 'bulwark') { b++; }
          if (state.uid && d.id === state.uid) { me = true; mine = x.team; }
        });
        state.counts = { chaos: c, bulwark: b };
        state.snapHasMe = me;
        if (me && (mine === 'chaos' || mine === 'bulwark')) { state.my = mine; lsSet('hs-team', mine); }
        if (!snap.metadata.fromCache) { state.snap = true; clearTimeout(slow); if (state.dbState === 'slow') { state.dbState = 'ok'; } }
        state.dbState = state.dbState === 'slow' && !state.snap ? 'slow' : 'ok';
        render();
      }, function () { clearTimeout(slow); state.dbState = 'none'; render(); });
    } catch (e) { clearTimeout(slow); state.dbState = 'none'; render(); }
  })();

})();
</script>
<script>
(function () {
  var list = document.querySelector('.hero-media-list');
  var drag = null;
  var suppressClick = false;
  var suppressClickTimer = 0;
  var moveFrame = 0;
  var inertiaFrame = 0;
  var pendingX = 0;
  var velocity = 0;
  var lastX = 0;
  var lastTime = 0;

  list.addEventListener('pointerdown', function (event) {
    if (event.pointerType !== 'mouse' || event.button !== 0) {
      return;
    }
    if (inertiaFrame) {
      cancelAnimationFrame(inertiaFrame);
      inertiaFrame = 0;
    }
    clearTimeout(suppressClickTimer);
    suppressClick = false;
    drag = {
      startX: event.clientX,
      scrollLeft: list.scrollLeft,
      pointerId: event.pointerId,
      moved: false
    };
    lastX = event.clientX;
    lastTime = performance.now();
    velocity = 0;
    window.addEventListener('pointermove', move);
    window.addEventListener('pointerup', end);
    window.addEventListener('pointercancel', end);
  });

  function move(event) {
    if (!drag || event.pointerId !== drag.pointerId) {
      return;
    }
    var distance = event.clientX - drag.startX;
    if (!drag.moved && Math.abs(distance) < 5) {
      return;
    }
    drag.moved = true;
    list.classList.add('is-dragging');
    pendingX = event.clientX;
    var now = performance.now();
    var elapsed = Math.max(1, now - lastTime);
    velocity = -(event.clientX - lastX) / elapsed;
    lastX = event.clientX;
    lastTime = now;
    if (!moveFrame) {
      moveFrame = requestAnimationFrame(applyMove);
    }
    event.preventDefault();
  }

  function applyMove() {
    moveFrame = 0;
    if (drag && drag.moved) {
      list.scrollLeft = drag.scrollLeft + drag.startX - pendingX;
    }
  }

  function end(event) {
    if (!drag || (event && event.pointerId !== drag.pointerId)) {
      return;
    }
    if (moveFrame) {
      cancelAnimationFrame(moveFrame);
      moveFrame = 0;
      applyMove();
    }
    suppressClick = drag.moved;
    if (suppressClick) {
      suppressClickTimer = window.setTimeout(function () {
        suppressClick = false;
      }, 400);
    }
    var shouldGlide = drag.moved;
    drag = null;
    list.classList.remove('is-dragging');
    window.removeEventListener('pointermove', move);
    window.removeEventListener('pointerup', end);
    window.removeEventListener('pointercancel', end);
    if (shouldGlide) {
      lastTime = performance.now();
      inertiaFrame = requestAnimationFrame(glide);
    }
  }

  function glide(now) {
    var elapsed = Math.min(32, now - lastTime);
    lastTime = now;
    list.scrollLeft += velocity * elapsed;
    velocity *= Math.pow(0.92, elapsed / 16.67);
    if (Math.abs(velocity) > 0.015 && list.scrollLeft > 0 && list.scrollLeft < list.scrollWidth - list.clientWidth) {
      inertiaFrame = requestAnimationFrame(glide);
    } else {
      inertiaFrame = 0;
    }
  }

  list.addEventListener('click', function (event) {
    if (!suppressClick) {
      return;
    }
    event.preventDefault();
    event.stopPropagation();
    suppressClick = false;
    clearTimeout(suppressClickTimer);
  }, true);
})();
</script>
<script>
(function () {
  var video = document.querySelector('.hero-video');
  var toggle = document.querySelector('.hero-video-toggle');
  var label = toggle.querySelector('.sound-label');
  var icon = toggle.querySelector('.sound-icon');

  toggle.addEventListener('click', function () {
    video.muted = !video.muted;
    var isMuted = video.muted;
    toggle.setAttribute('aria-pressed', String(!isMuted));
    toggle.setAttribute('aria-label', isMuted ? 'Unmute hero video' : 'Mute hero video');
    label.textContent = isMuted ? 'Unmute' : 'Mute';
    icon.textContent = isMuted ? '♫' : '♪';
  });
})();
</script>
<script>
(function () {
  var dialog = document.getElementById('city-dialog');
  var status = dialog.querySelector('.city-dialog-status');
  var closeButton = dialog.querySelector('.city-dialog-close');
  var switchButton = document.querySelector('.city-switch');
  var mapVisual = document.querySelector('.city-map-visual');
  var mapLabel = document.querySelector('[data-map-label]');
  var mapTabs = document.querySelectorAll('[data-map-city-choice]');
  var landmarks = document.querySelectorAll('.map-landmark');
  var dashboardCity = document.querySelector('[data-dashboard-city]');
  var dashboardCopy = document.querySelector('[data-dashboard-copy]');
  var landmarkTitle = document.querySelector('[data-landmark-title]');
  var landmarkLore = document.querySelector('[data-landmark-lore]');
  var landmarkSpotlight = document.querySelector('[data-landmark-spotlight]');
  var landmarkLink = document.querySelector('[data-landmark-link]');

  function selectLandmark(button) {
    landmarks.forEach(function (landmark) {
      landmark.setAttribute('aria-pressed', String(landmark === button));
    });
    landmarkTitle.textContent = button.dataset.title;
    landmarkLore.textContent = button.dataset.lore;
    landmarkSpotlight.textContent = button.dataset.spotlight;
    landmarkLink.href = button.dataset.href;
    landmarkLink.innerHTML = button.dataset.linkLabel + ' <span aria-hidden="true">&#9654;</span>';
    var districtLandmarks = Array.prototype.filter.call(landmarks, function (landmark) {
      return landmark.dataset.city === button.dataset.city;
    });
    var landmarkPosition = districtLandmarks.indexOf(button) + 1;
    document.querySelector('[data-dossier-index]').textContent = String(landmarkPosition).padStart(2, '0') + ' / ' + String(districtLandmarks.length).padStart(2, '0');
    document.dispatchEvent(new CustomEvent('arcane:landmark-selected', { detail: { landmark: button } }));
  }

  function setMapCity(city) {
    mapVisual.dataset.mapCity = city;
    mapLabel.textContent = city === 'piltover' ? 'Topside · Piltover' : 'Undercity · Zaun';
    document.querySelector('[data-map-coordinates]').textContent = city === 'piltover' ? 'SECTOR 01 · ABOVE THE BRIDGE' : 'SECTOR 02 · BELOW THE BRIDGE';
    mapTabs.forEach(function (tab) {
      var isSelected = tab.dataset.mapCityChoice === city;
      tab.setAttribute('aria-pressed', String(isSelected));
    });
    var activeLandmarks = Array.prototype.filter.call(landmarks, function (landmark) {
      var isVisible = landmark.dataset.city === city;
      landmark.hidden = !isVisible;
      return isVisible;
    });
    selectLandmark(activeLandmarks[0]);
    document.dispatchEvent(new CustomEvent('arcane:map-city-changed', { detail: { city: city } }));
  }

  function applyCity(city) {
    document.body.dataset.city = city;
    document.body.dataset.flowStep = 'landing';
    switchButton.textContent = 'City: ' + (city === 'piltover' ? 'Piltover' : 'Zaun');
    switchButton.setAttribute('aria-label', 'Change city-state, currently ' + (city === 'piltover' ? 'Piltover' : 'Zaun'));
    closeButton.hidden = false;
    dashboardCity.textContent = city === 'piltover' ? 'Piltover' : 'Zaun';
    dashboardCopy.textContent = city === 'piltover'
      ? 'Topside · City of Progress. Gold, blue, invention, and ambition.'
      : 'Undercity · City of ingenuity. Neon green, deep violet, and resilience.';
    setMapCity(city);
  }

  var selectedCity = document.body.dataset.city || null;

  if (selectedCity === 'piltover' || selectedCity === 'zaun') {
    applyCity(selectedCity);
  }

  switchButton.addEventListener('click', function () {
    status.textContent = '';
    document.body.dataset.flowStep = 'city';
    dialog.showModal();
    dialog.querySelector('[data-city-choice="' + (document.body.dataset.city || 'piltover') + '"]').focus();
  });

  dialog.querySelectorAll('[data-city-choice]').forEach(function (button) {
    button.addEventListener('click', function () {
      var city = button.dataset.cityChoice;
      status.textContent = '';
      fetch('city.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'fetch',
          'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
        },
        body: 'city=' + encodeURIComponent(city)
      }).then(function (response) {
        if (!response.ok) {
          return response.json().then(function (result) {
            throw new Error(result.message || 'Server returned HTTP ' + response.status);
          });
        }
        applyCity(city);
        dialog.close();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }).catch(function (error) {
        status.textContent = error.message || 'Could not save your city-state. Please try again.';
        console.error('Unable to save the city-state preference.', error);
      });
    });
  });

  mapTabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      setMapCity(tab.dataset.mapCityChoice);
    });
  });

  landmarks.forEach(function (landmark) {
    landmark.addEventListener('click', function () {
      selectLandmark(landmark);
    });
  });

  document.querySelector('.city-dashboard-switch').addEventListener('click', function () {
    switchButton.click();
  });

  closeButton.addEventListener('click', function () {
    dialog.close();
    document.body.dataset.flowStep = 'landing';
  });

  dialog.addEventListener('cancel', function (event) {
    if (document.body.dataset.flowStep === 'city') {
      event.preventDefault();
    }
  });

  dialog.addEventListener('click', function (event) {
    if (event.target === dialog && document.body.dataset.flowStep !== 'city') {
      dialog.close();
    }
  });
})();
</script>
<script src="city-experience.js"></script>


</body></html>
