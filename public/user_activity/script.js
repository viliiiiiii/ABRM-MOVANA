document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('#activity-table tbody');
    fetch('api.php?action=list').then(r => r.json()).then(res => {
        if (!res.success) return;
        tbody.innerHTML = res.data.map(row => `<tr><td>${row.user}</td><td>${row.action}</td><td>${row.module}</td><td>${row.at}</td></tr>`).join('');
    });
});
