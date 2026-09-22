</main>

<footer class="foot">
  <div class="foot__grid wrap">
    <div class="foot__brand">
      <?= lockup('white') ?>
      <p class="foot__claim">Nearshore contract manufacturing in Colombia for brands that sell in the United States.</p>
      <div class="foot__cta">
        <a class="btn btn--green" href="index.php#contact">Request a quote</a>
        <a class="btn btn--ghostw" href="<?= e(wa_link($CFG)) ?>" target="_blank" rel="noopener">WhatsApp</a>
      </div>
    </div>

    <div class="foot__col">
      <h4>Site</h4>
      <a href="index.php#capabilities">Capabilities</a>
      <a href="index.php#process">Process</a>
      <a href="index.php#why">Why Colombia</a>
      <a href="index.php#estimator">Estimator</a>
      <a href="index.php#standards">Standards</a>
      <a href="index.php#faq">FAQ</a>
    </div>

    <div class="foot__col">
      <h4>Lines</h4>
      <span>Apparel &amp; cut and sew</span>
      <span>Home &amp; textile goods</span>
      <span>Light assembly &amp; kitting</span>
      <span>Packaging &amp; FBA prep</span>
    </div>

    <div class="foot__col">
      <h4>Contact</h4>
      <a href="mailto:<?= e($B['email']) ?>"><?= e($B['email']) ?></a>
      <a href="tel:<?= e(preg_replace('/\s+/', '', $B['phone'])) ?>"><?= e($B['phone']) ?></a>
      <span><?= e($B['address']) ?></span>
      <span><?= e($B['hours']) ?></span>
      <div class="foot__social">
        <?php foreach ($B['social'] as $net => $url): ?>
          <a href="<?= e($url) ?>" target="_blank" rel="noopener"><?= e($net) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="foot__bar wrap">
    <span>&copy; <?= date('Y') ?> <?= e($CFG['legal']['company']) ?> - <?= e($CFG['legal']['nit']) ?></span>
    <span class="foot__legal">
      <a href="privacy.php">Privacy</a>
      <a href="terms.php">Terms</a>
    </span>
  </div>
</footer>

<a class="wa" href="<?= e(wa_link($CFG)) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2m0 1.82c2.16 0 4.19.84 5.72 2.37a8.04 8.04 0 0 1 2.37 5.72c0 4.46-3.63 8.09-8.1 8.09a8.2 8.2 0 0 1-4.18-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.05 8.05 0 0 1-1.24-4.31c0-4.46 3.63-8.09 8.09-8.09m-4.6 4.18c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.69 2.58 4.1 3.62.57.25 1.02.4 1.37.51.58.18 1.1.16 1.52.1.46-.07 1.43-.59 1.63-1.15.2-.56.2-1.04.14-1.15-.06-.1-.22-.16-.46-.28-.24-.12-1.43-.7-1.65-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.02-.38-1.94-1.2-.72-.64-1.2-1.43-1.34-1.67-.14-.24-.02-.37.1-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.47-.4-.4-.54-.41h-.46Z"/></svg>
</a>

<script src="assets/js/main.js?v=1.0.0" defer></script>
</body>
</html>
