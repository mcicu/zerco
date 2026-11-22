<?php
require __DIR__ . '/includes/bootstrap.php';
ini_set('session.use_strict_mode', '1');
session_name('zerco_contact');
session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', 'httponly' => true, 'samesite' => 'Lax']);
session_start();
header('Cache-Control: no-store, private');
header('X-Robots-Tag: noindex');
if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }
if (!isset($_SESSION['opened_at'])) { $_SESSION['opened_at'] = time(); }
function contact_value($key) { return isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : ''; }
function contact_length($value) { $length = preg_match_all('/./us', $value, $matches); return $length === false ? 0 : $length; }
$values = ['name' => '', 'email' => '', 'company' => '', 'phone' => '', 'service' => '', 'message' => ''];
$errors = [];
$accepted = false;
$success = !empty($_SESSION['sent']);
unset($_SESSION['sent']);
$ready = filter_var($site['email'], FILTER_VALIDATE_EMAIL) && filter_var($site['from'], FILTER_VALIDATE_EMAIL) && is_callable('mail');
if (isset($_GET['serviciu']) && is_string($_GET['serviciu']) && isset($services[$_GET['serviciu']])) { $values['service'] = $_GET['serviciu']; }
if (isset($_GET['subiect']) && $_GET['subiect'] === 'colaborare') { $values['service'] = 'colaborare'; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $key => $unused) { $values[$key] = contact_value($key); }
    $accepted = contact_value('privacy') === '1';
    if (!hash_equals($_SESSION['csrf'], contact_value('csrf'))) { $errors[] = 'Sesiunea formularului a expirat. Reîncarcă pagina și încearcă din nou.'; }
    if (contact_value('website') !== '' || time() - $_SESSION['opened_at'] < 2) { $errors[] = 'Mesajul nu a putut fi trimis. Te rugăm să încerci din nou.'; }
    if (isset($_SESSION['last_sent']) && time() - $_SESSION['last_sent'] < 60) { $errors[] = 'Te rugăm să aștepți un minut înainte de a trimite un nou mesaj.'; }
    if (contact_length($values['name']) < 2 || contact_length($values['name']) > 150) { $errors[] = 'Completează numele (între 2 și 150 de caractere).'; }
    if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL) || strlen($values['email']) > 254 || preg_match('/[\r\n]/', $values['email'])) { $errors[] = 'Introdu o adresă de email validă.'; }
    if (strlen($values['company']) > 180 || strlen($values['phone']) > 50) { $errors[] = 'Verifică lungimea numelui companiei și a numărului de telefon.'; }
    if ($values['service'] !== '' && $values['service'] !== 'colaborare' && !isset($services[$values['service']])) { $errors[] = 'Alege un serviciu din listă.'; }
    if (contact_length($values['message']) < 20 || contact_length($values['message']) > 3000) { $errors[] = 'Descrie proiectul într-un mesaj între 20 și 3.000 de caractere.'; }
    if (!$accepted) { $errors[] = 'Confirmă că ai citit informarea privind datele personale.'; }
    if (!$ready) { $errors[] = 'Trimiterea mesajelor nu este încă activată. Revino după configurarea adresei de contact.'; }
    if (!$errors) {
        $serviceName = isset($services[$values['service']]) ? $services[$values['service']]['title'] : ($values['service'] === 'colaborare' ? 'Cariere și colaborări' : 'Discuție generală');
        $body = "Mesaj nou prin zercoinfrastructure.ro\n\nNume: " . $values['name'] . "\nEmail: " . $values['email'] . "\nCompanie: " . $values['company'] . "\nTelefon: " . $values['phone'] . "\nServiciu: " . $serviceName . "\n\nMesaj:\n" . $values['message'] . "\n\nInformarea privind datele personale a fost confirmată în formular.";
        $headers = ['From: Zerco Infrastructure <' . $site['from'] . '>', 'Reply-To: ' . $values['email'], 'MIME-Version: 1.0', 'Content-Type: text/plain; charset=UTF-8'];
        if (@mail($site['email'], 'Solicitare noua - Zerco Infrastructure', $body, implode("\r\n", $headers))) {
            $_SESSION['sent'] = true;
            $_SESSION['last_sent'] = time();
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
            $_SESSION['opened_at'] = time();
            header('Location: /contact#formular', true, 303);
            exit;
        }
        error_log('Zerco: mail transport rejected the contact message.');
        $errors[] = 'Serverul nu a putut prelua mesajul. Încearcă mai târziu sau scrie-ne direct la adresa de email afișată.';
    }
}
$page = 'contact'; $title = 'Contact'; $hideCta = true;
require __DIR__ . '/includes/header.php';
page_intro('Contact', 'Orice proiect bun începe<br><em>cu o conversație.</em>', 'Spune-ne ce vrei să dezvolți, unde și în ce etapă te afli. De aici putem defini împreună următorii pași.');
?>
<section class="section"><div class="container contact-layout"><div class="contact-copy"><span class="eyebrow">Hai să discutăm</span><h2>De la prima întrebare,<br>la o direcție clară.</h2><p>Nu ai nevoie de o temă completă ca să începi dialogul. Sunt suficiente câteva detalii despre investiție și despre provocările pe care le întâmpini.</p><div class="contact-item"><?= icon('mail') ?><div><strong>Contact direct</strong><?php if ($site['email']): ?><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a><?php else: ?><span>Adresa de contact va fi disponibilă la lansare.</span><?php endif; ?></div></div><div class="contact-item"><?= icon('compass') ?><div><strong>Proiectare & consultanță</strong><span>Infrastructură rutieră și poduri</span></div></div><div class="contact-note"><strong>Ce ne ajută la prima discuție?</strong><p>Localizarea investiției, tipul lucrării, etapa curentă și un termen orientativ. Nu include documente sau date personale sensibile în mesaj.</p></div></div><div id="formular">
<?php if ($success): ?><div class="form-message success" role="status"><strong>Mesajul a fost preluat de serverul de email.</strong><br>Îți mulțumim pentru detalii. Dacă ai nevoie de o completare, ne poți scrie direct.</div><?php endif; ?>
<?php if ($errors): ?><div class="form-message error" role="alert"><strong>Verifică următoarele informații:</strong><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<?php if (!$ready): ?><div class="notice" style="margin-bottom:24px">Formularul este momentan indisponibil. Trimiterea mesajelor va fi activată după configurarea contactului.</div><?php endif; ?>
<form class="contact-form" method="post" action="/contact#formular"><h2>Povestește-ne despre proiect</h2><p class="form-intro">Câteva detalii sunt un punct bun de plecare.</p><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><div class="honeypot" aria-hidden="true"><label for="website">Website personal</label><input type="text" name="website" id="website" tabindex="-1" autocomplete="off"></div><div class="form-row"><div class="field"><label for="name">Nume și prenume *</label><input id="name" name="name" autocomplete="name" required maxlength="150" value="<?= e($values['name']) ?>"></div><div class="field"><label for="email">Email *</label><input type="email" id="email" name="email" autocomplete="email" required maxlength="254" value="<?= e($values['email']) ?>"></div></div><div class="form-row"><div class="field"><label for="company">Companie</label><input id="company" name="company" autocomplete="organization" maxlength="180" value="<?= e($values['company']) ?>"></div><div class="field"><label for="phone">Telefon</label><input type="tel" id="phone" name="phone" autocomplete="tel" maxlength="50" value="<?= e($values['phone']) ?>"></div></div><div class="field"><label for="service">Ce te interesează?</label><select id="service" name="service"><option value="">Alege un domeniu</option><?php foreach ($services as $slug => $s): ?><option value="<?= e($slug) ?>"<?= $values['service'] === $slug ? ' selected' : '' ?>><?= e($s['title']) ?></option><?php endforeach; ?><option value="colaborare"<?= $values['service'] === 'colaborare' ? ' selected' : '' ?>>Cariere & colaborări</option></select></div><div class="field"><label for="message">Despre proiectul tău *</label><textarea id="message" name="message" rows="5" minlength="20" maxlength="3000" required placeholder="Tipul investiției, localizarea și cum te putem ajuta…"><?= e($values['message']) ?></textarea></div><label class="checkbox-label"><input type="checkbox" name="privacy" value="1" required<?= $accepted ? ' checked' : '' ?>><span>Am citit <a href="/confidentialitate" target="_blank" rel="noopener">informarea privind datele personale</a> și înțeleg cum sunt folosite datele pentru a răspunde solicitării. *</span></label><button class="button button-dark" type="submit"<?= !$ready ? ' disabled' : '' ?>>Trimite mesajul</button><p class="required-note">Câmpurile marcate cu * sunt obligatorii.</p></form></div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
