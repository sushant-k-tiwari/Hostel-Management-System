<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
    <style>
        #reportHead{
            visibility:hidden;
            text-align: center;
            line-height: 0.2;
        }
        #reportHead, h5{
            visibility:hidden;
            text-align: center;
            
        }
        @media print {
            body *, #heading{
                visibility: hidden;
            }
            #reportHead{
                visibility:visible;
            }
            #printReport, #printReport * , #reportHead *{
                visibility: visible;
            }
            #reportTable{
                border:1;
                height:-10vh;              
            }
            table, th, td{
                border: 0.5px solid black;
            }
        }
        #selectedDate{
            margin-top: 10px;
            margin-left:145px;
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #weeklyDates{
            margin-left:225px;
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #fromDate, #toDate{
            margin-top: 2px;
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #generateButton {
        position: absolute;
        top: 15px;
        right: 10px;
        background-color: #37718e;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        cursor: pointer;
    }
    #print{
        position: absolute;
        bottom: 15px;
        right: 10px;
        background-color: #37718e;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        cursor: pointer;
    }
        #monthly{
            margin-left:225px;
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #selectedMonth{
            margin-top: 2px;
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #date, #weeklyDates, #vendor, #items{
            display: none;
        }
        #vendor{
            margin-left:230px;
            margin-top:10px;
        }
        #items{
            margin-left:230px;
            margin-top:10px;
        }
        #vendorOption{
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #itemOption{
            padding:12px;
            border-color: #37718e;
            border-radius:8px;
            margin-bottom: 20px;
        }
        #reportTable{
            border:1;
            margin-top: 20px;

        }   
        #image{
            position: absolute;
            top: 0px;
            left: 0px;
        }
      
    </style>
</head>
<body>
    <div id="reportHead">
        <div id="image">
            <image src="/iiitm-logo.png" alt="logo" width="60px" height="45px">
        </div>
        <h3>Indian Institute of Information Technology Manipur</h3>
        <h5>(An Institute of National Importance by Act of Parliament, Govt. of India)</h5>
        <hr>
    </div>
    <h1 id="heading">Report</h1>
    <div class="sidebar">
        <ul class="nb">
            <li><a href="home_bill.php">Home</a></li>
            <li><a href="previous-bills.php">Previous Bills</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a href="vendors.php">Vendors</a></li>
            <li><a class="active">Report</a></li>
            <li><a href="stock-management.php">Stock Management</a></li>
            <li><a href="add_detail.php">Hostel Management</a></li>
            <li><a href="login.php">Exit</a></li>
        </ul>
    </div>
    <select title="Select Report Type" class="rtype" id="reportType">
        <option value="default">Select Report Type</option>
        <option value="date">Date</option>
        <option value="weekly">Duration</option>
        <option value="vendor">Vendor</option>
        <option value="item">Item</option>
    </select>
    <form action="report.php" method="post">
        <div id="date">
            <label for="selectedDate">Select a Date</label>
            <input type="date" id="selectedDate" name="selectedDate">
        </div>
        
        <div id="weeklyDates">
                <label for="fromDate">From</label><br>
                <input type="date" id="fromDate" name="fromDate"><br>
                <label for="toDate">To</label><br>
                <input type="date" id="toDate" name="toDate">
        </div>
        
        <div id="vendor"><br>
            <label for="vendor">Select Vendor</label><br><br>
            <select name="vendor" id="vendorOption">
                <option value="default">Select Vendor</option>
                <?php
                    @include 'connection.php';
                    $sql = "SELECT VendorName FROM VENDORS";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['VendorName'] . '">' . $row['VendorName'] . '</option>';
                    }
                    $conn = null;
                ?>
            </select>
        </div>

        <div id="items"><br>
            <label for="item">Select Item</label><br><br>
            <select name="item" id="itemOption">
                <option value="default">Select Item</option>
                <?php
                    @include 'connection.php';
                    $sql = "SELECT ItemName FROM PURCHASEDATA";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['ItemName'] . '">' . $row['ItemName'] . '</option>';
                    }
                    $conn = null;
                ?>
            </select>
        </div>

        <button type="submit" id="generateButton" name="generateReport">Generate</button>
        
    </form> 
    <script>
        const reportTypeSelect = document.getElementById("reportType");
        const dateDiv = document.getElementById("date");
        const weeklyDatesDiv = document.getElementById("weeklyDates");
        const vendorDiv = document.getElementById("vendor");
        const itemDiv = document.getElementById("items");
        
        reportTypeSelect.addEventListener("change", function() {
            if(reportTypeSelect.value == "default"){
                dateDiv.style.display = "none";
                weeklyDatesDiv.style.display = "none";
            }
            if(reportTypeSelect.value == "date"){
                dateDiv.style.display = "block";
            } else {
                dateDiv.style.display = "none";
            }
            if (reportTypeSelect.value === "weekly") {
                weeklyDatesDiv.style.display = "block";
            } else {
                weeklyDatesDiv.style.display = "none";
            }if(reportTypeSelect.value == "vendor"){
                vendorDiv.style.display = "block";
            }else{
                vendorDiv.style.display = "none";
            }if(reportTypeSelect.value == "item"){
                itemDiv.style.display = "block";
            }else{
                itemDiv.style.display = "none";
            }
        });
    </script>
<div id="printReport">
<?php
@include 'connection.php'; 

if (isset($_POST['generateReport'])) {
    $selectedDate = $_POST['selectedDate'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $vendor = $_POST['vendor'];
    $item = $_POST['item'];
    if ($selectedDate != null) {
        $printDate = date("d-m-Y", strtotime($selectedDate));
        echo "<center><h3>".$printDate."</h3></center>";
        $sql = "SELECT B.BillID, V.VendorName, B.GSTIN, B.AmountPaid FROM BILLS B INNER JOIN VENDORS V ON B.VendorID = V.VendorID WHERE B.BillDate = :selectedDate";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
        $stmt->execute();
    
        echo '<table id = reportTable >';
        echo '<tr><th>BillID</th><th>VendorName</th><th>GSTIN</th><th>AmountPaid</th></tr>';
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['BillID'] . '</td>';
            echo '<td>' . $row['VendorName'] . '</td>';
            echo '<td>' . $row['GSTIN'] . '</td>';
            echo '<td>' . $row['AmountPaid'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else if ($fromDate != null && $toDate != null) {
        echo "<center><h3>From: ".$fromDate."To: ".$toDate."</h3></center>";
        $sql = "SELECT B.BillID, V.VendorName, B.GSTIN, B.AmountPaid FROM BILLS B INNER JOIN VENDORS V ON B.VendorID = V.VendorID WHERE B.BillDate BETWEEN :fromDate AND :toDate";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        $stmt->execute();

        echo '<table id = reportTable >';
        echo '<tr><th>BillID</th><th>VendorName</th><th>GSTIN</th><th>AmountPaid</th></tr>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['BillID'] . '</td>';
        echo '<td>' . $row['VendorName'] . '</td>';
        echo '<td>' . $row['GSTIN'] . '</td>';
        echo '<td>' . $row['AmountPaid'] . '</td>';
        echo '</tr>';
        }
    echo '</table>';
    }else if($vendor != null){
        echo "<center><h3>Vendor ".$vendor."</h3></center>";
        $sql = "SELECT B.BillDate, B.GSTIN, B.AmountPaid FROM BILLS B INNER JOIN VENDORS V ON B.VendorID = V.VendorID WHERE V.VendorName = :vendor ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':vendor', $vendor);
        $stmt->execute();

        echo '<table id = reportTable >';
        echo '<tr><th>Bill Date</th><th>GSTIN</th><th>AmountPaid</th></tr>';

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>' . $row['BillDate'] . '</td>';
            echo '<td>' . $row['GSTIN'] . '</td>';
            echo '<td>' . $row['AmountPaid'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }else if($item != null){
        echo "<center><h3>".$item."</h3></center>";
        $sql = "SELECT B.BillDate, P.QuantityPurchased, P.UnitCost, P.TotalCost FROM BILLS B INNER JOIN PURCHASEDATA P ON B.BillID = P.BillID WHERE P.ItemName = :item ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item', $item);
        $stmt->execute();

        echo '<table id = reportTable >';
        echo '<tr><th>Bill Date</th><th>Quantity Purchased</th><th>Unit Cost</th><th>Total Cost</th></tr>';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>' . $row['BillDate'] . '</td>';
            echo '<td>' . $row['QuantityPurchased'] . '</td>';
            echo '<td>' . $row['UnitCost'] . '</td>';
            echo '<td>' . $row['TotalCost'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
$conn = null;
?>
</div>

<button id = print onclick="printContent()">Print</button>
<script>
        function printContent() {
            window.print();
        }
</script>
</body>
</html>
