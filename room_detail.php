<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        table{
            margin-left: 200px;
        }
         table th, table td {
            padding: 12px;
            min-width: 158px;
        }
        table tr:nth-child(even) {
    background-color: #f2f2f2;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="add_detail.php">Add Room Details</a>
        <a class="active">Room Details</a>
        <a href="room_status.php">Room Status</a>
        <a href="home_bill.php">Bill Management</a>
        <a href="stock-management.php">Stock Management</a>
        <a href="login.html">Exit</a>
    </div>
    <div class="content">
        <h1>Room Details</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Hostel</th>
                    <th>Room Number</th>
                    <th>Room ID</th>
                    <th>Beds</th>
                    <th>Tables</th>
                    <th>Chairs</th>
                    <th>Almirahs</th>
                </tr>
            </thead>
            <tbody>
                <?php


                try {
                  @include 'connection.php';

                    $query = "SELECT * FROM hostelrooms";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['Hostel'] . "</td>";
                        echo "<td>" . $row['RoomNumber'] . "</td>";
                        echo "<td>" . $row['RoomID'] . "</td>";
                        echo "<td>" . $row['Bed1'] . ", " . $row['Bed2'] . ", " . $row['Bed3'] . ", " . $row['Bed4'] . "</td>";
                        echo "<td>" . $row['Table1'] . ", " . $row['Table2'] . ", " . $row['Table3'] . ", " . $row['Table4'] . "</td>";
                        echo "<td>" . $row['Chair1'] . ", " . $row['Chair2'] . ", " . $row['Chair3'] . ", " . $row['Chair4'] . "</td>";
                        echo "<td>" . $row['Almirah1'] . ", " . $row['Almirah2'] . ", " . $row['Almirah3'] . ", " . $row['Almirah4'] . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                   echo "Database Error: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/sortableTable.js"></script>
</body>
</html>
