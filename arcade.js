(function () {
  if (!window.gsap) {
    console.error('Arcade games could not start because GSAP did not load.');
    return;
  }
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (selector, root) { return (root || document).querySelector(selector); };
  var $$ = function (selector, root) { return Array.prototype.slice.call((root || document).querySelectorAll(selector)); };
  var NS = 'http://www.w3.org/2000/svg';
  var RGB_B = '120,160,255';
  function lsGet(key) { try { return window.localStorage.getItem(key); } catch (error) { return null; } }
  function lsSet(key, value) { try { window.localStorage.setItem(key, value); } catch (error) { console.error('Unable to save arcade score.', error); } }
  function burst(x, y, rgb, count) {
    if (reduce) { return; }
    for (var i = 0; i < (count || 24); i++) {
      var particle = document.createElement('span');
      var angle = Math.random() * Math.PI * 2;
      var distance = 24 + Math.random() * 48;
      particle.className = 'spark arcade-spark';
      particle.style.left = x + 'px';
      particle.style.top = y + 'px';
      particle.style.background = 'rgba(' + rgb + ', 1)';
      document.body.appendChild(particle);
      gsap.to(particle, { x: Math.cos(angle) * distance, y: Math.sin(angle) * distance, opacity: 0, duration: 0.65, onComplete: function () { this.targets()[0].remove(); } });
    }
  }  /* ================= arcade ================= */
  var arena = $('#arena');
  var hud = { title: $('#gTitle'), rules: $('#gRules'), time: $('#gTime'), label: $('#gStatLabel'), score: $('#gScore'), best: $('#gBest'), info: $('#gInfo'), start: $('#gStart') };
  var cur = null, active = null;
  function best(k) { return parseInt(lsGet('hs-best-' + k) || '0', 10) || 0; }
  function setBest(k, v) { if (v > best(k)) { lsSet('hs-best-' + k, String(v)); hud.best.textContent = v; return true; } return false; }
  function setScore(v) { hud.score.textContent = v; }
  function showMsg(title, sub) {
    arena.innerHTML = '<div class="msg"><b>' + title + '</b><span>' + sub + '</span></div>';
  }

  var games = {
    fuse: { title: 'Fuse Frenzy', rules: 'Tap each bomb before its ring shrinks away. Three misses and the lights go out. Chain pops for a bigger multiplier.', label: 'Time', idle: ['Ready?', 'Bombs pop up anywhere. Be quick.'] },
    guard: { title: 'Perfect Guard', rules: 'A ring closes in on the shield. Tap when it lines up with the blue circle. Ten rounds, each one faster. Space also works.', label: 'Round', idle: ['Steady hands', 'Tap when the rings meet.'] },
    echo: { title: 'Hex Echo', rules: 'Watch the hexes light up, then repeat the order. Each round adds one more. One slip ends the run.', label: 'Round', idle: ['Watch closely', 'Then repeat the pattern.'] },
    rush: { title: 'Gold Rush', rules: 'Grab the gold hexes as they appear and leave the grey decoys alone. Thirty seconds. Decoys cost you points.', label: 'Time', idle: ['Hands ready', 'Gold is good. Grey is bad.'] }
  };

  function stopActive() {
    if (active && active.stop) { active.stop(); }
    active = null;
    gsap.killTweensOf(arena.querySelectorAll('*'));
  }
  function selectGame(k) {
    stopActive();
    cur = k;
    $$('.tab').forEach(function (t) { t.setAttribute('aria-pressed', t.getAttribute('data-g') === k ? 'true' : 'false'); });
    var g = games[k];
    hud.title.textContent = g.title; hud.rules.textContent = g.rules; hud.label.textContent = g.label;
    hud.time.textContent = k === 'fuse' ? '20' : k === 'rush' ? '30' : '0';
    hud.best.textContent = best(k); setScore(0);
    hud.info.textContent = ''; hud.start.textContent = 'Start'; hud.start.disabled = false;
    showMsg(g.idle[0], g.idle[1]);
  }
  $$('.tab').forEach(function (t) { t.addEventListener('click', function () { selectGame(t.getAttribute('data-g')); }); });
  hud.start.addEventListener('click', function () {
    stopActive();
    hud.info.textContent = ''; setScore(0);
    if (cur === 'fuse') { active = fuse(); }
    else if (cur === 'guard') { active = guard(); }
    else if (cur === 'echo') { active = echo(); }
    else { active = rush(); }
  });
  function finish(k, score, text) {
    var isBest = setBest(k, score);
    hud.info.textContent = text + (isBest && score > 0 ? ' New best!' : '');
    hud.start.textContent = 'Play again'; hud.start.disabled = false;
    active = null;
  }

  /* ---- Fuse Frenzy ---- */
  function fuse() {
    arena.innerHTML = '';
    var score = 0, lives = 3, combo = 0, over = false, elapsed = 0, timers = [];
    var bombImages = ['images/bomb1.jpg', 'images/bomb2.jpg', 'images/bomb3.jpg'], nextBombImage = 0;
    var clock = { t: 20 };
    hud.start.disabled = true; hud.start.textContent = 'Playing';
    function lifeText() { var s = ''; for (var i = 0; i < 3; i++) { s += i < lives ? '♥ ' : '♡ '; } hud.info.textContent = s; hud.info.className = 'ginfo hearts'; }
    lifeText();
    var timerTween = gsap.to(clock, { t: 0, duration: 20, ease: 'none', onUpdate: function () { hud.time.textContent = Math.ceil(clock.t); elapsed = 20 - clock.t; }, onComplete: function () { end('Time!'); } });
    function sparks(x, y, color) {
      for (var i = 0; i < 14; i++) {
        var s = document.createElement('span'); s.className = 'spark'; s.style.left = x + 'px'; s.style.top = y + 'px'; if (color) { s.style.background = color; }
        if (!color) { s.style.background = ['#ff6ab8', '#ffd76a', '#8fb0ff'][i % 3]; }
        arena.appendChild(s);
        var a = Math.random() * 6.283, d = 34 + Math.random() * 66;
        gsap.to(s, { x: Math.cos(a) * d, y: Math.sin(a) * d, scale: Math.random() * 1.5 + 0.5, opacity: 0, rotation: Math.random() * 180, duration: 0.62, ease: 'power2.out', onComplete: function () { this.targets()[0].remove(); } });
      }
    }
    function hitEffect(x, y, points, chain) {
      var ring = document.createElement('span');
      ring.className = 'bomb-impact';
      ring.style.left = x + 'px'; ring.style.top = y + 'px';
      arena.appendChild(ring);
      gsap.fromTo(ring, { scale: 0.15, opacity: 1 }, { scale: 2.8, opacity: 0, duration: 0.42, ease: 'power2.out', onComplete: function () { ring.remove(); } });
      sparks(x, y);
      var label = document.createElement('span');
      label.className = 'bomb-score-pop';
      label.textContent = chain > 1 ? '+' + points + '  x' + chain : '+' + points;
      label.style.left = x + 'px'; label.style.top = (y - 28) + 'px';
      arena.appendChild(label);
      gsap.fromTo(label, { y: 8, scale: 0.65, opacity: 0 }, { y: -42, scale: 1, opacity: 1, duration: 0.16, ease: 'back.out(2)' });
      gsap.to(label, { y: -66, opacity: 0, delay: 0.42, duration: 0.32, ease: 'power2.in', onComplete: function () { label.remove(); } });
    }
    function spawnBomb() {
      if (over) { return; }
      var w = arena.clientWidth, h = arena.clientHeight;
      var x = 44 + Math.random() * (w - 88), y = 44 + Math.random() * (h - 88);
      var el = document.createElement('button');
      el.type = 'button'; el.className = 'bomb'; el.setAttribute('aria-label', 'Pop bomb');
      el.style.left = x + 'px'; el.style.top = y + 'px';
      var image = document.createElement('img');
      image.className = 'bomb-image';
      image.src = bombImages[nextBombImage++ % bombImages.length];
      image.alt = '';
      image.draggable = false;
      el.appendChild(image);
      var ring = document.createElement('span');
      ring.className = 'b-ring';
      el.appendChild(ring);
      arena.appendChild(el);
      var life = Math.max(0.75, 1.55 - elapsed * 0.04);
      gsap.fromTo(el, { scale: 0 }, { scale: 1, duration: 0.25, ease: 'back.out(2.4)' });
      var done = false;
      var fuseTw = gsap.fromTo(ring, { scale: 1.9, opacity: 0.9 }, { scale: 0.55, opacity: 1, duration: life, ease: 'none', onComplete: function () { if (!done) { done = true; miss(el, x, y); } } });
      function hit(ev) {
        if (done || over) { return; }
        done = true; fuseTw.kill();
        combo++;
        var points = 10 * (1 + Math.floor(combo / 5));
        score += points; setScore(score);
        hitEffect(x, y, points, combo);
        gsap.timeline({ onComplete: function () { el.remove(); } })
          .to(el, { scale: 1.38, rotation: -12, duration: 0.12, ease: 'back.out(2)' })
          .to(el, { scale: 0, rotation: 28, opacity: 0, duration: 0.2, ease: 'power2.in' });
      }
      el.addEventListener('pointerdown', function (e) { e.preventDefault(); hit(e); });
    }
    function miss(el, x, y) {
      combo = 0; lives--; lifeText();
      sparks(x, y, '#ff3b30');
      gsap.to(el.querySelector('.bomb-image'), { filter: 'brightness(.55) sepia(1) saturate(8) hue-rotate(320deg)', duration: 0.1 });
      gsap.to(el, { scale: 2.4, opacity: 0, duration: 0.3, ease: 'power2.out', onComplete: function () { el.remove(); } });
      gsap.fromTo(arena, { x: -6 }, { x: 0, duration: 0.4, ease: 'elastic.out(1,0.3)' });
      if (lives <= 0) { end('Lights out.'); }
    }
    function loop() {
      if (over) { return; }
      spawnBomb();
      var d = Math.max(0.32, 0.85 - elapsed * 0.026);
      timers.push(gsap.delayedCall(d, loop));
    }
    timers.push(gsap.delayedCall(0.4, loop));
    function end(why) {
      if (over) { return; }
      over = true; timerTween.kill();
      timers.forEach(function (t) { t.kill(); });
      $$('.bomb', arena).forEach(function (b) { gsap.killTweensOf(b.querySelector('.b-ring')); b.remove(); });
      hud.info.className = 'ginfo';
      showMsg(why, score + ' points');
      finish('fuse', score, 'You scored ' + score + '.');
    }
    return { stop: function () { over = true; timerTween.kill(); timers.forEach(function (t) { t.kill(); }); hud.info.className = 'ginfo'; } };
  }

  /* ---- Perfect Guard ---- */
  function guard() {
    var TARGET = 52, ROUNDS = 10, round = 0, total = 0, over = false, ringTw = null, waiting = false, timers = [];
    arena.innerHTML = '';
    var svg = document.createElementNS(NS, 'svg');
    svg.setAttribute('viewBox', '0 0 400 340'); svg.setAttribute('class', 'guard-svg'); svg.setAttribute('role', 'button'); svg.setAttribute('aria-label', 'Tap when the ring meets the circle');
    svg.innerHTML = '<defs><radialGradient id="anomalyGlow"><stop offset="0" stop-color="#f8ffff" stop-opacity=".98"/><stop offset=".24" stop-color="#76f5ff" stop-opacity=".88"/><stop offset=".55" stop-color="#e7a8ff" stop-opacity=".7"/><stop offset=".82" stop-color="#ff5eae" stop-opacity=".48"/><stop offset="1" stop-color="#6deaff" stop-opacity="0"/></radialGradient><linearGradient id="anomalyRift" x1="0" y1="0" x2="1" y2="1"><stop stop-color="#ff3d9a"/><stop offset=".48" stop-color="#fff5fb"/><stop offset="1" stop-color="#44eaff"/></linearGradient><filter id="anomalyBlur"><feGaussianBlur stdDeviation="11"/></filter><filter id="anomalyEdgeGlow" x="-60%" y="-60%" width="220%" height="220%"><feGaussianBlur stdDeviation="4" result="blur"/><feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge></filter></defs><circle class="anomaly-glow" cx="200" cy="170" r="137" fill="url(#anomalyGlow)" filter="url(#anomalyBlur)"/><g id="gAnomalyScene"><path d="M198 31 C219 24 226 39 243 42 C261 45 274 34 286 48 C298 61 288 76 306 88 C325 101 339 103 333 123 C328 142 347 154 337 172 C328 190 342 207 327 221 C312 236 319 251 298 260 C278 269 278 289 256 289 C235 288 224 308 205 298 C186 289 172 306 155 292 C137 278 120 284 112 265 C104 245 84 247 80 226 C76 206 57 194 66 176 C75 157 57 139 70 123 C82 106 75 87 93 76 C111 65 111 47 131 45 C151 44 164 30 180 38 Z" fill="url(#anomalyGlow)" fill-opacity=".72" stroke="#bafcff" stroke-opacity=".82" stroke-width="2" filter="url(#anomalyEdgeGlow)"/><path d="M74 151 C117 132 130 106 164 112 C186 116 192 147 214 153 C239 160 258 134 294 119 M72 190 C111 170 132 184 154 203 C177 223 194 230 220 213 C246 195 274 194 328 215 M125 60 C147 89 144 106 132 127 M268 68 C244 92 250 111 276 135 M104 247 C132 218 150 220 172 243 M291 257 C265 233 262 218 285 198" fill="none" stroke="url(#anomalyRift)" stroke-width="5" stroke-linecap="round" stroke-opacity=".9" filter="url(#anomalyEdgeGlow)"/><path d="M88 104 C119 118 130 143 154 146 M306 91 C277 110 276 126 262 143 M82 222 C115 207 130 196 143 178 M316 238 C285 218 270 207 254 186" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-opacity=".8"/><g class="anomaly-voids" fill="#080916"><ellipse cx="117" cy="82" rx="10" ry="17" transform="rotate(-35 117 82)"/><ellipse cx="165" cy="55" rx="7" ry="12" transform="rotate(18 165 55)"/><ellipse cx="229" cy="49" rx="9" ry="14" transform="rotate(-24 229 49)"/><ellipse cx="298" cy="74" rx="13" ry="8" transform="rotate(31 298 74)"/><ellipse cx="323" cy="130" rx="8" ry="15" transform="rotate(12 323 130)"/><ellipse cx="316" cy="188" rx="12" ry="7" transform="rotate(-28 316 188)"/><ellipse cx="283" cy="263" rx="9" ry="15" transform="rotate(35 283 263)"/><ellipse cx="224" cy="286" rx="13" ry="8" transform="rotate(-12 224 286)"/><ellipse cx="153" cy="275" rx="8" ry="14" transform="rotate(25 153 275)"/><ellipse cx="86" cy="218" rx="12" ry="8" transform="rotate(-18 86 218)"/><ellipse cx="79" cy="150" rx="7" ry="13" transform="rotate(24 79 150)"/><ellipse cx="103" cy="126" rx="5" ry="8"/><ellipse cx="270" cy="97" rx="6" ry="10" transform="rotate(-40 270 97)"/></g></g><circle cx="200" cy="170" r="' + TARGET + '" fill="rgba(91,134,255,0.1)" stroke="#b5faff" stroke-width="3"/><image id="gHexcore" href="images/hexcore.webp" x="142" y="112" width="116" height="116" preserveAspectRatio="xMidYMid meet"/><circle id="gRing" cx="200" cy="170" r="190" fill="none" stroke="#fff" stroke-width="5"/><text id="gFb" x="200" y="64" text-anchor="middle" font-family="\'Arcane Nine\', Georgia, serif" font-size="30" font-weight="800" fill="#fff" opacity="0"></text>';
    arena.appendChild(svg);
    var ring = svg.querySelector('#gRing'), fb = svg.querySelector('#gFb'), hexcore = svg.querySelector('#gHexcore');
    if (!reduce) {
      gsap.to(svg.querySelector('#gAnomalyScene'), { rotation: 8, svgOrigin: '200 170', duration: 4, repeat: -1, yoyo: true, ease: 'sine.inOut' });
      gsap.to(svg.querySelector('.anomaly-glow'), { opacity: 0.7, scale: 1.12, svgOrigin: '200 170', duration: 1.7, repeat: -1, yoyo: true, ease: 'sine.inOut' });
      gsap.to(svg.querySelector('.anomaly-voids'), { rotation: -12, svgOrigin: '200 170', duration: 6, repeat: -1, yoyo: true, ease: 'sine.inOut' });
      gsap.to(hexcore, { scale: 1.06, svgOrigin: '200 170', duration: 1.2, repeat: -1, yoyo: true, ease: 'sine.inOut' });
    }
    var obj = { r: 190 };
    hud.start.disabled = true; hud.start.textContent = 'Playing';
    function feedback(text, color) {
      fb.textContent = text; fb.setAttribute('fill', color);
      gsap.fromTo(fb, { opacity: 1, y: 0 }, { opacity: 0, y: -14, duration: 0.9, ease: 'power2.out' });
    }
    function next() {
      if (over) { return; }
      if (round >= ROUNDS) { end(); return; }
      round++; hud.time.textContent = round + '/' + ROUNDS;
      obj.r = 190; ring.setAttribute('r', 190); ring.setAttribute('stroke', '#fff');
      var dur = Math.max(0.75, 1.7 - round * 0.09);
      waiting = true;
      ringTw = gsap.to(obj, { r: 0, duration: dur, ease: 'none', onUpdate: function () { ring.setAttribute('r', obj.r.toFixed(1)); }, onComplete: function () { if (waiting) { waiting = false; feedback('TOO LATE', '#ff6ab8'); timers.push(gsap.delayedCall(0.8, next)); } } });
    }
    function tap() {
      if (!waiting || over) { return; }
      waiting = false; ringTw.kill();
      var diff = Math.abs(obj.r - TARGET);
      var pts = Math.max(0, Math.round(100 - diff * 1.6));
      total += pts; setScore(total);
      var label = diff <= 4 ? 'PERFECT' : diff <= 14 ? 'GOOD' : diff <= 32 ? 'OK' : 'MISS';
      var col = diff <= 4 ? '#ffd76a' : diff <= 14 ? '#8fb0ff' : diff <= 32 ? '#fff' : '#ff6ab8';
      feedback(label + ' +' + pts, col);
      ring.setAttribute('stroke', col);
      if (diff <= 14) { gsap.fromTo(hexcore, { scale: 1.28, svgOrigin: '200 170', filter: 'brightness(2)' }, { scale: 1, svgOrigin: '200 170', filter: 'brightness(1)', duration: 0.55, ease: 'elastic.out(1,0.4)' }); var r = arena.getBoundingClientRect(); burst(r.left + r.width / 2, r.top + r.height / 2, RGB_B, 24); }
      timers.push(gsap.delayedCall(0.75, next));
    }
    svg.addEventListener('pointerdown', function (e) { e.preventDefault(); tap(); });
    function key(e) { if (e.code === 'Space' || e.key === 'Enter') { if (document.activeElement && document.activeElement.tagName === 'BUTTON') { return; } e.preventDefault(); tap(); } }
    window.addEventListener('keydown', key);
    function end() {
      over = true; window.removeEventListener('keydown', key);
      var rank = total >= 900 ? 'Unbreakable wall' : total >= 700 ? 'Solid guard' : total >= 450 ? 'Getting there' : 'Needs practice';
      showMsg(rank, total + ' of 1000');
      finish('guard', total, 'You scored ' + total + ' out of 1000.');
    }
    timers.push(gsap.delayedCall(0.5, next));
    return { stop: function () { over = true; waiting = false; if (ringTw) { ringTw.kill(); } timers.forEach(function (t) { t.kill(); }); window.removeEventListener('keydown', key); } };
  }

  /* ---- Hex Echo ---- */
  function echo() {
    var seq = [], pos = 0, accepting = false, over = false, timers = [];
    arena.innerHTML = '<div class="pads"></div>';
    var wrap = arena.firstChild;
    var pads = [0, 1, 2, 3].map(function (i) {
      var b = document.createElement('button'); b.type = 'button'; b.className = 'pad'; b.setAttribute('data-i', i); b.disabled = true;
      b.setAttribute('aria-label', 'Hex ' + (i + 1));
      b.innerHTML = '<span class="pad-face"><span class="pad-circuit" aria-hidden="true"><svg viewBox="0 0 128 140"><path d="M64 13 107 37v48l-43 25-43-25V37z"/><path d="M64 25v17m0 56V81M34 43l15 9m45 27-15-9M94 43l-15 9m-45 27 15-9M38 70h12m28 0h12"/><circle cx="64" cy="21" r="2"/><circle cx="27" cy="42" r="2"/><circle cx="101" cy="42" r="2"/><circle cx="27" cy="82" r="2"/><circle cx="101" cy="82" r="2"/><circle cx="64" cy="101" r="2"/></svg></span><span class="pad-core"></span><span class="pad-rune" aria-hidden="true"></span><span class="pad-rivet pad-rivet-a"></span><span class="pad-rivet pad-rivet-b"></span><span class="pad-rivet pad-rivet-c"></span><span class="pad-rivet pad-rivet-d"></span></span>';
      wrap.appendChild(b); return b;
    });
    hud.start.disabled = true; hud.start.textContent = 'Playing';
    function flash(i, dur) {
      var pad = pads[i];
      pad.classList.add('is-lit');
      return gsap.timeline({ onComplete: function () { pad.classList.remove('is-lit'); } })
        .to(pad, { filter: 'brightness(1.22)', scale: 1.045, duration: dur || 0.2, ease: 'power2.out' })
        .to(pad, { filter: 'brightness(1)', scale: 1, duration: 0.3, ease: 'power2.inOut' });
    }
    function setPads(on) { pads.forEach(function (p) { p.disabled = !on; }); }
    function playback() {
      accepting = false; setPads(false); pos = 0;
      hud.info.textContent = 'Watch...';
      var speed = Math.max(0.28, 0.6 - seq.length * 0.02);
      seq.forEach(function (n, k) { timers.push(gsap.delayedCall(0.6 + k * speed, function () { if (!over) { flash(n, speed * 0.5); } })); });
      timers.push(gsap.delayedCall(0.6 + seq.length * speed + 0.1, function () { if (over) { return; } accepting = true; setPads(true); hud.info.textContent = 'Your turn.'; }));
    }
    function addStep() { seq.push(Math.floor(Math.random() * 4)); hud.time.textContent = seq.length; playback(); }
    pads.forEach(function (p) {
      p.addEventListener('pointerdown', function (e) {
        if (!accepting || over) { return; }
        e.preventDefault();
        var i = parseInt(p.getAttribute('data-i'), 10);
        flash(i, 0.12);
        if (i !== seq[pos]) { end(); return; }
        pos++;
        if (pos === seq.length) {
          accepting = false; setPads(false);
          setScore(seq.length); hud.info.textContent = 'Nice.';
          timers.push(gsap.delayedCall(0.7, addStep));
        }
      });
    });
    function end() {
      over = true; accepting = false; setPads(false);
      var s = seq.length - 1;
      gsap.fromTo(wrap, { x: -10 }, { x: 0, duration: 0.5, ease: 'elastic.out(1,0.25)' });
      timers.push(gsap.delayedCall(0.7, function () { showMsg(s + (s === 1 ? ' round' : ' rounds'), 'The pattern got away from you.'); }));
      finish('echo', Math.max(0, s), 'You cleared ' + Math.max(0, s) + (s === 1 ? ' round.' : ' rounds.'));
    }
    timers.push(gsap.delayedCall(0.5, addStep));
    return { stop: function () { over = true; timers.forEach(function (t) { t.kill(); }); } };
  }

  /* ---- Gold Rush ---- */
  function rush() {
    arena.innerHTML = '';
    var score = 0, over = false, elapsed = 0, timers = [], clock = { t: 30 };
    hud.start.disabled = true; hud.start.textContent = 'Playing';
    var tw = gsap.to(clock, { t: 0, duration: 30, ease: 'none', onUpdate: function () { hud.time.textContent = Math.ceil(clock.t); elapsed = 30 - clock.t; }, onComplete: end });
    function pop(x, y, txt, color) {
      var s = document.createElement('span'); s.textContent = txt;
      s.style.cssText = 'position:absolute;left:' + x + 'px;top:' + y + 'px;font-weight:800;color:' + color + ';pointer-events:none;transform:translate(-50%,-50%)';
      arena.appendChild(s);
      gsap.to(s, { y: '-=34', opacity: 0, duration: 0.7, ease: 'power2.out', onComplete: function () { s.remove(); } });
    }
    function spawnT() {
      if (over) { return; }
      var w = arena.clientWidth, h = arena.clientHeight;
      var x = 50 + Math.random() * (w - 100), y = 50 + Math.random() * (h - 100);
      var decoy = Math.random() < Math.min(0.42, 0.18 + elapsed * 0.008);
      var el = document.createElement('button'); el.type = 'button';
      el.className = 'rush-target' + (decoy ? ' decoy' : ''); el.setAttribute('aria-label', decoy ? 'Decoy' : 'Gold hex');
      el.style.left = x + 'px'; el.style.top = y + 'px';
      var image = document.createElement('img');
      image.src = decoy ? 'images/monkey.jpeg' : 'images/hextech.jfif';
      image.alt = '';
      image.draggable = false;
      el.appendChild(image);
      arena.appendChild(el);
      var life = Math.max(0.7, 1.3 - elapsed * 0.02), gone = false;
      gsap.fromTo(el, { scale: 0, rotation: -40 }, { scale: 1, rotation: 0, duration: 0.25, ease: 'back.out(2)' });
      var out = gsap.to(el, { scale: 0, duration: 0.25, delay: life, ease: 'power2.in', onComplete: function () { gone = true; el.remove(); } });
      el.addEventListener('pointerdown', function (e) {
        e.preventDefault();
        if (gone || over) { return; }
        gone = true; out.kill();
        if (decoy) { score = Math.max(0, score - 15); pop(x, y, '-15', '#ff6ab8'); gsap.fromTo(arena, { x: -5 }, { x: 0, duration: 0.35, ease: 'elastic.out(1,0.3)' }); }
        else { score += 10; pop(x, y, '+10', '#ffd76a'); var r = arena.getBoundingClientRect(); burst(r.left + x, r.top + y, '255,215,106', 14); }
        setScore(score);
        gsap.to(el, { scale: 1.6, opacity: 0, duration: 0.2, onComplete: function () { el.remove(); } });
      });
    }
    function loop() { if (over) { return; } spawnT(); timers.push(gsap.delayedCall(Math.max(0.28, 0.7 - elapsed * 0.012), loop)); }
    timers.push(gsap.delayedCall(0.4, loop));
    function end() {
      if (over) { return; }
      over = true; tw.kill(); timers.forEach(function (t) { t.kill(); });
      $$('.rush-target', arena).forEach(function (b) { b.remove(); });
      showMsg('Time!', score + ' points');
      finish('rush', score, 'You scored ' + score + '.');
    }
    return { stop: function () { over = true; tw.kill(); timers.forEach(function (t) { t.kill(); }); } };
  }

  selectGame('fuse');
})();
