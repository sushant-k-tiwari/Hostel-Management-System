<?php

$hostels = ["HB1", "HB2", "HB3", "HB4", "HB5", "HB6"];
$roomID = $selectedHostel = $roomNumber = $error = "";
$beds = $tables = $chairs = $almirahs = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedHostel = $_POST["hostel"];
    $roomNumber = $_POST["roomNumber"];
    $roomID = $_POST["roomID"];
    $beds = $_POST["bed"];
    $tables = $_POST["table"];
    $chairs = $_POST["chair"];
    $almirahs = $_POST["almirah"];

    if (empty($selectedHostel) || empty($roomNumber) || empty($roomID)) {
        $error = "Please select a hostel, enter a room number, and provide a Room ID.";
    } else {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS HostelRooms (
                Hostel VARCHAR(10) NOT NULL,
                RoomNumber VARCHAR(10) NOT NULL,
                RoomID VARCHAR(10) NOT NULL PRIMARY KEY,"; 

            for ($i = 1; $i <= count($beds); $i++) {
                $sql .= "Bed$i VARCHAR(100), ";
            }

            for ($i = 1; $i <= count($tables); $i++) {
                $sql .= "Table$i VARCHAR(100), ";
            }

            for ($i = 1; $i <= count($chairs); $i++) {
                $sql .= "Chair$i VARCHAR(100), ";
            }

            for ($i = 1; $i <= count($almirahs); $i++) {
                $sql .= "Almirah$i VARCHAR(100), ";
            }
            $sql = rtrim($sql, ', ') . ');';

            $conn->exec($sql);

            $insertSQL = "INSERT INTO HostelRooms (Hostel, RoomNumber, RoomID";

            for ($i = 1; $i <= count($beds); $i++) {
                $insertSQL .= ", Bed$i";
            }

            for ($i = 1; $i <= count($tables); $i++) {
                $insertSQL .= ", Table$i";
            }

            for ($i = 1; $i <= count($chairs); $i++) {
                $insertSQL .= ", Chair$i";
            }

            for ($i = 1; $i <= count($almirahs); $i++) {
                $insertSQL .= ", Almirah$i";
            }

            $insertSQL .= ") VALUES (:hostel, :room, :room_id";
            for ($i = 1; $i <= count($beds); $i++) {
                $insertSQL .= ", :bed$i";
            }

            for ($i = 1; $i <= count($tables); $i++) {
                $insertSQL .= ", :table$i";
            }

            for ($i = 1; $i <= count($chairs); $i++) {
                $insertSQL .= ", :chair$i";
            }

            for ($i = 1; $i <= count($almirahs); $i++) {
                $insertSQL .= ", :almirah$i";
            }

            $insertSQL .= ")";
            $stmt = $conn->prepare($insertSQL);
            $stmt->bindParam(':hostel', $selectedHostel);
            $stmt->bindParam(':room', $roomNumber);
            $stmt->bindParam(':room_id', $roomID);

            for ($i = 1; $i <= count($beds); $i++) {
                $stmt->bindParam(":bed$i", $beds[$i - 1]);
            }

            for ($i = 1; $i <= count($tables); $i++) {
                $stmt->bindParam(":table$i", $tables[$i - 1]);
            }

            for ($i = 1; $i <= count($chairs); $i++) {
                $stmt->bindParam(":chair$i", $chairs[$i - 1]);
            }

            for ($i = 1; $i <= count($almirahs); $i++) {
                $stmt->bindParam(":almirah$i", $almirahs[$i - 1]);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}

?>