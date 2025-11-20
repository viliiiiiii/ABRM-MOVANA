document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('#lf-results tbody');
    fetch('api.php?action=list')
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            tableBody.innerHTML = data.data.map(item => `<tr><td><a href="item.php?id=${item.id}">${item.description}</a></td><td>${item.state}</td><td>${item.location}</td><td>recent</td></tr>`).join('');
        });
});
