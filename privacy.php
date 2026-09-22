<?php
$pageTitle = 'Privacy policy | TEXARA';
$pageDesc  = 'How TEXARA handles the data you send through this website.';
require __DIR__ . '/inc/header.php';
?>

<section class="doc wrap">
  <p class="doc__meta">Last updated <?= e($CFG['legal']['updated']) ?></p>
  <h1>PRIVACY POLICY</h1>
  <p class="lead"><?= e($CFG['legal']['company']) ?> (<?= e($CFG['legal']['nit']) ?>) operates this website. This page explains what we collect and what we do with it.</p>

  <h2>What we collect</h2>
  <p>Only what you type into the quote form: name, company, email, phone, product line, volume and the description of your project. Our server also keeps the usual technical log (IP address, date, browser) that any web host records.</p>

  <h2>Why we collect it</h2>
  <p>To answer your request, prepare a quotation and keep in touch about that project. We do not sell, rent or share your data with third parties for marketing.</p>

  <h2>How long we keep it</h2>
  <p>Commercial enquiries are kept for up to three years so we can pick a conversation back up. You can ask us to delete yours at any time.</p>

  <h2>Confidentiality of your project</h2>
  <p>Tech packs, drawings, samples and prices you share with us are treated as confidential. We sign a mutual NDA before any technical file is exchanged, and we never run your patterns or molds for another client.</p>

  <h2>Cookies</h2>
  <p>This site sets no advertising or tracking cookies. Fonts are served by Google Fonts, which receives your IP address as part of that request.</p>

  <h2>Your rights</h2>
  <p>Under Colombian Law 1581 of 2012 you may ask us to access, correct, update or delete your personal data. Write to <a href="mailto:<?= e($B['email']) ?>"><?= e($B['email']) ?></a> and we will answer within 15 working days.</p>

  <h2>Contact</h2>
  <p><?= e($CFG['legal']['company']) ?><br>
     <?= e($B['address']) ?><br>
     <a href="mailto:<?= e($B['email']) ?>"><?= e($B['email']) ?></a> - <?= e($B['phone']) ?></p>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
