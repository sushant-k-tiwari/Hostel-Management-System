<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
          table tr:nth-child(even) {
    background-color: #f2f2f2;
}
    </style>
</head>
<body>
    <h1>Payment Details</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a href="home_bill.php">Home</a></li>
            <li><a href="previous-bills.php">Previous Bills</a></li>
            <li><a class="active">Payments</a></li>
            <li><a href="vendors.php">Vendors</a></li>
            <li><a href="report.php">Report</a></li>
            <li><a href="stock-management.php">Stock Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.html">Exit</a></li>
        </ul>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Vendor Name</th>
                <th>Total Amount Paid(Rs)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                @include 'connection.php';
                $sql = "SELECT DATE_FORMAT(b.BillDate, '%d-%m-%Y') AS BillDate, v.VendorName, b.AmountPaid FROM Bills b JOIN Vendors v ON b.VendorId = v.VendorId";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>{$row['BillDate']}</td>";
                    echo "<td>{$row['VendorName']}</td>";
                    echo "<td>Rs {$row['AmountPaid']}</td>";
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
</body>
</html>
