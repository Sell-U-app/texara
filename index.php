<?php
$pageTitle = null; // uses SEO title from config
require __DIR__ . '/inc/header.php';

$H = $CFG['hero'];
$C = $CFG['capabilities'];
$P = $CFG['process'];
$W = $CFG['why'];
$E = $CFG['estimator'];
$S = $CFG['standards'];
$F = $CFG['faq'];
$K = $CFG['contact'];
?>

<!-- ============================== HERO ============================== -->
<section class="hero" id="top">
  <div class="hero__bg" aria-hidden="true">
    <div class="grid-lines"></div>
    <div class="hero__glow" id="heroGlow"></div>
    <svg class="hero__stitch" viewBox="0 0 1400 700" preserveAspectRatio="xMidYMid slice">
      <path class="stitch stitch--1" d="M-50,520 C 250,420 420,610 700,470 C 980,330 1150,520 1450,400"/>
      <path class="stitch stitch--2" d="M-50,600 C 230,520 430,690 700,560 C 970,430 1160,600 1450,500"/>
      <path class="stitch stitch--3" d="M-50,430 C 270,340 400,520 700,390 C 1000,260 1130,440 1450,310"/>
    </svg>
    <?= symbol('color', 'hero__mark') ?>
    <span class="orb orb--1"></span>
    <span class="orb orb--2"></span>
    <span class="orb orb--3"></span>
    <span class="orb orb--4"></span>
  </div>

  <div class="wrap hero__in">
    <div class="hero__grid">
      <div class="hero__copy">
        <p class="eyebrow eyebrow--onink reveal"><span class="pulse"></span><?= e($H['eyebrow']) ?></p>

        <h1 class="hero__title reveal"><?= hl($H['title']) ?></h1>

        <p class="hero__text reveal"><?= e($H['text']) ?></p>

        <div class="hero__btns reveal">
          <a class="btn btn--green btn--lg" href="#contact"><?= e($H['cta_1']) ?><span class="btn__arrow">&rarr;</span></a>
          <a class="btn btn--ghostw btn--lg" href="#capabilities"><?= e($H['cta_2']) ?></a>
        </div>
      </div>

      <div class="hero__media reveal par" data-par="-24">
        <figure class="shot shot--main">
          <picture>
            <source media="(min-width:1000px)" srcset="assets/img/hero-floor-tall.jpg">
            <img src="assets/img/hero-floor.jpg" width="1200" height="900" fetchpriority="high"
                 alt="Operators sewing on a production line inside the plant">
          </picture>
          <figcaption>Cut &amp; sew floor</figcaption>
        </figure>
        <figure class="shot shot--detail">
          <img src="assets/img/hero-detail.jpg" width="700" height="700" loading="lazy"
               alt="Close-up of an operator threading a production machine">
        </figure>
      </div>
    </div>

    <div class="ticker reveal">
      <?php foreach ($H['ticker'] as $t): ?>
        <div class="ticker__item">
          <span class="ticker__v"><span class="count" data-to="<?= e($t['value']) ?>">0</span><?= e($t['suffix']) ?></span>
          <span class="ticker__l"><?= e($t['label']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <a class="hero__scroll" href="#capabilities" aria-label="Scroll down"><span></span></a>
</section>

<!-- ============================== MARQUEE ============================== -->
<div class="marquee" aria-hidden="true">
  <div class="marquee__track">
    <?php for ($i = 0; $i < 2; $i++): ?>
      <?php foreach ($CFG['marquee'] as $m): ?>
        <span class="marquee__item"><?= e($m) ?></span>
        <span class="marquee__sep"><?= symbol('ink') ?></span>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

<!-- ============================== CAPABILITIES ============================== -->
<section class="sec sec--paper" id="capabilities">
  <div class="wrap">
    <header class="sechead">
      <p class="eyebrow reveal"><?= e($C['eyebrow']) ?></p>
      <h2 class="h2 reveal"><?= hl($C['title']) ?></h2>
      <p class="lead reveal"><?= e($C['text']) ?></p>
    </header>

    <div class="caps">
      <?php foreach ($C['items'] as $i => $it): ?>
        <article class="cap reveal tilt" style="--d:<?= $i * 70 ?>ms" tabindex="0">
          <figure class="cap__ph">
            <img src="assets/img/<?= e($it['img']) ?>" width="900" height="506" loading="lazy" alt="<?= e($it['alt']) ?>">
            <span class="cap__num"><?= e($it['num']) ?></span>
          </figure>
          <div class="cap__body">
            <h3 class="cap__title"><?= e($it['title']) ?></h3>
            <p class="cap__text"><?= e($it['text']) ?></p>
            <ul class="cap__tags">
              <?php foreach ($it['tags'] as $tg): ?><li><?= e($tg) ?></li><?php endforeach; ?>
            </ul>
          </div>
          <span class="cap__fill" aria-hidden="true"></span>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================== PROCESS ============================== -->
<section class="sec sec--ink" id="process">
  <div class="grid-lines grid-lines--soft" aria-hidden="true"></div>
  <div class="wrap">
    <header class="sechead">
      <p class="eyebrow eyebrow--onink reveal"><?= e($P['eyebrow']) ?></p>
      <h2 class="h2 h2--onink reveal"><?= hl($P['title']) ?></h2>
      <p class="lead lead--onink reveal"><?= e($P['text']) ?></p>
    </header>

    <div class="line">
      <div class="line__rail" aria-hidden="true"><span class="line__fill" id="lineFill"></span></div>
      <ol class="line__steps">
        <?php foreach ($P['steps'] as $s): ?>
          <li class="step reveal">
            <span class="step__dot" aria-hidden="true"></span>
            <span class="step__num"><?= e($s['num']) ?></span>
            <h3 class="step__title"><?= e($s['title']) ?></h3>
            <p class="step__text"><?= e($s['text']) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============================== WHY COLOMBIA ============================== -->
<section class="sec sec--paper" id="why">
  <div class="wrap">
    <header class="sechead">
      <p class="eyebrow reveal"><?= e($W['eyebrow']) ?></p>
      <h2 class="h2 reveal"><?= hl($W['title']) ?></h2>
      <p class="lead reveal"><?= e($W['text']) ?></p>
    </header>

    <div class="why">
      <?php foreach ($W['cards'] as $i => $c): ?>
        <article class="why__card reveal tilt" style="--d:<?= $i * 70 ?>ms">
          <span class="why__k"><?= e($c['k']) ?></span>
          <h3 class="why__v"><?= e($c['v']) ?></h3>
          <p class="why__t"><?= e($c['t']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="cmp reveal">
      <h3 class="cmp__title"><?= e($W['compare']['title']) ?></h3>
      <div class="cmp__head">
        <span></span>
        <span class="cmp__near"><?= e($W['compare']['near_label']) ?></span>
        <span class="cmp__far"><?= e($W['compare']['far_label']) ?></span>
      </div>
      <?php foreach ($W['compare']['rows'] as $r): ?>
        <div class="cmp__row">
          <span class="cmp__label"><?= e($r['label']) ?></span>
          <span class="cmp__near"><?= e($r['near']) ?></span>
          <span class="cmp__far"><?= e($r['far']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================== ESTIMATOR ============================== -->
<section class="sec sec--green" id="estimator">
  <span class="orb orb--1" aria-hidden="true"></span>
  <span class="orb orb--3" aria-hidden="true"></span>
  <div class="wrap">
    <header class="sechead">
      <p class="eyebrow eyebrow--onink reveal"><?= e($E['eyebrow']) ?></p>
      <h2 class="h2 h2--onink reveal"><?= hl($E['title']) ?></h2>
      <p class="lead lead--onink reveal"><?= e($E['text']) ?></p>
    </header>

    <div class="est reveal" id="est">
      <div class="est__controls">
        <div class="field">
          <span class="field__label">1. Product line</span>
          <div class="chips" role="radiogroup" aria-label="Product line">
            <?php foreach ($E['categories'] as $i => $cat): ?>
              <button type="button" class="chip<?= $i === 0 ? ' is-on' : '' ?>" role="radio"
                      aria-checked="<?= $i === 0 ? 'true' : 'false' ?>"
                      data-cat="<?= e($cat['id']) ?>"
                      data-moq="<?= (int) $cat['moq'] ?>"
                      data-base="<?= (int) $cat['base'] ?>"
                      data-sample="<?= (int) $cat['sample'] ?>"><?= e($cat['label']) ?></button>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="field">
          <span class="field__label">2. Units per style <b id="estUnitsOut">1,500</b></span>
          <input type="range" id="estUnits" min="100" max="20000" step="100" value="1500" class="range" aria-label="Units per style">
          <div class="range__scale"><span>100</span><span>20,000</span></div>
        </div>

        <div class="field">
          <span class="field__label">3. Styles in the order <b id="estStylesOut">3</b></span>
          <input type="range" id="estStyles" min="1" max="20" step="1" value="3" class="range" aria-label="Number of styles">
          <div class="range__scale"><span>1</span><span>20</span></div>
        </div>

        <div class="field">
          <span class="field__label">4. Complexity</span>
          <div class="chips" role="radiogroup" aria-label="Complexity">
            <button type="button" class="chip" role="radio" aria-checked="false" data-cx="0.85">Simple</button>
            <button type="button" class="chip is-on" role="radio" aria-checked="true" data-cx="1">Standard</button>
            <button type="button" class="chip" role="radio" aria-checked="false" data-cx="1.3">Complex</button>
          </div>
        </div>
      </div>

      <aside class="est__out" aria-live="polite">
        <span class="est__badge">Indicative plan</span>
        <div class="est__rows">
          <div class="est__row"><span>Minimum per style</span><b id="outMoq">300 units</b></div>
          <div class="est__row"><span>Sampling</span><b id="outSample">14 days</b></div>
          <div class="est__row est__row--big"><span>Bulk lead time</span><b id="outLead">32 days</b></div>
          <div class="est__row"><span>Total units</span><b id="outTotal">4,500</b></div>
          <div class="est__row"><span>Air freight to Miami</span><b>1-2 days</b></div>
        </div>
        <div class="est__bar" aria-hidden="true">
          <span class="est__seg est__seg--a" id="segSample"><i>Sampling</i></span>
          <span class="est__seg est__seg--b" id="segBulk"><i>Production</i></span>
          <span class="est__seg est__seg--c"><i>Ship</i></span>
        </div>
        <p class="est__note">Indicative only. Send the tech pack and you get the real cost, minimum and calendar within 72 hours.</p>
        <a class="btn btn--ink btn--full" href="#contact" id="estCta">Get the real quote<span class="btn__arrow">&rarr;</span></a>
      </aside>
    </div>
  </div>
</section>

<!-- ============================== STANDARDS ============================== -->
<section class="sec sec--ink" id="standards">
  <div class="grid-lines grid-lines--soft" aria-hidden="true"></div>
  <div class="wrap">
    <header class="sechead">
      <p class="eyebrow eyebrow--onink reveal"><?= e($S['eyebrow']) ?></p>
      <h2 class="h2 h2--onink reveal"><?= hl($S['title']) ?></h2>
      <p class="lead lead--onink reveal"><?= e($S['text']) ?></p>
    </header>

    <div class="std">
      <?php foreach ($S['items'] as $i => $it): ?>
        <article class="std__card reveal" style="--d:<?= $i * 70 ?>ms">
          <?= symbol('color', 'std__ico') ?>
          <h3><?= e($it['title']) ?></h3>
          <p><?= e($it['text']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================== FAQ ============================== -->
<section class="sec sec--paper" id="faq">
  <div class="wrap">
    <header class="sechead">
      <p class="eyebrow reveal"><?= e($F['eyebrow']) ?></p>
      <h2 class="h2 reveal"><?= hl($F['title']) ?></h2>
    </header>

    <div class="faq">
      <?php foreach ($F['items'] as $i => $q): ?>
        <details class="faq__item reveal"<?= $i === 0 ? ' open' : '' ?>>
          <summary>
            <span><?= e($q['q']) ?></span>
            <i aria-hidden="true"></i>
          </summary>
          <div class="faq__a"><p><?= e($q['a']) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================== CONTACT ============================== -->
<section class="sec sec--ink cta" id="contact">
  <div class="halftone" aria-hidden="true"></div>
  <div class="wrap cta__in">
    <div class="cta__copy">
      <p class="eyebrow eyebrow--onink reveal"><?= e($K['eyebrow']) ?></p>
      <h2 class="h2 h2--onink reveal"><?= hl($K['title']) ?></h2>
      <p class="lead lead--onink reveal"><?= e($K['text']) ?></p>

      <ul class="cta__list reveal">
        <li><b>72 hours</b> to a costed answer</li>
        <li><b>NDA</b> signed before the first file</li>
        <li><b>No fee</b> for quoting, ever</li>
      </ul>

      <div class="cta__direct reveal">
        <a href="mailto:<?= e($B['email']) ?>"><?= e($B['email']) ?></a>
        <a href="tel:<?= e(preg_replace('/\s+/', '', $B['phone'])) ?>"><?= e($B['phone']) ?></a>
      </div>
    </div>

    <form class="form reveal" action="send.php" method="post" novalidate>
      <?php if (!empty($_GET['err'])):
        $errs = [
            'fields'  => 'Please fill in your name, company and a short description.',
            'email'   => 'That email address does not look valid - check it and send again.',
            'consent' => 'Please tick the consent box so we can reply to you.',
        ];
        $msg = $errs[$_GET['err']] ?? 'Something went wrong. Please try again.';
      ?>
        <p class="note note--bad"><?= e($msg) ?></p>
      <?php endif; ?>
      <input type="hidden" name="plan" id="formPlan" value="">
      <div class="hp" aria-hidden="true">
        <label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      </div>

      <div class="form__row">
        <label class="inp">
          <span>Name *</span>
          <input type="text" name="name" required maxlength="80" autocomplete="name">
        </label>
        <label class="inp">
          <span>Company *</span>
          <input type="text" name="company" required maxlength="80" autocomplete="organization">
        </label>
      </div>

      <div class="form__row">
        <label class="inp">
          <span>Email *</span>
          <input type="email" name="email" required maxlength="120" autocomplete="email">
        </label>
        <label class="inp">
          <span>Phone / WhatsApp</span>
          <input type="tel" name="phone" maxlength="40" autocomplete="tel">
        </label>
      </div>

      <div class="form__row">
        <label class="inp">
          <span>Product line *</span>
          <select name="line" required>
            <?php foreach ($E['categories'] as $cat): ?>
              <option value="<?= e($cat['label']) ?>"><?= e($cat['label']) ?></option>
            <?php endforeach; ?>
            <option value="Other">Other / mixed</option>
          </select>
        </label>
        <label class="inp">
          <span>Volume *</span>
          <select name="volume" required>
            <?php foreach ($K['volumes'] as $v): ?>
              <option value="<?= e($v) ?>"><?= e($v) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
      </div>

      <label class="inp">
        <span>What do you need built? *</span>
        <textarea name="message" rows="4" required maxlength="2000" placeholder="Product, materials, target price, target date. Paste a link to your tech pack if you have one."></textarea>
      </label>

      <label class="check">
        <input type="checkbox" name="consent" value="1" required>
        <span>I agree that TEXARA may contact me about this request. <a href="privacy.php">Privacy</a>.</span>
      </label>

      <button class="btn btn--green btn--lg btn--full" type="submit">Send the brief<span class="btn__arrow">&rarr;</span></button>
      <p class="form__foot">Or write to <a href="mailto:<?= e($B['email']) ?>"><?= e($B['email']) ?></a> - we answer every message.</p>
    </form>
  </div>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
