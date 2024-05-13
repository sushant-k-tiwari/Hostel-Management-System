<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the item count from the form
    $itemCount = $_POST['itemCount'];

    // Initialize an array to store item details
    $itemDetails = [];

    // Loop through each item and collect their details
    for ($i = 1; $i <= $itemCount; $i++) {
        $itemDetails[] = [
            //'billID' => $_POST['bill_id'],
            'itemName' => $_POST['itemName' . $i],
            'quantityPurchased' => $_POST['quantityPurchased'. $i],
            'unitCost' => $_POST['unitCost' . $i],
            'totalCost' => $_POST['totalAmount' . $i],
        ];
    }

    // Validate the data (add your validation logic here)

    // Insert data into the MySQL table
    try {
        // Connect to the database
        @include 'connection.php';
        // Prepare the SQL statement for insertion
        $sql = "INSERT INTO purchasedata (BillID, ItemName, UnitCost, TotalCost) VALUES (1, :itemName, :unitCost, :totalCost)";
        $stmt = $pdo->prepare($sql);

        // Loop through the item details and insert each item
        foreach ($itemDetails as $item) {
            //$stmt->bindParam(':billID', $item['billID']);
            $stmt->bindParam(':itemName', $item['itemName']);
            $stmt->bindParam(':unitCost', $item['unitCost']);
            $stmt->bindParam(':totalCost', $item['totalCost']);
            $stmt->execute();
        }

        // Redirect to a success page or perform other actions
        // header("Location: success.php");

    echo "Entered Successfully";
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
// echo "<h1>Succesfully Entered</h1>"
?>
