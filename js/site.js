const sortField = document.querySelector('[data-auto-submit]');
if (sortField) {
    sortField.addEventListener('change', () => sortField.form.requestSubmit());
}

for (const cover of document.querySelectorAll('.cover-image')) {
    cover.addEventListener('error', () => { cover.hidden = true; });
    if (cover.complete && cover.naturalWidth === 0) {
        cover.hidden = true;
    }
}

const mobileMenu = document.querySelector('.mobile-menu');
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && mobileMenu.open) {
        mobileMenu.open = false;
        mobileMenu.querySelector('summary').focus();
    }
});
