var reportData = [
    { date: "2022-01-01", vendorName: "Vendor 1", amountPaid: 100 },
    { date: "2022-01-02", vendorName: "Vendor 2", amountPaid: 200 },
    { date: "2022-02-01", vendorName: "Vendor 3", amountPaid: 150 },
    { date: "2022-02-02", vendorName: "Vendor 4", amountPaid: 250 }
];

function toggleOptions() {
    var reportType = document.getElementById("reportType").value;
    var dateOptions = document.getElementById("dateOptions");
    var monthOptions = document.getElementById("monthOptions");
    var generateBtn = document.getElementById("generateBtn");

    dateOptions.style.display = reportType === "date" ? "block" : "none";
    monthOptions.style.display = reportType === "month" ? "block" : "none";
    generateBtn.style.display = "block";
}

function generateReport() {
    var reportType = document.getElementById("reportType").value;
    var selectDate = document.getElementById("selectDate").value;
    var selectMonth = document.getElementById("selectMonth").value;
    var reportDataContainer = document.getElementById("reportData");

    reportDataContainer.innerHTML = "";

    var filteredData = reportData.filter(function(item) {
        if (reportType === "date" && item.date === selectDate) {
            return true;
        } else if (reportType === "month" && item.date.startsWith(selectMonth)) {
            return true;
        }
        return false;
    });

    // Create a table for the filtered data
    var table = document.createElement("table");
    var thead = table.createTHead();
    var row = thead.insertRow();
    var headers = ["Date", "Vendor Name", "Amount Paid"];
    for (var i = 0; i < headers.length; i++) {
        var th = document.createElement("th");
        th.innerHTML = headers[i];
        row.appendChild(th);
    }

    var tbody = table.createTBody();
    filteredData.forEach(function(item) {
        var row = tbody.insertRow();
        var cell1 = row.insertCell(0);
        cell1.innerHTML = item.date;
        var cell2 = row.insertCell(1);
        cell2.innerHTML = item.vendorName;
        var cell3 = row.insertCell(2);
        cell3.innerHTML = item.amountPaid;
        var cell4 = row.insertCell(3);
        var removeButton = document.createElement("button");
        removeButton.innerHTML = "Remove";
        removeButton.onclick = function() {
            row.remove();
        };
        cell4.appendChild(removeButton);
    });

    reportDataContainer.appendChild(table);
}