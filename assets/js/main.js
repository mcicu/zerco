'use strict';
const counters = document.querySelectorAll('[data-counter]');
if (counters.length && 'IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const counterObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            counterObserver.unobserve(entry.target);
            const target = Number(entry.target.dataset.counter);
            const startedAt = performance.now();
            function updateCounter(now) {
                const progress = Math.min((now - startedAt) / 1000, 1);
                entry.target.textContent = String(Math.round(target * (1 - Math.pow(1 - progress, 3))));
                if (progress < 1) requestAnimationFrame(updateCounter);
            }
            requestAnimationFrame(updateCounter);
        });
    }, { threshold: 0.5 });
    counters.forEach(counter => counterObserver.observe(counter));
}
const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('.main-nav');
function closeMenu() {
    if (!menuButton || !navigation) return;
    navigation.classList.remove('open');
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-label', 'Deschide meniul');
}
if (menuButton && navigation) {
    menuButton.addEventListener('click', () => {
        const open = menuButton.getAttribute('aria-expanded') !== 'true';
        navigation.classList.toggle('open', open);
        menuButton.setAttribute('aria-expanded', String(open));
        menuButton.setAttribute('aria-label', open ? 'Închide meniul' : 'Deschide meniul');
    });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
            closeMenu();
            menuButton.focus();
        }
    });
    document.addEventListener('click', event => {
        if (!event.target.closest('.site-header')) closeMenu();
    });
    window.matchMedia('(min-width: 921px)').addEventListener('change', closeMenu);
}
document.querySelectorAll('.back-top').forEach(link => {
    link.addEventListener('click', event => {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
        const firstLink = document.querySelector('.site-header .brand');
        if (firstLink) firstLink.focus({ preventScroll: true });
    });
});
