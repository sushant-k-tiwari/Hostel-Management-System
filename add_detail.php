<?php
try {
    @include 'connection.php';
    @include 'hostelRoomConfig.php';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
    .addform {
        margin-top: 70px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 60vh;
    }
    .addform button[type="button"],
    .addform input[type="submit"] {
    background-color: #37718e;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}
.addform input[type="text"],
.addform input[type="number"],
.addform select {
    width: 50%;
    padding: 8px;
    margin-top: 1px;
    margin-bottom: -25px;
    border: 1px solid #ccc;
    border-radius: 3px;
}
#addCsvButton{
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
        cursor: pointer;
    }
</style>
</head>
<body>
    <h1>Add Room Details</h1><br><br>
<div class="sidebar">
        <a class="active">Add Room Details</a>
        <a href = "room_detail.php">Room Details</a>
        <a href = "room_status.php">Room Status</a>
        <a href="home_bill.php">Bill Management</a>
        <a href="view_stocks.php">Stock Management</a>
        <a href="login.html">Exit</a>
    </div>
    <div class="addform">

        <form method="post">
            <label for="hostel">Select Hostel:</label>
            <select id="hostel" name="hostel">
                <option value="">Select Hostel</option>
                <?php
            foreach ($hostels as $h) {
                echo "<option value='$h'>$h</option>";
            }
            ?>
        </select><br><br>
        
        <label for="roomNumber">Enter Room Number:</label>
        <input type="text" id="roomNumber" name="roomNumber" value="<?php echo $roomNumber; ?>"><br><br>
        
        <label for="roomID">Room ID:</label>
        <input type="text" id="roomID" name="roomID" value="<?php echo $roomID; ?>"><br><br>
        
        
        <label for="beds">Enter Number of Beds:</label>
        <input type="number" id="beds" name="beds" value="0" min="0" max="<?php echo $maxItems; ?>"><br><br>
        
        <label for="tables">Enter Number of Tables:</label>
        <input type="number" id="tables" name="tables" value="0" min="0" max="<?php echo $maxItems; ?>"><br><br>
        
        <label for="chairs">Enter Number of Chairs:</label>
        <input type="number" id="chairs" name="chairs" value="0" min="0" max="<?php echo $maxItems; ?>"><br><br>
        
        <label for="almirahs">Enter Number of Almirahs:</label>
        <input type="number" id="almirahs" name="almirahs" value="0" min="0" max="<?php echo $maxItems; ?>"><br><br>
        
        <div id="bedInputs"></div>
        <div id="tableInputs"></div>
        <div id="chairInputs"></div>
        <div id="almirahInputs"></div>
        
        <button type="button" onclick="addInputs('bed', 'Bed')">Add Beds</button>
        <button type="button" onclick="addInputs('table', 'Table')">Add Tables</button>
        <button type="button" onclick="addInputs('chair', 'Chair')">Add Chairs</button>
        <button type="button" onclick="addInputs('almirah', 'Almirah')">Add Almirahs</button><br><br>
        
        <input type="submit" value="Submit">
        <p style="color: red;"><?php echo $error; ?></p>
    </form>
    <button type="button" id="addCsvButton">Add CSV</button>

</div>
    <script>
        function addInputs(type, label) {
            const maxItems = parseInt(document.getElementById(type + 's').value);
            let container = document.getElementById(type + "Inputs");
            container.innerHTML = ''; 

            for (let i = 1; i <= maxItems; i++) {
                let input = document.createElement("input");
                input.type = "text";
                input.name = type + "[]";
                input.placeholder = label + " " + i + " ID";
                container.appendChild(input);
            }
        }
        document.getElementById("addCsvButton").addEventListener("click", function() {
        window.location.href = "add_csv.php";
});
    </script>
</body>
</html>
