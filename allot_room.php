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
    <link rel = "stylesheet" href = "css/style.css">
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
            <input type="text" id="roomID" name= "roomID" value="<?php echo $roomID; ?>"><br><br>
            
            <label for="rollNumber">Roll Number:</label>
            <input type="text" id="rollNumber" name="rollNumber" value="<?php echo $rollNumber; ?>"><br><br>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>
            
            <label for="batch">Batch:</label>
            <input type="text" id="batch" name="batch" value="<?php echo $batch; ?>"><br><br>

            <div id="bedInputs"></div>
            <div id="tableInputs"></div>
            <div id="chairInputs"></div>
            <div id="almirahInputs"></div>
            
            <input type="submit" value="Submit">
            <p style="color: red;"><?php echo $error; ?></p>
        </form>
    </div>
</div>
<button type="button" id="goBack">Go Back</button>
<script>
        document.getElementById("goBack").addEventListener("click", function() {
        window.location.href = "room_status.php";
        });
    </script>

</body>
</html>
