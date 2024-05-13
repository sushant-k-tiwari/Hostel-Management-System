<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Entry</title>
    <link rel="stylesheet" href="bill_details.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .form{
            margin-left : 650px;
            margin-top: 100px;
            width : 120%;
        }
        #addItem{
        display: block;
        position: absolute;
        background-color: #37718e;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        color: #fff;
        cursor: pointer;
    }
    #exit{
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
    .readFile{
            position: absolute;
            width: 25%;
            left: 1100px;
            top: 150px;
            font-family: Arial, sans-serif; 
            font-size: 14px;
        }
    </style>
</head>
<body>
<h1>Item Entry Form</h1>
    <div class="readFile">
        
    <?php
$filePath = 'C:\Apache24\htdocs\bill.txt';

if (file_exists($filePath)) {
    $fileContent = file_get_contents($filePath);
    echo nl2br(htmlspecialchars($fileContent));
} else {
    echo "File not found!";
}
?>
</div>

        <form action="item_entry.php" method="POST" class="form">
            <label for="billID">Bill ID</label><br>
            <input type="text" name="billID" id="billID" class="item-input" required><br><br>

            <label for="itemName">Item Name</label><br>
            <input type="text" name="itemName" id="itemName" class="item-input" required><br><br>
    
            <label for="Quantity Purchased">Quantity Purchased</label><br>
            <input type="number" name="quantityPurchased" id="quantityPurchased" class="item-input" required min="0"><br><br>
    
            <label for="unitPrice">Unit Price</label><br>
            <input type="text" step="0.01" name="unitPrice" id="unitPrice" class="item-input" required><br><br>
    
            <label for="totalPrice">Total Price</label><br>
            <input type="text" name="totalPrice" id="totalPrice" class="item-input"><br><br>
    
            <button type="submit" id="addItem">Add Item</button>
    
        </form>

    <script>
        const quantityPurchasedInput = document.getElementById('quantityPurchased');
        const unitPriceInput = document.getElementById('unitPrice');
        const totalPriceInput = document.getElementById('totalPrice');

        function calculateTotalPrice() {
            const quantityPurchased = parseFloat(quantityPurchasedInput.value);
            const unitPrice = parseFloat(unitPriceInput.value);

            if (!isNaN(quantityPurchased) && !isNaN(unitPrice)) {
                const total = quantityPurchased * unitPrice;
                totalPriceInput.value = total.toFixed(2);
            } else {
                totalPriceInput.value = '';
            }
        }
        unitPriceInput.addEventListener('input', calculateTotalPrice);
        calculateTotalPrice();
    </script>

<?php
try {
    @include 'connection.php';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$billID = $itemName = $quantityPurchased = $unitPrice = $totalPrice = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $billID = $_POST['billID'];
    $itemName = $_POST['itemName'];
    $quantityPurchased = $_POST['quantityPurchased'];
    $unitPrice = $_POST['unitPrice'];
    $totalPrice = $_POST['totalPrice'];

    if (empty($billID) || empty($itemName) || empty($quantityPurchased) || empty($unitPrice) || empty($totalPrice)) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            $sql = "INSERT INTO PURCHASEDATA (BillID, ItemName, QuantityPurchased, UnitCost, TotalCost) VALUES (:billID, :itemName, :quantityPurchased, :unitPrice, :totalPrice)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':billID', $billID);
            $stmt->bindParam(':itemName', $itemName);
            $stmt->bindParam(':quantityPurchased', $quantityPurchased);
            $stmt->bindParam(':unitPrice', $unitPrice);
            $stmt->bindParam(':totalPrice', $totalPrice);

            if ($stmt->execute()) {
                echo "<br><br><br><center><span style='color: green;'>Item Added successfully!</span></center>";
                echo "<script>setTimeout(function() {
                    document.querySelector('span[style=\"color: green;\"]').style.display = 'none';
                }, 1000);</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}
?>
<button type="submit" id="exit">Exit</button>
<script>
    document.getElementById("exit").addEventListener("click", function() {
        window.location.href = "home_bill.php";
        });
</script>

</body>
</html>
