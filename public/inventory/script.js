document.addEventListener('DOMContentLoaded', () => {
    const invBody = document.querySelector('#inventory-table tbody');
    fetch('api.php?action=list').then(r => r.json()).then(res => {
        if (!res.success) return;
        invBody.innerHTML = res.data.map(row => `<tr><td>${row.name}</td><td>${row.sku}</td><td>${row.qty}</td><td>${row.status}</td><td>${row.alerts}</td></tr>`).join('');
    });
    const moveBody = document.querySelector('#movement-table tbody');
    if (moveBody) {
        fetch('api.php?action=movements').then(r => r.json()).then(res => {
            moveBody.innerHTML = res.data.map(row => `<tr><td>${row.date}</td><td>${row.item}</td><td>${row.from}</td><td>${row.to}</td><td>${row.qty}</td><td>${row.reason}</td></tr>`).join('');
        });
    }
    const stockBody = document.querySelector('#stocktake-table tbody');
    if (stockBody) {
        fetch('api.php?action=stocktakes').then(r => r.json()).then(res => {
            stockBody.innerHTML = res.data.map(row => `<tr><td>${row.name}</td><td>${row.location}</td><td>${row.date}</td><td>${row.status}</td></tr>`).join('');
        });
    }
});
