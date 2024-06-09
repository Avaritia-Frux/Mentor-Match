<script>
    // sort table
    function sortTable(tableId, colIndex) {
        const table = document.getElementById(tableId);
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);
        const ascending = table.asc = !table.asc;

        rows.sort((a, b) => {
            const cellA = a.cells[colIndex].innerText.trim();
            const cellB = b.cells[colIndex].innerText.trim();

            return ascending
                ? cellA.localeCompare(cellB, undefined, {numeric: true})
                : cellB.localeCompare(cellA, undefined, {numeric: true});
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    // search table
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const tables = document.querySelectorAll('table');

        tables.forEach(table => {
            const rows = table.getElementsByTagName('tr');
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }

                row.style.display = match ? '' : 'none';
            }
        });
    }

    // remove alert
    setTimeout(() => {
        document.querySelector('.alert-dismissible').remove();
    }, 2000);
</script>
