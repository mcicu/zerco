<section class="company-stats" aria-label="Zerco în cifre">
    <div class="container">
        <dl class="stats-grid">
            <div class="stat-item">
                <dt>Proiecte finalizate</dt>
                <dd class="stat-value" aria-label="<?= e($stats['completed_projects']) ?>"><span data-counter="<?= e($stats['completed_projects']) ?>" aria-hidden="true"><?= e($stats['completed_projects']) ?></span></dd>
            </div>
            <div class="stat-item">
                <dt>Autorizații emise</dt>
                <dd class="stat-value" aria-label="<?= e($stats['issued_permits']) ?>"><span data-counter="<?= e($stats['issued_permits']) ?>" aria-hidden="true"><?= e($stats['issued_permits']) ?></span></dd>
            </div>
        </dl>
    </div>
</section>
