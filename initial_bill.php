<!-- Testing File -->

<?php
try {
    @include 'connection.php';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    $billID = $vendorName = $gstin = $billDate = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $billID = $_POST['bill_id'];
    $vendorName = $_POST['vendor_name'];
    $gstin = $_POST['gstin'];
    $billDate = $_POST['bill_date'];
    if (empty($billID) || empty($vendorName) || empty($gstin) || empty($billDate)) {
        $error = "Please fill in all required fields.";
    } else {
        $sql = "INSERT INTO bills (BillID, VendorID, GSTIN, BillDate) VALUES (:billID, :vendorName, :gstin, :billDate)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':billID', $billID);
        $stmt->bindParam(':vendorName', $vendorName);
        $stmt->bindParam(':gstin', $gstin);
        $stmt->bindParam(':billDate', $billDate);
        $result = $stmt->execute();
        if ($result) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>