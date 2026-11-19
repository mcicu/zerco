<?php
require __DIR__ . '/includes/bootstrap.php';
$slug = isset($_GET['serviciu']) && is_string($_GET['serviciu']) ? $_GET['serviciu'] : '';
if (!isset($services[$slug])) { require __DIR__ . '/404.php'; exit; }
$service = $services[$slug]; $page = 'services'; $title = $service['title']; $description = $service['text'];
require __DIR__ . '/includes/header.php';
page_intro('Servicii', e($service['title']), $service['text']);
?>
<section class="section"><div class="container service-detail-grid"><div class="service-detail-main"><img src="assets/images/<?= e($service['image']) ?>" alt="Imagine ilustrativă pentru <?= e($service['title']) ?>" width="1200" height="800"><h2>Ce poate include colaborarea</h2><ul class="check-list"><?php foreach ($service['items'] as $item): ?><li><?= icon('check') ?><span><?= e($item) ?></span></li><?php endforeach; ?></ul><h2>Rezultatul urmărit</h2><p><?= e($service['deliverable']) ?></p><h2>Cum începem</h2><p>Discutăm despre amplasament, scopul investiției și etapa în care se află proiectul. Analizăm informațiile disponibile și stabilim documentele suplimentare de care avem nevoie.</p><p>Întinderea serviciilor, termenele și responsabilitățile sunt definite în oferta de colaborare. Activitățile supuse autorizării se confirmă în funcție de specialiștii implicați și de cerințele proiectului.</p></div><aside><div class="sidebar-panel"><h2>Serviciile Zerco</h2><nav class="sidebar-links" aria-label="Alte servicii"><?php foreach ($services as $key => $s): ?><a href="serviciu.php?serviciu=<?= e($key) ?>"<?= $key === $slug ? ' class="active" aria-current="page"' : '' ?>><?= e($s['title']) ?></a><?php endforeach; ?></nav></div><div class="sidebar-panel sidebar-dark"><h2>Ai un proiect în această direcție?</h2><p>Spune-ne pe scurt ce vrei să dezvolți și în ce etapă te afli.</p><a class="button button-lime" href="contact.php?serviciu=<?= e($slug) ?>">Discută cu noi</a></div></aside></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
