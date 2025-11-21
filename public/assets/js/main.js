(function() {
    const root = document.documentElement;
    const themeToggle = document.querySelector('[data-toggle="theme"]');
    const preferred = document.body.dataset.theme || 'light';
    root.setAttribute('data-theme', preferred);

    function persistTheme(theme) {
        fetch('/public/user_profile/api.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({action: 'set_theme', theme: theme})
        }).catch(() => {});
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            persistTheme(next);
        });
    }
})();
