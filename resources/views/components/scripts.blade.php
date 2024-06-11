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

    // search User
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

    // search posts
    document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const postItems = document.querySelectorAll('.post-item');

            searchInput.addEventListener('input', function () {
                const searchValue = searchInput.value.toLowerCase();

                postItems.forEach(function (postItem) {
                    const title = postItem.getAttribute('data-title').toLowerCase();
                    const creator = postItem.getAttribute('data-creator').toLowerCase();
                    const category = postItem.getAttribute('data-category').toLowerCase();
                    const company = postItem.getAttribute('data-company').toLowerCase();

                    if (title.includes(searchValue) || creator.includes(searchValue) ||
                        category.includes(searchValue) || company.includes(searchValue)) {
                        postItem.style.display = 'block';
                    } else {
                        postItem.style.display = 'none';
                    }
                });
            });
        });

    // preview image create edit post
    function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('image_preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

</script>
