<?php
$hostels = ["HB1", "HB2", "HB3", "HB4", "HB5", "HB6"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedHostel = $_POST["hostel"];
    $seater = $_POST["roomCapacity"];
    $batch = $_POST["selectedBatch"];
    $noofrooms = $_POST["roomAvailable"];

    if (empty($selectedHostel) || empty($seater) || empty($batch)) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            
            $insertSQL = "INSERT INTO TEST (Hostel, Seater, Batch)
                VALUES (:hostel, :roomCapacity, :selectedBatch)";

            $stmt = $conn->prepare($insertSQL);
            $stmt->bindParam(':hostel', $selectedHostel);
            $stmt->bindParam(':roomCapacity', $seater);
            $stmt->bindParam(':selectedBatch', $batch); 

            $stmt->execute();
            // echo "<center> Number of Students Alloted:" . $noofrooms*$seater . "</center>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}
?>
