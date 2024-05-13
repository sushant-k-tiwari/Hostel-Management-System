<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stocks</title>
    <link rel="stylesheet" href="css/stock.css">      
    <link rel="stylesheet" href="css/style.css">      
        <style>
    table {
        width: 75%;
        border-collapse: collapse;
        margin: 30px 225px;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #37718e;
        color: white;
    }
    
    th, td {
        width: 5%;
    }
    
    td input[type="text"] {
        width: 80px; /* Adjust as needed */
    }
</style>
</head>
<body>
    <h1>Update Stocks</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a href="view_stocks.php">View Stocks</a></li>
            <li><a class="active">Update Stocks</a></li>
            <li><a href="home_bill.php">Bill Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.php">Exit</a></li>
        </ul>
    </div>
    <?php
try {
    @include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['updateQuantity'])) {
            $stockId = $_POST['stockId'];
            $newQuantity = $_POST['newQuantity'];

            $query = "UPDATE STOCK SET Quantity_Kg = :newQuantity WHERE Stock = :stockId";
        } elseif (isset($_POST['updateRemQuantity'])) {
            $stockId = $_POST['stockId'];
            $newRemQuantity = $_POST['newRemQuantity'];

            $query = "UPDATE STOCK SET RemQuantity_Kg = :newRemQuantity WHERE Stock = :stockId";
        }

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':stockId', $stockId);

        if (isset($newQuantity)) {
            $stmt->bindParam(':newQuantity', $newQuantity);
        }

        if (isset($newRemQuantity)) {
            $stmt->bindParam(':newRemQuantity', $newRemQuantity);
        }

        if ($stmt->execute()) {
            echo "Update successful!";
        } else {
            echo "Update failed: " . $stmt->error;
        }
    }

    $query = "SELECT Stock, StockType, Quantity_Kg, RemQuantity_Kg FROM STOCK";
    $stmt = $conn->query($query);

    echo "<table>";
    echo "<tr><th>Stock</th><th>Stock Type</th><th>Quantity (Kg)</th><th>Remaining Quantity (Kg)</th><th>Update Quantity</th><th>Update Rem. Quantity</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['Stock'] . "</td>";
        echo "<td>" . $row['StockType'] . "</td>";
        echo "<td>" . $row['Quantity_Kg'] . " kg</td>";
        echo "<td>" . $row['RemQuantity_Kg'] . " kg</td>";
        echo "<td>
                <form method='POST'>
                    <input type='hidden' name='stockId' value='" . $row['Stock'] . "'>
                    <input type='text' name='newQuantity' placeholder='Enter'>
                    <input type='submit' name='updateQuantity' value='Update'>
                </form>
            </td>";
        echo "<td>
                <form method='POST'>
                    <input type='hidden' name='stockId' value='" . $row['Stock'] . "'>
                    <input type='text' name='newRemQuantity' placeholder='Enter'>
                    <input type='submit' name='updateRemQuantity' value='Update'>
                </form>
            </td>";
        echo "</tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
    
?>
</body>
</html>
    
 