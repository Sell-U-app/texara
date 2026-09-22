<?php
$CFG = require __DIR__ . '/../config.php';
require_once __DIR__ . '/helpers.php';

$B         = $CFG['brand'];
$pageTitle = $pageTitle ?? $CFG['seo']['title'];
$pageDesc  = $pageDesc  ?? $CFG['seo']['description'];
$bodyClass = $bodyClass ?? '';
$ver       = '1.0.0';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<meta name="keywords" content="<?= e($CFG['seo']['keywords']) ?>">
<meta name="theme-color" content="#0B8938">
<link rel="canonical" href="<?= e($B['url']) ?>/">

<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDesc) ?>">
<meta property="og:url" content="<?= e($B['url']) ?>/">
<meta property="og:image" content="<?= e($B['url']) ?>/assets/img/texara-og.png">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" type="image/png" href="assets/img/texara-favicon.png">
<link rel="apple-touch-icon" href="assets/img/texara-favicon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Barlow:ital,wght@0,400;0,500;0,600;0,700;1,500&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css?v=<?= $ver ?>">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "<?= e($B['name']) ?>",
  "url": "<?= e($B['url']) ?>",
  "email": "<?= e($B['email']) ?>",
  "telephone": "<?= e($B['phone']) ?>",
  "foundingDate": "<?= (int) $B['founded'] ?>",
  "description": "<?= e($CFG['seo']['description']) ?>",
  "address": { "@type": "PostalAddress", "addressLocality": "Medellin", "addressCountry": "CO" }
}
</script>
</head>
<body class="<?= e($bodyClass) ?>">

<div class="boot" id="boot" aria-hidden="true">
  <?= symbol('color') ?>
  <span class="boot__bar"><i></i></span>
</div>

<a class="skip" href="#main">Skip to content</a>

<div class="topbar">
  <div class="topbar__in">
    <span><?= e($B['address']) ?></span>
    <span class="dot"></span>
    <span><?= e($B['hours']) ?></span>
    <span class="dot"></span>
    <span>Answers in 72 hours</span>
  </div>
</div>

<header class="nav" id="nav">
  <div class="nav__in">
    <a class="nav__logo" href="index.php" aria-label="<?= e($B['name']) ?> home">
      <?= lockup('white') ?>
      <span class="nav__sub"><?= e($B['tagline']) ?></span>
    </a>

    <nav class="nav__links" id="navLinks" aria-label="Main">
      <a href="index.php#capabilities">Capabilities</a>
      <a href="index.php#process">Process</a>
      <a href="index.php#why">Why Colombia</a>
      <a href="index.php#estimator">Estimator</a>
      <a href="index.php#faq">FAQ</a>
      <a class="btn btn--sm btn--green" href="index.php#contact">Request a quote</a>
    </nav>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="navLinks">
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav__progress" id="navProgress"></div>
</header>

<main id="main">
