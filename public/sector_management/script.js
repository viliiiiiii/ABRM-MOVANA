document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('#sector-table tbody');
    fetch('api.php?action=list').then(r => r.json()).then(res => {
        if (!res.success) return;
        tbody.innerHTML = res.data.map(row => `<tr><td>${row.name}</td><td>${row.status}</td><td>${row.supervisors}</td></tr>`).join('');
    });
});
