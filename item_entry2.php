<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Entry Form</title>
    <link rel="stylesheet" href="bill_details.css">
    <style>
        .item-input {
            margin-bottom: 20px;
            margin-left: 20px;
           
          }
        h1{
            text-align: center;
        }
        #itemCount {
            width: 10%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-left: 15px;
            font-size: 16px;
            background-color: #fff;
            color: #333;
          }
          #submit{
            margin-left: auto;
            display: block;
            position: absolute;
            background-color: #37718e;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .readFile{
            position: absolute;
            width: 25%;
            left: 1300px;
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
    <script src="createItemFields.js"></script>
    <form id="itemForm" method="POST" action="insert_items.php">
        <label for="itemCount">Number of Items</label>
        <select id="itemCount" onchange="createItemFields()">
            <option value="0">Select</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
        </select>
        <div id="itemFields" class="item-container">
            </div>
            
            <label for="totalAmountPaid">Total Amount Paid:</label>
            <input type="text" id="totalAmountPaid" readonly>
            <input type="submit" value="Submit" id="submit">

    </form>
</body>
</html>
