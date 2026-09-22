# TEXARA - nearshore contract manufacturing (PHP site)

Single-page marketing site in English, plain PHP, no build step, no dependencies.
Built for NameCheap / cPanel shared hosting.

## Files

```
index.php        the whole landing page (sections read from config.php)
config.php       ALL copy, numbers and contact data - edit only this for content changes
send.php         RFQ form handler: honeypot + validation + mail() + CSV backup
thanks.php       post-submit page
privacy.php      privacy policy
terms.php        terms of use
inc/header.php   head, topbar, sticky nav (shared)
inc/footer.php   footer, WhatsApp button, script tag (shared)
inc/helpers.php  e(), hl() green-highlight, inline logo symbol/lockup, wa_link()
assets/css/style.css
assets/js/main.js
assets/img/      logo variants (SVG symbol, wordmark PNG, OG image, favicon)
storage/         leads.csv is written here (blocked by .htaccess)
.htaccess        https + non-www redirect, /privacy -> privacy.php, gzip, cache
Dockerfile       Railway image (php:8.3-apache, .htaccess honoured)
docker/          entrypoint that binds Apache to $PORT
railway.json     tells Railway to build the Dockerfile
```

## Before going live

In `config.php`:

1. `brand.domain`, `brand.url` - real domain.
2. `brand.email`, `brand.phone`, `brand.whatsapp` (digits only, e.g. `573001234567`), `brand.address`.
3. `brand.social` - real LinkedIn / Instagram URLs.
4. `mail.to` - inbox that receives the RFQs.
5. `mail.from` - **must be an address of the same domain** (e.g. `no-reply@texara.co`), otherwise
   shared hosting silently drops the mail.
6. `legal.company`, `legal.nit`.

Then in `.htaccess`, `robots.txt` and `sitemap.xml` replace `texara.co` with the real domain.

## Deploy (cPanel)

1. Upload the whole folder content into `public_html/` (or the domain's document root).
2. Make sure `storage/` exists and is writable (755).
3. PHP 7.4+ works; 8.x recommended.
4. Check `https://yourdomain/` and send a test message through the form.
5. If the mail does not arrive, the lead is still saved in `storage/leads.csv`
   (download it from File Manager - the web is blocked from reading it).

## Deploy (Railway)

Railway builds the `Dockerfile` (php:8.3-apache) and serves the same files, so the
site behaves exactly as it does on cPanel - `.htaccess` included.

1. Railway -> New Project -> Deploy from GitHub repo -> `Sell-U-app/texara`.
2. Nothing to configure: `docker/entrypoint.sh` makes Apache listen on `$PORT`.
3. Settings -> Networking -> Generate Domain (or point `texara.co` there with the
   CNAME Railway gives you).

### Mail

The container has no MTA of its own, so the image installs `msmtp` and `msmtp-mta`,
which provides the `/usr/sbin/sendmail` that PHP's `mail()` shells out to. `send.php`
is unchanged and stays portable to cPanel. Set these on the Railway service:

| Variable | Example | |
|---|---|---|
| `SMTP_HOST` | `smtp.resend.com` | required |
| `SMTP_USER` | `resend` | required |
| `SMTP_PASS` | the provider's API key / password | required |
| `SMTP_PORT` | `587` | optional - 587 by default; `465` switches to implicit TLS |
| `MAIL_FROM` | `no-reply@texara.co` | envelope sender; must be a domain the provider lets you send from |
| `MAIL_TO` | `hello@texara.co` | inbox that receives the RFQs |

With none of them set the site still boots and the form still answers - the log
says loudly that notifications are off, and every lead goes to the CSV.

Whatever provider is used, `MAIL_FROM` has to be on a domain that is verified
there (SPF/DKIM), or the mail gets dropped or spam-filed.

### Storage

A Railway volume is mounted at `/var/www/html/storage` so `leads.csv` survives
redeploys. The mount arrives empty and owned by root, which would both hide the
image's `storage/.htaccess` and leave Apache unable to write, so the entrypoint
fixes the ownership and restores that file on every boot.

To read the leads: `railway volume files list /` (or `railway volume browse /`).

## Local preview

```bash
php -S localhost:8099 -t .
```

## Design notes

- Palette locked to the logo: ink `#0B0B0B`, green `#0B8938` (`--green-l #14A845` for accents).
- Type: Anton (display) + Barlow (body) + Montserrat 800 (the TEXARA wordmark).
- The logo is drawn as inline SVG in `inc/helpers.php`, so it stays crisp and can be recolored.
- Headlines paint the words inside `{{ }}` in green: `'TITLE WITH {{GREEN WORDS}}'` in config.php.
- The estimator in `assets/js/main.js` is indicative: lead time =
  `(base + sqrt(total/1000)*4 + (styles-1)*0.8) * complexity`. Tune `base`, `moq` and
  `sample` per category in `config.php` -> `estimator.categories`.
- Everything respects `prefers-reduced-motion`: the reduced-motion block kills the boot curtain,
  the orbs, the parallax and the reveal masks, and every element is shown in its final state.

### Motion

| Effect | Where |
|---|---|
| Boot curtain (mark + loading bar) | `.boot` in `inc/header.php`, removed by `main.js` (1.8s safety timeout) |
| Floating photos / badge / WhatsApp button | `@keyframes floatA/floatB/floatC/bob` |
| Drifting orbs | `.orb` spans in the hero and the estimator section |
| Headings rising behind their baseline | `.h2.reveal .ln` - the `.ln` span is added by `hl()` |
| Green panel uncovering each photo | `.shot:before` / `.cap__ph:before` |
| Parallax | `.par` + `data-par` (pixels of travel), driven by `main.js` |
| Pointer tilt | `.tilt` on capability and Why Colombia cards, fine pointers only |
| Nav hiding on scroll down | `.nav.is-hidden` |
| Shine sweep on buttons | `.btn:after` |

Do not put `clip-path` on an element that carries `.reveal`: the browser then reports a zero
intersection box and the IntersectionObserver never reveals it. That is why the heading mask uses
`overflow` on the heading plus a transform on the inner `.ln`.

## Photography

The hero carries two photos. They are **licensed stock shots of a real garment plant, not the
TEXARA plant** - placeholders until the real shoot happens. Swap them keeping the same file names
and aspect ratios and nothing else needs to change:

| File | Ratio | Where |
|---|---|---|
| `assets/img/hero-floor.jpg` | 4:3 (1200x900) | hero, phones and tablets |
| `assets/img/hero-floor-tall.jpg` | 4:5 (880x1100) | hero, from 1000px up |
| `assets/img/hero-detail.jpg` | 1:1 (700x700) | small overlapping tile |
| `assets/img/cap-apparel.jpg` | 16:9 (900x506) | capabilities card 01 |
| `assets/img/cap-home.jpg` | 16:9 (900x506) | capabilities card 02 |
| `assets/img/cap-assembly.jpg` | 16:9 (900x506) | capabilities card 03 |
| `assets/img/cap-packaging.jpg` | 16:9 (900x506) | capabilities card 04 |

The card photos are wired in `config.php` (`capabilities.items[].img` and `.alt`), so a new photo is
one line there plus the file.

Shoot notes for the replacements: wide shot of the sewing floor with operators working (not posing),
and a close-up of hands on a machine. The CSS already desaturates and adds a green tint, so flat
factory lighting works fine. Keep each file under ~200 KB.

Originals and an extra assembly-line frame are in `_source-photos/` (not deployed). The caption on
the main photo is set in `index.php` (`<figcaption>`); do not label it as the TEXARA plant until the
real photos are in.

Other natural photo slots for later: the capabilities cards and a band between Process and
Why Colombia.

### Staging vs. texara.co

While the site lives on the Railway URL it must not be indexed - the copy and the
photos are still placeholders. Both guards are scoped to `*.up.railway.app` in
`.htaccess`, so `texara.co` is untouched and nothing has to be undone at launch:

- `robots.txt` is rewritten to `robots-staging.txt` (`Disallow: /`).
- `X-Robots-Tag: noindex, nofollow` is sent, which is what actually keeps the URL
  out of the index when robots.txt alone would not.
