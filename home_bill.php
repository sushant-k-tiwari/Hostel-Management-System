<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
    .chooseFile {
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
        }

        .chooseFile label {
            background-color: #37718e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit {
            background-color: #37718e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }
        .readFile{
            display: block;
            position: relative;
            left: 1100px;
        }
        .vendorDetail{
            display: block;
            width: 30%; 
            position:absolute;
            left: 300px;
        }
        .vendorDetail bill_date{
            width: 100%;
            display:block;

        }
        .next{
    
            background-color: #37718e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

    
        }
    </style>
</head>
<body>
    <h1>Home</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a class="active">Home</a></li>
            <li><a href="previous-bills.php">Previous Bills</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a href="vendors.php">Vendors</a></li>
            <li><a href="report.php">Report</a></li>
            <li><a href="stock-management.php">Stock Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.php">Exit</a></li>
        </ul>
    </div>
<form method = "POST" enctype="multipart/form-data" class="chooseFile">
<input type="file" name="image" />
<button type="submit" class="submit">Read Bill</button>
</form>
<form action="home_bill.php" method="POST" class="vendorDetail">
        <label for="bill_id">BillID</label><br>
        <input type="text" id="bill_id" name="bill_id"><br><br>

        <label for="vendor_name">Vendor Name</label><br>
        <input type="text" id="vendor_name" name="vendor_name"><br><br>

        <label for="gstin">GSTIN</label><br>
        <input type="text" id="gstin" name="gstin"><br><br>

        <label for="amountPaid">Amount Paid</label><br>
        <input type="text" id="amountPaid" name="amountPaid"><br><br>

        <label for="bill_date">Date</label><br>
        <input type="date" id="bill_date" name="bill_date"><br><br>
        <button class="next" type="submit">Next</button>
    </form>
   
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
    $amountPaid = $_POST['amountPaid'];
    $billDate = $_POST['bill_date'];
    if (empty($billID) || empty($vendorName) || empty($gstin) || empty($amountPaid) || empty($billDate)) {
        $error = "Please fill in all required fields.";
    } else {
        $query = "SELECT VendorID FROM VENDORS WHERE VendorName = :vendorName";
        $prep = $conn->prepare($query);
        $prep->bindParam(':vendorName', $vendorName);
        $prep->execute();
        $vendorID = $prep->fetchColumn();

        $sql = "INSERT INTO bills (BillID, VendorID, GSTIN, BillDate, AmountPaid) VALUES (:billID, :vendorID, :gstin, :billDate, :amountPaid)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':billID', $billID);
        $stmt->bindParam(':vendorID', $vendorID);
        $stmt->bindParam(':gstin', $gstin);
        $stmt->bindParam(':amountPaid', $amountPaid);
        $stmt->bindParam(':billDate', $billDate);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>window.location.assign(\"item_entry.php\")</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>


<div class="readFile">
    <?php
    if(isset($_FILES['image'])){
        $file_name = $_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];
        move_uploaded_file($file_tmp,"uploads/".$file_name);
        echo '<img src="uploads/'.$file_name.'" style="width:25%">';

        shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\Apache24\\htdocs\\uploads\\'.$file_name.'" bill');

        echo "<pre>";

        $myfile = fopen("bill.txt", "r") or die("Unable to open file!");
        echo fread($myfile,filesize("bill.txt"));
        fclose($myfile);
        echo "</pre>";
    }
?>
</div>


</body>
</html>
