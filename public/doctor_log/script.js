document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('#doctor-table tbody');
    fetch('api.php?action=list').then(r => r.json()).then(res => {
        if (!res.success) return;
        tbody.innerHTML = res.data.map(row => `<tr><td>${row.room}</td><td>${row.called}</td><td>${row.arrived}</td><td>${row.doctor}</td><td>${row.status}</td></tr>`).join('');
    });
});
