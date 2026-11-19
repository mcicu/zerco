<?php
require_once __DIR__ . '/bootstrap.php';
$page = isset($page) ? $page : 'home';
$title = isset($title) ? $title : 'Inginerie pentru ceea ce urmează';
$description = isset($description) ? $description : 'Zerco Infrastructure — proiectare și consultanță pentru infrastructură rutieră, poduri, construcții civile și rețele de utilități.';
$canonicalFile = basename($_SERVER['SCRIPT_NAME']);
$canonical = $site['url'] . '/' . ($canonicalFile === 'index.php' ? '' : $canonicalFile);
if ($canonicalFile === 'serviciu.php' && isset($slug, $services[$slug])) { $canonical .= '?serviciu=' . rawurlencode($slug); }
?>
<!doctype html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#123b3a">
    <title><?= e($title) ?> | Zerco Infrastructure</title>
    <meta name="description" content="<?= e($description) ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ro_RO">
    <meta property="og:title" content="<?= e($title) ?> | Zerco Infrastructure">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($site['url']) ?>/assets/images/bridge.jpg">
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body id="top" class="page-<?= e($page) ?>">
<a class="skip-link" href="#continut">Sari la conținut</a>
<div class="topbar"><div class="container"><span>Viziune clară. Inginerie responsabilă.</span><a href="contact.php">Să construim următorul proiect împreună.</a></div></div>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="index.php" aria-label="Zerco Infrastructure — Acasă"><svg class="brand-mark" viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M5 7h38L17 33h26v8H5v-8L31 15H5V7Z" fill="currentColor"/><path d="M5 22h12L5 34V22Z" fill="#bce467"/></svg><span><strong>zerco<span class="brand-period">.</span></strong><small>INFRASTRUCTURE</small></span></a>
        <button class="menu-toggle" type="button" aria-label="Deschide meniul" aria-expanded="false" aria-controls="main-nav"><span></span><span></span><span></span></button>
        <nav id="main-nav" class="main-nav" aria-label="Navigare principală">
            <?php foreach (['home' => ['index.php', 'Acasă'], 'about' => ['despre-noi.php', 'Despre noi'], 'services' => ['servicii.php', 'Servicii'], 'projects' => ['proiecte.php', 'Proiecte'], 'domains' => ['domenii.php', 'Domenii']] as $key => $nav): ?>
                <a href="<?= $nav[0] ?>"<?= $page === $key ? ' class="active" aria-current="page"' : '' ?>><?= $nav[1] ?></a>
            <?php endforeach; ?>
            <a class="button button-dark nav-contact" href="contact.php"<?= $page === 'contact' ? ' aria-current="page"' : '' ?>>Hai să discutăm</a>
        </nav>
    </div>
</header>
<main id="continut">
