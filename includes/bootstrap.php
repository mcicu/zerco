<?php
require_once __DIR__ . '/data.php';
function e($value) { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); }
function icon($name, $class = '') {
    $paths = [
        'road' => '<path d="m6 3-3 18M18 3l3 18M12 3v4m0 3v4m0 3v4"/>',
        'bridge' => '<path d="M2 15h20M5 7v14M19 7v14M5 8c4 8 10 8 14 0M2 10l3-2m14 0 3 2M9 12v3m6-3v3"/>',
        'compass' => '<circle cx="12" cy="12" r="9"/><path d="m16 8-2.5 5.5L8 16l2.5-5.5L16 8Z"/>',
        'helmet' => '<path d="M4 15v-3a8 8 0 0 1 16 0v3M9 4v7m6-7v7M2 15h20v4H2z"/>',
        'check' => '<path d="m5 12 4 4L19 6"/>',
        'plus' => '<path d="M12 5v14M5 12h14"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 6 9 7 9-7"/>',
        'pin' => '<path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z"/><circle cx="12" cy="10" r="2"/>',
    ];
    return '<svg class="icon ' . e($class) . '" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . (isset($paths[$name]) ? $paths[$name] : $paths['compass']) . '</svg>';
}
function service_card($slug, $service) {
    echo '<a class="service-card" href="serviciu.php?serviciu=' . e($slug) . '"><span class="service-icon">' . icon($service['icon']) . '</span><h3>' . e($service['title']) . '</h3><p>' . e($service['short']) . '</p><span class="card-link">Descoperă serviciul <span aria-hidden="true">+</span></span></a>';
}
function page_intro($eyebrow, $title, $description) {
    echo '<section class="page-intro"><div class="container"><div class="breadcrumb"><a href="index.php">Acasă</a><span>/</span><span>' . e($eyebrow) . '</span></div><span class="eyebrow">' . e($eyebrow) . '</span><h1>' . $title . '</h1><p>' . e($description) . '</p></div></section>';
}
function project_card($p) {
    echo '<article class="project-card" data-category="' . e($p['category']) . '"><a href="serviciu.php?serviciu=' . e($p['service']) . '&amp;scenariu=' . e($p['slug']) . '"><div class="project-image"><img src="assets/images/' . e($p['image']) . '" alt="" width="800" height="600" loading="lazy"><span class="image-tag">Scenariu de proiect</span></div><div class="project-copy"><span class="eyebrow">' . e($p['label']) . '</span><h3>' . e($p['title']) . '</h3><p>' . e($p['text']) . '</p><span class="card-link">Explorează soluția <span aria-hidden="true">+</span></span></div></a></article>';
}
