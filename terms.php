<?php
$pageTitle = 'Terms of use | TEXARA';
$pageDesc  = 'Terms that govern the use of the TEXARA website and the quotations issued through it.';
require __DIR__ . '/inc/header.php';
?>

<section class="doc wrap">
  <p class="doc__meta">Last updated <?= e($CFG['legal']['updated']) ?></p>
  <h1>TERMS OF USE</h1>
  <p class="lead">By using this website you accept the terms below. They cover the site itself, not a manufacturing contract - that is a separate signed document.</p>

  <h2>Information on this site</h2>
  <p>Lead times, minimums and capacities shown here are typical figures based on our own production history. They are commercial information, not an offer. The binding numbers for your project are the ones in the written quotation we send you.</p>

  <h2>The estimator</h2>
  <p>The production estimator is a planning aid. It returns indicative minimums and calendars from the parameters you choose and does not take into account materials, finishing, certification or plant load. No quotation, price or delivery commitment derives from it.</p>

  <h2>Quotations and orders</h2>
  <p>Quotations are valid for 30 calendar days unless stated otherwise, and are subject to confirmation of material prices and available capacity at the moment the order is placed. An order exists once the purchase order is signed and the opening payment is received.</p>

  <h2>Intellectual property</h2>
  <p>The TEXARA name, logo, texts and design of this site belong to <?= e($CFG['legal']['company']) ?>. The designs, patterns, brands and technical files you send us remain entirely yours; we use them only to quote and manufacture your order.</p>

  <h2>Liability</h2>
  <p>We keep this site accurate and available, but we do not guarantee uninterrupted service or freedom from error. We are not liable for decisions taken solely on the basis of the indicative information published here.</p>

  <h2>Governing law</h2>
  <p>These terms are governed by the laws of the Republic of Colombia. Any dispute related to the site will be heard by the courts of Medellin, Antioquia.</p>

  <h2>Contact</h2>
  <p><a href="mailto:<?= e($B['email']) ?>"><?= e($B['email']) ?></a> - <?= e($B['phone']) ?></p>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
