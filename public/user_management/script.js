document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('#users-table tbody');
    fetch('api.php?action=list').then(r => r.json()).then(res => {
        if (!res.success) return;
        tbody.innerHTML = res.data.map(row => `<tr><td>${row.name}</td><td>${row.email}</td><td>${row.role}</td><td>${row.status}</td></tr>`).join('');
    });
});
