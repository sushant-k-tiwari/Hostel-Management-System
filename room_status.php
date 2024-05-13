<?php
@include 'connection.php';
$query = "SELECT a.Hostel, a.RoomNumber, a.RoomID, a.RollNumber, a.Name, a.Batch FROM allotroom a";

try {
    $stmt = $conn->query($query);
    $roomDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Status</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">        
    <style>
        #allotRoom{
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
    #allotRoom2{
        margin-left: auto;
        margin-top: 60px;
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
    table{
            margin-left: 200px;
        }
    table th, table td {
            padding: 12px;
            min-width: 200px;
            text-align: center;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .tab{
            margin-top: 50px;
            margin-left: 250px;
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
        <a href="login.html">Exit</a>
    </div>

    <div class="content">
        <h1>Room Status</h1><br><br><br>
        <table class="tab">
            <tr>
                <th>Hostel</th>
                <th>Room Number</th>
                <th>Room ID</th>
                <th>Roll Number</th>
                <th>Name</th>
                <th>Batch</th>
            </tr>
            <?php foreach ($roomDetails as $row) : ?>
                <tr>
                    <td><?php echo $row['Hostel']; ?></td>
                    <td><?php echo $row['RoomNumber']; ?></td>
                    <td><?php echo $row['RoomID']; ?></td>
                    <td><?php echo $row['RollNumber']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Batch']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="js/sortableTable.js"></script>  
    <button type="button" id="allotRoom">Allot Room</button>
    <button type="button" id="allotRoom2">Random Allotment</button>
    <script>
        document.getElementById("allotRoom").addEventListener("click", function() {
            window.location.href = "allot_room.php";
        });
        document.getElementById("allotRoom2").addEventListener("click", function() {
            window.location.href = "\\test\\random.php";
        });
        </script>
</body>
</html>
