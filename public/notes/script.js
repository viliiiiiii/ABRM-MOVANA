document.addEventListener('DOMContentLoaded', () => {
    const table = document.querySelector('#notes-table tbody');
    if (table) {
        fetch('api.php?action=list').then(r => r.json()).then(res => {
            if (!res.success) return;
            table.innerHTML = res.data.map(note => `<tr><td><a href="note.php?id=${note.id}">${note.title}</a></td><td>${note.type}</td><td>${note.tags}</td><td>${note.reminder}</td></tr>`).join('');
        });
    }
});
