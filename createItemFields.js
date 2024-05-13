function createItemFields() {
    const itemCount = document.getElementById("itemCount").value;
    const itemFieldsContainer = document.getElementById("itemFields");
    itemFieldsContainer.innerHTML = "";

    for (let i = 1; i <= itemCount; i++) {
        const itemDiv = document.createElement("div");
        itemDiv.className = "item-input";

        const itemNameLabel = document.createElement("label");
        itemNameLabel.textContent = `Item ${i} Name : `;
        const itemNameInput = document.createElement("input");
        itemNameInput.type = "text";
        itemNameInput.name = `itemName${i}`;
        itemNameInput.required = true;

        const quantityLabel = document.createElement("label");
        quantityLabel.textContent = `Quantity Purchased : `;
        const quantityInput = document.createElement("input");
        quantityInput.type = "number";
        quantityInput.name = `quantityPurchased${i}`;
        quantityInput.required = true;  
        quantityInput.min = "0"; // Prevent negative numbers

        const unitCostLabel = document.createElement("label");
        unitCostLabel.textContent = `Unit Cost : `;
        const unitCostInput = document.createElement("input");
        unitCostInput.type = "number";
        unitCostInput.name = `unitCost${i}`;
        unitCostInput.required = true;

        const totalAmountLabel = document.createElement("label");
        totalAmountLabel.textContent = `Total Amount : `;
        const totalAmountInput = document.createElement("input");
        totalAmountInput.type = "text";
        totalAmountInput.id = `totalAmount${i}`;
        totalAmountInput.readOnly = true;

        itemDiv.appendChild(itemNameLabel);
        itemDiv.appendChild(itemNameInput);
        itemDiv.appendChild(quantityLabel);
        itemDiv.appendChild(quantityInput);
        itemDiv.appendChild(unitCostLabel);
        itemDiv.appendChild(unitCostInput);
        itemDiv.appendChild(totalAmountLabel);
        itemDiv.appendChild(totalAmountInput);
        
        itemFieldsContainer.appendChild(itemDiv);

        // Add event listener to calculate the total amount when inputs change
        [quantityInput, unitCostInput].forEach(input => {
            input.addEventListener("input", calculateTotalAmount);
        });
    }
}

function calculateTotalAmount() {
    const itemCount = document.getElementById("itemCount").value;
    let overallTotal = 0;

    for (let i = 1; i <= itemCount; i++) {
        const quantity = parseFloat(document.querySelector(`input[name="quantityPurchased${i}"]`).value);
        const unitCost = parseFloat(document.querySelector(`input[name="unitCost${i}"]`).value);

        const individualTotal = quantity * unitCost;
        overallTotal += individualTotal;

        document.getElementById(`totalAmount${i}`).value = individualTotal.toFixed(2);
    }

    document.getElementById("totalAmountPaid").value = overallTotal.toFixed(2);
}

const itemForm = document.getElementById("itemForm");
itemForm.addEventListener("submit", function (event) {
    event.preventDefault();
    // You can access and process the form data here
});


