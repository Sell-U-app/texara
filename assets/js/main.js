/* TEXARA - interactions. No dependencies. */
(function () {
  'use strict';

  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $  = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* ---------- boot curtain ---------- */
  var boot = $('#boot');
  if (boot) {
    var killBoot = function () { boot.classList.add('is-done'); };
    if (reduced) { killBoot(); }
    else {
      boot.addEventListener('animationend', function (ev) {
        if (ev.animationName === 'bootOut') killBoot();
      });
      setTimeout(killBoot, 1800); // safety net
    }
  }

  /* ---------- mobile menu ---------- */
  var burger = $('#burger'), links = $('#navLinks');
  if (burger && links) {
    burger.addEventListener('click', function () {
      var open = links.classList.toggle('is-open');
      burger.classList.toggle('is-on', open);
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    $$('a', links).forEach(function (a) {
      a.addEventListener('click', function () {
        links.classList.remove('is-open');
        burger.classList.remove('is-on');
        burger.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ---------- scroll progress bar ---------- */
  var bar = $('#navProgress');
  function progress() {
    if (!bar) return;
    var h = document.documentElement;
    var max = h.scrollHeight - h.clientHeight;
    bar.style.width = (max > 0 ? (h.scrollTop / max) * 100 : 0) + '%';
  }

  /* ---------- reveal on scroll ---------- */
  var revealables = $$('.reveal');
  if ('IntersectionObserver' in window && !reduced) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
      });
    }, { rootMargin: '0px 0px -12% 0px', threshold: 0.08 });
    revealables.forEach(function (el) { io.observe(el); });
  } else {
    revealables.forEach(function (el) { el.classList.add('is-in'); });
  }

  /* ---------- count up ---------- */
  function countUp(el) {
    var to = parseFloat(el.getAttribute('data-to')) || 0;
    if (reduced || to === 0) { el.textContent = to; return; }
    var dur = 1400, t0 = null;
    function tick(ts) {
      if (!t0) t0 = ts;
      var p = Math.min((ts - t0) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(to * eased).toLocaleString('en-US');
      if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
  var counters = $$('.count');
  if ('IntersectionObserver' in window) {
    var co = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { countUp(en.target); co.unobserve(en.target); }
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { co.observe(el); });
  } else {
    counters.forEach(function (el) { el.textContent = el.getAttribute('data-to'); });
  }

  /* ---------- process rail ---------- */
  var fill = $('#lineFill'), steps = $$('.step');
  function rail() {
    if (!steps.length) return;
    var first = steps[0].getBoundingClientRect();
    var last = steps[steps.length - 1].getBoundingClientRect();
    var total = last.bottom - first.top;
    var done = Math.min(Math.max(window.innerHeight * 0.55 - first.top, 0), total);
    if (fill) fill.style.height = (total > 0 ? (done / total) * 100 : 0) + '%';
    steps.forEach(function (s) {
      var r = s.getBoundingClientRect();
      s.classList.toggle('is-in', r.top < window.innerHeight * 0.75);
    });
  }

  /* ---------- hero glow follows the pointer ---------- */
  var hero = $('.hero'), glow = $('#heroGlow');
  if (hero && glow && window.matchMedia('(pointer:fine)').matches && !reduced) {
    hero.addEventListener('pointermove', function (ev) {
      var r = hero.getBoundingClientRect();
      glow.style.left = ((ev.clientX - r.left) / r.width) * 100 + '%';
      glow.style.top = ((ev.clientY - r.top) / r.height) * 100 + '%';
    });
  }

  /* ---------- estimator ---------- */
  var est = $('#est');
  if (est) {
    var uni = $('#estUnits'), sty = $('#estStyles');
    var uniOut = $('#estUnitsOut'), styOut = $('#estStylesOut');
    var outMoq = $('#outMoq'), outSample = $('#outSample'), outLead = $('#outLead'), outTotal = $('#outTotal');
    var segSample = $('#segSample'), segBulk = $('#segBulk');
    var planField = $('#formPlan');

    var catBtns = $$('[data-cat]', est);
    var cxBtns  = $$('[data-cx]', est);
    var cat = catBtns[0], cx = $('[data-cx].is-on', est) || cxBtns[1];

    function group(btn, list) {
      list.forEach(function (b) {
        b.classList.toggle('is-on', b === btn);
        b.setAttribute('aria-checked', b === btn ? 'true' : 'false');
      });
    }

    function nf(n) { return Number(n).toLocaleString('en-US'); }

    function calc() {
      var units  = parseInt(uni.value, 10);
      var styles = parseInt(sty.value, 10);
      var moq    = parseInt(cat.getAttribute('data-moq'), 10);
      var base   = parseInt(cat.getAttribute('data-base'), 10);
      var sample = parseInt(cat.getAttribute('data-sample'), 10);
      var mult   = parseFloat(cx.getAttribute('data-cx'));

      var total = units * styles;
      // volume pushes the calendar, complexity multiplies both stages
      var lead = Math.round((base + Math.sqrt(total / 1000) * 4 + (styles - 1) * 0.8) * mult);
      var samp = Math.round(sample * mult);

      uniOut.textContent = nf(units);
      styOut.textContent = styles;
      outMoq.textContent = nf(moq) + ' units';
      outSample.textContent = samp + ' days';
      outLead.textContent = lead + ' days';
      outTotal.textContent = nf(total);

      var span = samp + lead + 5;
      segSample.style.width = (samp / span) * 100 + '%';
      segBulk.style.width = (lead / span) * 100 + '%';

      if (planField) {
        planField.value = cat.textContent.trim() + ' | ' + nf(units) + ' units x ' + styles +
          ' styles | ' + cx.textContent.trim() + ' | est. ' + samp + 'd sampling + ' + lead + 'd bulk';
      }

      if (units < moq) {
        outMoq.style.color = '#FFB03A';
      } else {
        outMoq.style.color = '';
      }
    }

    catBtns.forEach(function (b) {
      b.addEventListener('click', function () { cat = b; group(b, catBtns); calc(); });
    });
    cxBtns.forEach(function (b) {
      b.addEventListener('click', function () { cx = b; group(b, cxBtns); calc(); });
    });
    uni.addEventListener('input', calc);
    sty.addEventListener('input', calc);
    calc();
  }

  /* ---------- smooth anchor offset for sticky nav ---------- */
  $$('a[href*="#"]').forEach(function (a) {
    a.addEventListener('click', function (ev) {
      var id = a.getAttribute('href').split('#')[1];
      if (!id) return;
      var target = document.getElementById(id);
      if (!target) return;
      var base = a.getAttribute('href').split('#')[0];
      if (base && base.indexOf(location.pathname.split('/').pop() || 'index.php') === -1 && base !== '') return;
      ev.preventDefault();
      var nav = $('#nav');
      var top = target.getBoundingClientRect().top + window.pageYOffset - (nav ? nav.offsetHeight - 1 : 0);
      window.scrollTo({ top: top, behavior: reduced ? 'auto' : 'smooth' });
      history.replaceState(null, '', '#' + id);
    });
  });

  /* ---------- parallax ---------- */
  var parallaxed = $$('.par');
  function parallax() {
    if (reduced) return;
    var vh = window.innerHeight;
    parallaxed.forEach(function (el) {
      var r = el.getBoundingClientRect();
      if (r.bottom < -200 || r.top > vh + 200) return;
      var amount = parseFloat(el.getAttribute('data-par')) || -20;
      // -1 .. 1 across the viewport
      var pos = (r.top + r.height / 2 - vh / 2) / vh;
      el.style.setProperty('--p', (pos * amount).toFixed(2));
    });
  }

  /* ---------- nav hides going down ---------- */
  var nav = $('#nav'), lastY = window.pageYOffset;
  function navToggle() {
    if (!nav || reduced) return;
    var y = window.pageYOffset;
    var menuOpen = links && links.classList.contains('is-open');
    if (!menuOpen && y > 320 && y > lastY + 6) nav.classList.add('is-hidden');
    else if (y < lastY - 6 || y < 320) nav.classList.remove('is-hidden');
    lastY = y;
  }

  /* ---------- pointer tilt on cards ---------- */
  if (window.matchMedia('(pointer:fine)').matches && !reduced) {
    $$('.tilt').forEach(function (card) {
      card.addEventListener('pointermove', function (ev) {
        var r = card.getBoundingClientRect();
        var px = (ev.clientX - r.left) / r.width - 0.5;
        var py = (ev.clientY - r.top) / r.height - 0.5;
        card.style.setProperty('--ry', (px * 5).toFixed(2) + 'deg');
        card.style.setProperty('--rx', (-py * 5).toFixed(2) + 'deg');
        card.classList.add('is-tilting');
      });
      card.addEventListener('pointerleave', function () {
        card.classList.remove('is-tilting');
        card.style.setProperty('--rx', '0deg');
        card.style.setProperty('--ry', '0deg');
      });
    });
  }

  /* ---------- rAF scroll loop ---------- */
  var ticking = false;
  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(function () {
      progress(); rail(); parallax(); navToggle(); ticking = false;
    });
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();
})();
