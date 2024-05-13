<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Details Form</title>
    <link rel="stylesheet" href="css/style.css">  
    <style>
h1 {
    text-align: center;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="submit"] {
    width: 80%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    display: inline-block;
}

input[type="submit"] {
    background-color: #37718e;
    color: white;
    cursor: pointer;
    width: 85%;
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
    <h1>Vendor Details Form</h1>
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
    <form method="post" action="add_vendor.php">
        <label for="vendorID">Vendor ID</label>
        <input type="text" id="vendorID" name="vendorID">

        <label for="vendorName">Vendor Name</label>
        <input type="text" id="vendorName" name="vendorName" required>

        <label for="categoryID">Category ID</label>
        <input type="text" id="categoryID" name="categoryID">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="phoneNumber">Phone Number</label>
        <input type="tel" id="phoneNumber" name="phoneNumber">

        <input type="submit" value="Submit">
    </form>
    <button type="button" id="goBack">Go Back</button>
    <script>
        document.getElementById("goBack").addEventListener("click", function() {
        window.location.href = "vendors.php";
        });
    </script>
    <?php
    try {
        @include 'connection.php';
    } catch (PDOException $e ) {
        echo "Error: " . $e->getMessage();
    }
    $vendorID = $vendorName = $categoryID = $email = $phoneNumber = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendorID = $_POST['vendorID'];
    $vendorName = $_POST['vendorName'];
    $categoryID = $_POST['categoryID'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    if (empty($vendorID) || empty($vendorName) || empty($categoryID) || empty($email) || empty($phoneNumber)) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            $sql = "INSERT INTO vendors (VendorID, VendorName, CategoryID, Email, PhoneNumber) VALUES (:vendorID, :vendorName, :categoryID, :email, :phoneNumber)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':vendorID', $vendorID);
            $stmt->bindParam(':vendorName', $vendorName);
            $stmt->bindParam(':categoryID', $categoryID);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phoneNumber', $phoneNumber);

            if ($stmt->execute()) {
                echo "<center><span style='color: green;'>Vendor details inserted successfully!</span></center>";
                echo "<script>setTimeout(function() {
                    document.querySelector('span[style=\"color: green;\"]').style.display = 'none';
                }, 2000);</script>";
            }
             else {
                echo "Error: " . $stmt->error;
            }
        } catch (PDOException $e) {
            echo "<center><span style='color: red;'>Error: Check details properly<br>" . $e->getMessage() . "</span></center>";

        }
        $conn = null;
    }
}
?>
</body>
</html>