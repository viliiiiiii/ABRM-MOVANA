document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('#taxi-table tbody');
    fetch('api.php?action=list').then(r => r.json()).then(res => {
        if (!res.success) return;
        tbody.innerHTML = res.data.map(row => `<tr><td>${row.date}</td><td>${row.start}</td><td>${row.destination}</td><td>${row.guest}</td><td>${row.driver}</td><td>${row.price}</td></tr>`).join('');
    });
});
