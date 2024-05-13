const updateBtn = document.getElementById("update-btn");
        const tableRows = document.querySelectorAll("tbody tr");
        let selectedRow = null;
        let selectedCell = null;
        let originalValue = null;

        updateBtn.addEventListener("click", () => {
            if (selectedCell) {
                const newValue = prompt("Enter new value:", selectedCell.innerText);
                if (newValue !== null) {
                    selectedCell.innerText = newValue;
                }
                selectedCell.style.backgroundColor = "";
                selectedCell = null;
                selectedRow = null;
                originalValue = null;
            }
        });

        tableRows.forEach(row => {
            row.addEventListener("click", () => {
                if (selectedCell) {
                    selectedCell.style.backgroundColor = "";
                }
                selectedCell = event.target;
                selectedRow = selectedCell.parentNode;
                originalValue = selectedCell.innerText;
                selectedCell.style.backgroundColor = "#ddd";
            });
        });

        document.addEventListener("keypress", event => {
            if (selectedCell) {
                const newValue = prompt("Enter new value:", selectedCell.innerText);
                if (newValue !== null) {
                    selectedCell.innerText = newValue;
                } else {
                    selectedCell.innerText = originalValue;
                }
            }
        });