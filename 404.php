<?php http_response_code(404); $title = 'Pagina nu a fost găsită'; $hideCta = true; require __DIR__ . '/includes/header.php'; ?>
<div class="container error-page"><span class="eyebrow">O rută care nu mai duce nicăieri</span><h1>404</h1><h2>Hai să revenim pe drumul bun.</h2><p>Pagina căutată nu există sau adresa introdusă este incompletă.</p><a class="button button-dark" href="index.php">Înapoi la pagina principală</a></div>
<?php require __DIR__ . '/includes/footer.php'; ?>
