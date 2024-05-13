<?php
$hostels = ["HB1", "HB2", "HB3", "HB4", "HB5", "HB6"];
$roomID = $selectedHostel = $roomNumber = $rollNumber = $name = $batch = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedHostel = $_POST["hostel"];
    $roomNumber = $_POST["roomNumber"];
    $roomID = $_POST["roomID"];
    $rollNumber = $_POST["rollNumber"];
    $name = $_POST["name"];
    $batch = $_POST["batch"];

    if (empty($selectedHostel) || empty($roomNumber) || empty($roomID) || empty($rollNumber) || empty($name) || empty($batch)) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS AllotRoom (
                Hostel VARCHAR(10),
                RoomNumber VARCHAR(10),
                RoomID VARCHAR(10) NOT NULL,
                RollNumber BIGINT,
                Name VARCHAR(150),
                Batch VARCHAR(10), PRIMARY KEY (RollNumber)
            );";

            $conn->exec($sql);

            $insertSQL = "INSERT INTO AllotRoom (Hostel, RoomNumber, RoomID, RollNumber, Name, Batch)
                VALUES (:hostel, :room, :room_id, :roll, :name, :batch)";

            $stmt = $conn->prepare($insertSQL);
            $stmt->bindParam(':hostel', $selectedHostel);
            $stmt->bindParam(':room', $roomNumber);
            $stmt->bindParam(':room_id', $roomID);
            $stmt->bindParam(':roll', $rollNumber);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':batch', $batch);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}
?>
