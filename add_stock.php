<?php
try {
    @include 'connection.php'; 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stock = $_POST["stock"];
        $stockType = $_POST["stock_type"];
        $quantityKg = $_POST["quantity_kg"];
        $remQuantityKg = $_POST["rem_quantity_kg"];
    
        $sql = "INSERT INTO STOCK (Stock, StockType, Quantity_Kg, RemQuantity_Kg) VALUES (:stock, :stockType, :quantityKg, :remQuantityKg)";
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':stock', $stock, PDO::PARAM_STR);
        $stmt->bindParam(':stockType', $stockType, PDO::PARAM_STR);
        $stmt->bindParam(':quantityKg', $quantityKg, PDO::PARAM_INT);
        $stmt->bindParam(':remQuantityKg', $remQuantityKg, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data.";
        }
    }  
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock Data</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
         .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .addform {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .addform button[type="button"],
        .addform input[type="submit"] {
            background-color: #37718e;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin: 10px 0;
        }

        .addform input[type="text"],
        .addform input[type="number"],
        .addform select {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        #goBack{
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
        color: #fff;
        cursor: pointer;
    }
    </style>
</head>
<body>
    <h1>Add Stock Data</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a class="active">View Stocks</a></li>
            <li><a href="update_stocks.php">Update Stocks</a></li>
            <li><a href="home_bill.php">Bill Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.php">Exit</a></li>
        </ul>
    </div>
    <div class="center-container">
    <div class="addform">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="stock">Stock:</label>
        <input type="text" name="stock" required><br>

        <label for="stock_type">Stock Type:</label>
        <input type="text" name="stock_type" required><br>

        <label for="quantity_kg">Quantity (Kg):</label>
        <input type="number" name="quantity_kg" required><br>

        <label for="rem_quantity_kg">Remaining Quantity (Kg):</label>
        <input type="number" name="rem_quantity_kg" required><br>
        <input type="submit" value="Add Data">
    </form>
    </div>
    </div>
    <button type="button" id="goBack">Go Back</button>
<script>
        document.getElementById("goBack").addEventListener("click", function() {
        window.location.href = "view_stocks.php";
        });
    </script>
</body>
</html>
