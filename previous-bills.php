<?php
try {
    @include 'connection.php';
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT DATE_FORMAT(b.BillDate, '%d-%m-%Y') AS BillDate, v.VendorName, b.GSTIN, b.AmountPaid FROM Bills b INNER JOIN Vendors v ON b.VendorId = v.VendorId";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Previous Bills</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        table tr:nth-child(even) {
    background-color: #f2f2f2;
}
    </style>
  </head>
  <body>
    <h1>Previous Bills</h1>
    <div class="sidebar">
      <ul class="nb">
        <li><a href="home_bill.php">Home</a></li>
        <li><a class="active">Previous Bills</a></li>
        <li><a href="payments.php">Payments</a></li>
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
          <th>GSTIN</th>
          <th>Amount Paid</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['BillDate']}</td>";
            echo "<td>{$row['VendorName']}</td>";
            echo "<td>{$row['GSTIN']}</td>";
            echo "<td>Rs {$row['AmountPaid']}</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
      </table>
      <script src="js/sortableTable.js"></script>
  </body>
</html>
