'use strict';
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
const filters = document.querySelectorAll('[data-filter]');
const projects = document.querySelectorAll('[data-category]');
filters.forEach(button => {
    button.addEventListener('click', () => {
        const category = button.dataset.filter;
        filters.forEach(filter => filter.setAttribute('aria-pressed', String(filter === button)));
        let count = 0;
        projects.forEach(project => {
            project.hidden = category !== 'all' && project.dataset.category !== category;
            if (!project.hidden) count++;
        });
        const status = document.getElementById('filter-status');
        if (status) status.textContent = count + (count === 1 ? ' scenariu afișat' : ' scenarii afișate');
    });
});
document.querySelectorAll('.back-top').forEach(link => {
    link.addEventListener('click', event => {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
        const firstLink = document.querySelector('.site-header .brand');
        if (firstLink) firstLink.focus({ preventScroll: true });
    });
});
