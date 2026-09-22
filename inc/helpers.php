<?php
/** Shared helpers. */

if (!isset($CFG)) {
    $CFG = require __DIR__ . '/../config.php';
}

/** Escape for HTML output. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

/**
 * Render a headline, painting every {{ ... }} chunk in brand green.
 * "YOUR PRODUCT, {{BUILT CLOSER}}" -> YOUR PRODUCT, <em>BUILT CLOSER</em>
 */
function hl(string $s): string
{
    $s = e($s);
    $s = preg_replace('/\{\{(.+?)\}\}/s', '<em>$1</em>', $s);

    // .ln is the block the heading rises from behind on reveal (see .h2.reveal in style.css).
    // The mask lives on the inner span so the heading itself keeps a real intersection box.
    return '<span class="ln">' . $s . '</span>';
}

/** Inline brand symbol (T + leaf). $variant: color | white | ink */
function symbol(string $variant = 'color', string $class = ''): string
{
    $t    = $variant === 'white' ? '#FFFFFF' : ($variant === 'ink' ? '#0B0B0B' : '#0B0B0B');
    $leaf = $variant === 'white' ? '#FFFFFF' : '#0B8938';

    return '<svg class="sym ' . e($class) . '" viewBox="0 0 1000 1000" aria-hidden="true" focusable="false">'
        . '<path fill="' . $t . '" d="M 246,286 H 576 V 788 H 444 V 418 H 246 Z"/>'
        . '<path fill="' . $leaf . '" d="M 755,213 L 755,418 L 576,418 C 579.58,336 636.86,237.6 755,213 Z"/>'
        . '</svg>';
}

/** Full lockup: symbol + wordmark. $variant: ink | white */
function lockup(string $variant = 'ink', string $class = ''): string
{
    $sym = symbol($variant === 'white' ? 'white-leaf' : 'color');
    if ($variant === 'white') {
        $sym = '<svg class="sym" viewBox="0 0 1000 1000" aria-hidden="true" focusable="false">'
            . '<path fill="#FFFFFF" d="M 246,286 H 576 V 788 H 444 V 418 H 246 Z"/>'
            . '<path fill="#0B8938" d="M 755,213 L 755,418 L 576,418 C 579.58,336 636.86,237.6 755,213 Z"/>'
            . '</svg>';
    }

    return '<span class="lockup lockup--' . e($variant) . ' ' . e($class) . '">'
        . $sym . '<span class="lockup__word">TEXARA</span></span>';
}

/** WhatsApp deep link. */
function wa_link(array $cfg, string $text = 'Hi TEXARA, I would like to discuss a production run.'): string
{
    return 'https://wa.me/' . preg_replace('/\D/', '', $cfg['brand']['whatsapp']) . '?text=' . rawurlencode($text);
}
