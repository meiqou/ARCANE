(function () {
  var gsap = window.gsap;
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!gsap || reduceMotion) {
    return;
  }

  function revealOnScroll(element, delay) {
    if (!('IntersectionObserver' in window)) {
      gsap.fromTo(element, { autoAlpha: 0, y: 22 }, {
        autoAlpha: 1,
        y: 0,
        duration: 0.7,
        delay: delay || 0,
        ease: 'power3.out',
        clearProps: 'transform,opacity,visibility'
      });
      return;
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) {
          return;
        }
        observer.unobserve(entry.target);
        gsap.fromTo(entry.target, { autoAlpha: 0, y: 22 }, {
          autoAlpha: 1,
          y: 0,
          duration: 0.7,
          delay: delay || 0,
          ease: 'power3.out',
          clearProps: 'transform,opacity,visibility'
        });
      });
    }, { threshold: 0.12 });
    observer.observe(element);
  }

  document.querySelectorAll('.city-section-head, .city-map-toolbar, .city-map-layout, .dashboard-command-center .sec-head').forEach(function (element) {
    revealOnScroll(element);
  });

  document.querySelectorAll('[data-dashboard-card]').forEach(function (card, index) {
    revealOnScroll(card, index * 0.09);

    card.addEventListener('pointermove', function (event) {
      if (event.pointerType === 'touch') {
        return;
      }
      var bounds = card.getBoundingClientRect();
      var x = (event.clientX - bounds.left) / bounds.width;
      var y = (event.clientY - bounds.top) / bounds.height;
      card.style.setProperty('--pointer-x', (x * 100) + '%');
      card.style.setProperty('--pointer-y', (y * 100) + '%');
      gsap.to(card, {
        '--tilt-x': ((x - 0.5) * 5) + 'deg',
        '--tilt-y': ((0.5 - y) * 5) + 'deg',
        duration: 0.4,
        ease: 'power2.out',
        overwrite: 'auto'
      });
    });

    card.addEventListener('pointerleave', function () {
      gsap.to(card, {
        '--tilt-x': '0deg',
        '--tilt-y': '0deg',
        duration: 0.65,
        ease: 'elastic.out(1, 0.65)',
        overwrite: 'auto'
      });
    });
  });

  var mapVisual = document.querySelector('.city-map-visual');
  if (!mapVisual) {
    return;
  }

  mapVisual.addEventListener('pointermove', function (event) {
    if (event.pointerType === 'touch') {
      return;
    }
    var bounds = mapVisual.getBoundingClientRect();
    var shiftX = ((event.clientX - bounds.left) / bounds.width - 0.5) * -12;
    var shiftY = ((event.clientY - bounds.top) / bounds.height - 0.5) * -12;
    gsap.to(mapVisual, {
      '--map-shift-x': shiftX + 'px',
      '--map-shift-y': shiftY + 'px',
      duration: 0.65,
      ease: 'power2.out',
      overwrite: 'auto'
    });
  });

  mapVisual.addEventListener('pointerleave', function () {
    gsap.to(mapVisual, {
      '--map-shift-x': '0px',
      '--map-shift-y': '0px',
      duration: 0.8,
      ease: 'power2.out',
      overwrite: 'auto'
    });
  });

  document.addEventListener('arcane:map-city-changed', function () {
    gsap.fromTo(mapVisual, { autoAlpha: 0.62, filter: 'blur(3px) brightness(1.3)' }, {
      autoAlpha: 1,
      filter: 'blur(0px) brightness(1)',
      duration: 0.72,
      ease: 'power2.out',
      clearProps: 'opacity,visibility,filter'
    });

    var landmarks = mapVisual.querySelectorAll('.map-landmark:not([hidden])');
    gsap.fromTo(landmarks, { autoAlpha: 0, filter: 'blur(5px)' }, {
      autoAlpha: 1,
      filter: 'blur(0px)',
      duration: 0.48,
      stagger: 0.1,
      ease: 'power2.out',
      clearProps: 'opacity,visibility,filter'
    });
  });

  document.addEventListener('arcane:landmark-selected', function () {
    var dossier = document.querySelector('.landmark-detail');
    if (!dossier) {
      return;
    }
    var content = dossier.querySelectorAll('.dossier-heading, h4, [data-landmark-lore], .landmark-spotlight, [data-landmark-link], .dossier-footnote');
    gsap.fromTo(content, { autoAlpha: 0, y: 14 }, {
      autoAlpha: 1,
      y: 0,
      duration: 0.42,
      stagger: 0.055,
      ease: 'power2.out',
      clearProps: 'transform,opacity,visibility'
    });
  });

  mapVisual.querySelectorAll('.map-landmark').forEach(function (landmark) {
    landmark.addEventListener('pointerenter', function () {
      if (!landmark.hidden) {
        gsap.to(landmark, { filter: 'brightness(1.22)', duration: 0.2, overwrite: 'auto' });
      }
    });
    landmark.addEventListener('pointerleave', function () {
      gsap.to(landmark, { filter: 'brightness(1)', duration: 0.25, overwrite: 'auto' });
    });
  });
})();
