<?php
$hostels = ["HB1", "HB2", "HB3"]; // Add more hostels as needed
$roomNumber = $numberOfBeds = $numberOfTables = $numberOfChairs = $numberOfAlmirahs = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedHostel = $_POST["hostel"];
    $roomNumber = $_POST["roomNumber"];
    $numberOfBeds = (int)$_POST["numberOfBeds"];
    $numberOfTables = (int)$_POST["numberOfTables"];
    $numberOfChairs = (int)$_POST["numberOfChairs"];
    $numberOfAlmirahs = (int)$_POST["numberOfAlmirahs"];

    // Validate input
    if (empty($selectedHostel) || empty($roomNumber)) {
        $error = "Please select a hostel and enter a room number.";
    } else {
        try {
            @include 'connection.php'; // Include database connection file

            // Generate the SQL table creation statement
            $sql = "CREATE TABLE IF NOT EXISTS HostelRooms (
                Hostel VARCHAR(10) NOT NULL,
                RoomNumber VARCHAR(10) NOT NULL,
                RoomID INT AUTO_INCREMENT PRIMARY KEY";

            for ($i = 1; $i <= $numberOfBeds; $i++) {
                $sql .= ", Bed$i VARCHAR(100)";
            }

            for ($i = 1; $i <= $numberOfTables; $i++) {
                $sql .= ", Table$i VARCHAR(100)";
            }

            for ($i = 1; $i <= $numberOfChairs; $i++) {
                $sql .= ", Chair$i VARCHAR(100)";
            }

            for ($i = 1; $i <= $numberOfAlmirahs; $i++) {
                $sql .= ", Almirah$i VARCHAR(100)";
            }

            $sql .= ");";

            // Execute the SQL statement to create the table if it doesn't exist
            $conn->exec($sql);

            // Insert user's input into the table
            $stmt = $conn->prepare("INSERT INTO HostelRooms (Hostel, RoomNumber, Bed1, Table1, Chair1, Almirah1) VALUES (:hostel, :room, :bed1, :table1, :chair1, :almirah1)");
            $stmt->bindParam(':hostel', $selectedHostel);
            $stmt->bindParam(':room', $roomNumber);
            $stmt->bindParam(':bed1', $numberOfBeds);
            $stmt->bindParam(':table1', $numberOfTables);
            $stmt->bindParam(':chair1', $numberOfChairs);
            $stmt->bindParam(':almirah1', $numberOfAlmirahs);
            $stmt->execute();

            echo "Data has been successfully inserted into the table.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Room Management</title>
</head>
<body>
    <h1>Hostel Room Management</h1>
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

        <label for="numberOfBeds">Number of Beds:</label>
        <input type="number" id="numberOfBeds" name="numberOfBeds" value="<?php echo $numberOfBeds; ?>"><br><br>

        <label for="numberOfTables">Number of Tables:</label>
        <input type="number" id="numberOfTables" name="numberOfTables" value="<?php echo $numberOfTables; ?>"><br><br>

        <label for="numberOfChairs">Number of Chairs:</label>
        <input type="number" id="numberOfChairs" name="numberOfChairs" value="<?php echo $numberOfChairs; ?>"><br><br>

        <label for="numberOfAlmirahs">Number of Almirahs:</label>
        <input type="number" id="numberOfAlmirahs" name="numberOfAlmirahs" value="<?php echo $numberOfAlmirahs; ?>"><br><br>

        <input type="submit" value="Submit">
        <p style="color: red;"><?php echo $error; ?></p>
    </form>
</body>
</html>
