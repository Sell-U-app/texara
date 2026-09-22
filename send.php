<?php
/**
 * RFQ form handler.
 * - honeypot + minimal validation
 * - appends every lead to storage/leads.csv (backup if mail() fails)
 * - sends the notification with mail()
 */
declare(strict_types=1);

$CFG = require __DIR__ . '/config.php';

function back(string $code)
{
    header('Location: index.php?err=' . urlencode($code) . '#contact', true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php', true, 303);
    exit;
}

// Honeypot: bots fill everything.
if (trim((string) ($_POST['website'] ?? '')) !== '') {
    header('Location: thanks.php', true, 303);
    exit;
}

$field = static function (string $k, int $max = 200): string {
    $v = trim((string) ($_POST[$k] ?? ''));
    $v = str_replace(["\r", "\n", "\0"], ' ', $v);
    return mb_substr($v, 0, $max);
};

$name    = $field('name', 80);
$company = $field('company', 80);
$email   = $field('email', 120);
$phone   = $field('phone', 40);
$line    = $field('line', 80);
$volume  = $field('volume', 40);
$plan    = $field('plan', 300);
$message = mb_substr(trim((string) ($_POST['message'] ?? '')), 0, 2000);
$consent = isset($_POST['consent']);

if ($name === '' || $company === '' || $message === '') {
    back('fields');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    back('email');
}
if (!$consent) {
    back('consent');
}

$when = date('Y-m-d H:i:s');
$ip   = (string) ($_SERVER['REMOTE_ADDR'] ?? '');

// ---- CSV backup -------------------------------------------------------
$csv = $CFG['mail']['log_csv'];
$dir = dirname($csv);
if (!is_dir($dir)) {
    @mkdir($dir, 0775, true);
}
if ($fh = @fopen($csv, 'a')) {
    if (filesize($csv) === 0 || filesize($csv) === false) {
        fputcsv($fh, ['date', 'name', 'company', 'email', 'phone', 'line', 'volume', 'estimator', 'message', 'ip']);
    }
    fputcsv($fh, [$when, $name, $company, $email, $phone, $line, $volume, $plan, $message, $ip]);
    fclose($fh);
} else {
    // The CSV is the safety net under mail(). Losing it silently is how leads
    // disappear for weeks, so it goes to the server log.
    error_log('texara: FAILED to write the lead to ' . $csv . ' - check that the volume is mounted and writable by www-data');
}

// ---- Notification -----------------------------------------------------
$body = "New RFQ from " . $CFG['brand']['domain'] . "\n"
      . str_repeat('-', 46) . "\n"
      . "Date:      $when\n"
      . "Name:      $name\n"
      . "Company:   $company\n"
      . "Email:     $email\n"
      . "Phone:     " . ($phone !== '' ? $phone : '-') . "\n"
      . "Line:      $line\n"
      . "Volume:    $volume\n"
      . "Estimator: " . ($plan !== '' ? $plan : '-') . "\n"
      . str_repeat('-', 46) . "\n"
      . "$message\n"
      . str_repeat('-', 46) . "\n"
      . "IP: $ip\n";

$headers = implode("\r\n", [
    'From: ' . $CFG['brand']['name'] . ' <' . $CFG['mail']['from'] . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion(),
]);

$sent = @mail($CFG['mail']['to'], $CFG['mail']['subject'] . ' - ' . $company, $body, $headers, '-f' . $CFG['mail']['from']);

if ($sent) {
    error_log('texara: RFQ notification accepted by the MTA for ' . $CFG['mail']['to']);
} else {
    // Not fatal - the lead is already in the CSV - but it must not be silent.
    error_log('texara: mail() FAILED for ' . $CFG['mail']['to'] . ' - the lead from ' . $email . ' is only in ' . $csv);
}

header('Location: thanks.php', true, 303);
exit;
