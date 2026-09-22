<?php
$pageTitle = 'Brief received | TEXARA';
$pageDesc  = 'Thanks - your manufacturing brief reached TEXARA. We answer every request within 72 hours.';
require __DIR__ . '/inc/header.php';
?>

<section class="hero" style="padding-block:clamp(60px,12vw,120px)">
  <div class="hero__bg" aria-hidden="true">
    <div class="grid-lines"></div>
    <div class="hero__glow" id="heroGlow"></div>
    <?= symbol('color', 'hero__mark') ?>
  </div>
  <div class="wrap hero__in">
    <p class="eyebrow eyebrow--onink"><span class="pulse"></span>Brief received</p>
    <h1 class="hero__title">THANKS. WE ARE <em>ON IT</em></h1>
    <p class="hero__text">Your request is in our queue and a copy is already with the project manager who will cost it.
      Expect a costed answer - target price, minimum and calendar - within 72 working hours.</p>

    <ul class="cta__list" style="margin-bottom:28px">
      <li><b>Next:</b> we read the brief and flag anything missing</li>
      <li><b>Within 72h:</b> target cost, MOQ and a realistic calendar</li>
      <li><b>Then:</b> a call to walk through materials and samples</li>
    </ul>

    <div class="hero__btns">
      <a class="btn btn--green btn--lg" href="index.php">Back to the site</a>
      <a class="btn btn--ghostw btn--lg" href="<?= e(wa_link($CFG)) ?>" target="_blank" rel="noopener">Chat on WhatsApp</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
