<?php
try {
    @include 'connection.php';
    @include 'allotHostelConfig.php';    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allot Room</title>
    <link rel = "stylesheet" href = "/css/style.css">
    <link rel = "stylesheet" href = "/css/bootstrap.min.css">
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
<div class="sidebar">
        <a href="add_detail.php">Add Room Details</a>
        <a href="room_detail.php">Room Details</a>
        <a class="active">Room Status</a>
        <a href="home_bill.php">Bill Management</a>
        <a href="stock-management.php">Stock Management</a>
        <a href="login.php">Exit</a>
    </div>
<div class="center-container">
    <div class="addform">
        <form method="post">
            <label for="hostel">Select Hostel</label>
            <select id="hostel" name="hostel">
                <option value="">Select Hostel</option>
                <?php
                    foreach ($hostels as $h) {
                        echo "<option value='$h'>$h</option>";
                    }
                ?>
            </select><br><br>

            <label for="roomCapacity">Select Room Capacity</label>
            <input type="number" id="roomCapacity" name="roomCapacity" placeholder="Enter Room Capacity" min=0><br><br>

            <label for="roomAvailable">Number of Rooms Available</label>
            <input type="number" id="roomAvailable" name="roomAvailable" placeholder="Enter Number of Rooms Available" min=0><br><br>

            <label for="selectBatch">Select Batch</label>
            <input type="text" id="selectedBatch" name="selectedBatch" placeholder="Enter Batch"><br><br>
            
            <input type="submit" value="Submit">
            <p style="color: red;"></p>
        </form>
    </div>
</div>

</body>
</html>
