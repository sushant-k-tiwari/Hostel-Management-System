<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stocks</title>
    <link rel="stylesheet" href="css/stock.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
    table {
        width: 75%;
        border-collapse: collapse;
        margin: 30px 225px;
    }

    th, td {
        padding: 20px;
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
        width: 80px;
    }
        #addStock{
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
    <h1>Stock Report</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a class="active">View Stocks</a></li>
            <li><a href="update_stocks.php">Update Stocks</a></li>
            <li><a href="home_bill.php">Bill Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.html">Exit</a></li>
        </ul>
    </div>
    <table>
        <thead>
            <tr>
                <th>Stock</th>
                <th>Stock Type</th>
                <th>Quantity(Kg)</th>
                <th>Remaining Quantity(Kg)</th>
            </tr>
        </thead>
        <tbody>
            <?php

            try {
                @include 'connection.php';

                $query = "SELECT Stock, StockType, Quantity_Kg, RemQuantity_Kg FROM STOCK";
                $stmt = $conn->query($query);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['Stock'] . "</td>";
                    echo "<td>" . $row['StockType'] . "</td>";
                    echo "<td>" . $row['Quantity_Kg'] . "</td>";
                    if ($row['RemQuantity_Kg'] < 25) {
                        echo "<td style='color: red;'>" . $row['RemQuantity_Kg'] . "<h6 style='word-spacing:5px'>Refill required!</td>";
                    } else {
                        echo "<td>" . $row['RemQuantity_Kg'] . "</td>";
                    }
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
    <script src="js/sortableTable.js"></script>
    <button type="button" id="addStock">Add Stock</button>
    <script>
        document.getElementById("addStock").addEventListener("click", function() {
            window.location.href = "add_stock.php";
        });
        </script>
</body>
</html>
