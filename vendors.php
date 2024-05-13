<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendors</title>
    <link rel="stylesheet" href="css/style.css">  
    <style>
          table tr:nth-child(even) {
    background-color: #f2f2f2;
}
#addVendor{
        margin-left: auto;
        margin-top: 10px;
        margin-right: 30px;
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        background-color: #37718e;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        color: #fff;
    }
    </style>  
    </head>
<body>
    <h1>Vendors</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a href="home_bill.php">Home</a></li>
            <li><a href="previous-bills.php">Previous Bills</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a class="active">Vendors</a></li>
            <li><a href="report.php">Report</a></li>
            <li><a href="stock-management.php">Stock Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.html">Exit</a></li>
        </ul>
    </div>
    <table>
        <thead>
            <tr>
                <th>Vendor Name</th>
                <th>Item Type Purchased</th>
                <th>Total Amount Paid</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                @include 'connection.php';
$sql = "SELECT v.VendorName, c.CategoryName, b.AmountPaid FROM Vendors v JOIN Bills b ON v.VendorId = b.VendorId JOIN Categories c ON c.CategoryId = v.CategoryId";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>{$row['VendorName']}</td>";
                    echo "<td>{$row['CategoryName']}</td>";
                    echo "<td>{$row['AmountPaid']}</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
            ?>
        </tbody>
    </table>
    <script src="js/sortableTable.js"></script>
    <button type="button" id="addVendor">Add Vendor</button>
    <script>
        document.getElementById("addVendor").addEventListener("click", function() {
        window.location.href = "add_vendor.php";
    });
    </script>
</body>
</html>
