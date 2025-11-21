document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('cms-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(form).entries());
        fetch('api.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({...data, action:'save'})})
            .then(r => r.json()).then(res => alert(res.message || 'Saved'));
    });
});
