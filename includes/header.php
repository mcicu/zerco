<?php
require_once __DIR__ . '/bootstrap.php';
$page = isset($page) ? $page : 'home';
$title = isset($title) ? $title : 'Inginerie pentru ceea ce urmează';
$description = isset($description) ? $description : 'Zerco Infrastructure — proiectare și consultanță pentru infrastructură rutieră și poduri.';
$canonicalFile = basename($_SERVER['SCRIPT_NAME'], '.php');
$canonical = $site['url'] . '/' . ($canonicalFile === 'index' ? '' : $canonicalFile);
if ($canonicalFile === 'serviciu' && isset($slug, $services[$slug])) { $canonical .= '?serviciu=' . rawurlencode($slug); }
if ($canonicalFile === 'serviciu' && isset($scenario)) { $canonical .= '&scenariu=' . rawurlencode($scenario['slug']); }
$styleVersion = substr(hash_file('sha256', __DIR__ . '/../assets/css/style.css'), 0, 12);
$scriptVersion = substr(hash_file('sha256', __DIR__ . '/../assets/js/main.js'), 0, 12);
?>
<!doctype html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#153b5b">
    <title><?= e($title) ?> | Zerco Infrastructure</title>
    <meta name="description" content="<?= e($description) ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ro_RO">
    <meta property="og:title" content="<?= e($title) ?> | Zerco Infrastructure">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($site['url']) ?>/assets/images/<?= e(isset($scenario) ? $scenario['image'] : 'bridge.jpg') ?>">
    <link rel="icon" type="image/svg+xml" href="/assets/favicon.svg">
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= e($styleVersion) ?>">
    <script src="/assets/js/main.js?v=<?= e($scriptVersion) ?>" defer></script>
</head>
<body id="top" class="page-<?= e($page) ?>">
<a class="skip-link" href="#continut">Sari la conținut</a>
<div class="topbar"><div class="container"><span>Viziune clară. Inginerie responsabilă.</span><a href="/contact">Să construim următorul proiect împreună.</a></div></div>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="/" aria-label="Zerco Infrastructure — Acasă"><img class="brand-logo" src="/assets/images/logo-zerco.png" alt="Zerco Infrastructure" width="768" height="512"></a>
        <button class="menu-toggle" type="button" aria-label="Deschide meniul" aria-expanded="false" aria-controls="main-nav"><span></span><span></span><span></span></button>
        <nav id="main-nav" class="main-nav" aria-label="Navigare principală">
            <?php foreach (['home' => ['/', 'Acasă'], 'about' => ['/despre-noi', 'Despre noi'], 'services' => ['/servicii', 'Servicii'], 'projects' => ['/proiecte', 'Proiecte'], 'domains' => ['/domenii', 'Domenii']] as $key => $nav): ?>
                <a href="<?= $nav[0] ?>"<?= $page === $key ? ' class="active" aria-current="page"' : '' ?>><?= $nav[1] ?></a>
            <?php endforeach; ?>
            <a class="button button-dark nav-contact" href="/contact"<?= $page === 'contact' ? ' aria-current="page"' : '' ?>>Hai să discutăm</a>
        </nav>
    </div>
</header>
<main id="continut">
