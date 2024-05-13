<?php
$csvFile = $_FILES['csvFile']['tmp_name'];
$importMessage = ""; 
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    fgetcsv($handle); 

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $hostel = $data[0];
        $roomNumber = $data[1];
        $roomID = $data[2];
        $beds = array_slice($data, 3, 4); 
        $tables = array_slice($data, 7, 4);
        $chairs = array_slice($data, 11, 4); 
        $almirahs = array_slice($data, 15, 4);

        $stmt = $conn->prepare("INSERT INTO hostelrooms (Hostel, RoomNumber, RoomID, Bed1, Bed2, Bed3, Bed4, Table1, Table2, Table3, Table4, Chair1, Chair2, Chair3, Chair4, Almirah1, Almirah2, Almirah3, Almirah4) VALUES (:hostel, :roomNumber, :roomID, :bed1, :bed2, :bed3, :bed4, :table1, :table2, :table3, :table4, :chair1, :chair2, :chair3, :chair4, :almirah1, :almirah2, :almirah3, :almirah4)");
        
        $stmt->bindParam(':hostel', $hostel);
        $stmt->bindParam(':roomNumber', $roomNumber);
        $stmt->bindParam(':roomID', $roomID);
        $stmt->bindParam(':bed1', $beds[0]);
        $stmt->bindParam(':bed2', $beds[1]);
        $stmt->bindParam(':bed3', $beds[2]);
        $stmt->bindParam(':bed4', $beds[3]);
        $stmt->bindParam(':table1', $tables[0]);
        $stmt->bindParam(':table2', $tables[1]);
        $stmt->bindParam(':table3', $tables[2]);
        $stmt->bindParam(':table4', $tables[3]);
        $stmt->bindParam(':chair1', $chairs[0]);
        $stmt->bindParam(':chair2', $chairs[1]);
        $stmt->bindParam(':chair3', $chairs[2]);
        $stmt->bindParam(':chair4', $chairs[3]);
        $stmt->bindParam(':almirah1', $almirahs[0]);
        $stmt->bindParam(':almirah2', $almirahs[1]);
        $stmt->bindParam(':almirah3', $almirahs[2]);
        $stmt->bindParam(':almirah4', $almirahs[3]);

        $stmt->execute();
    }

    fclose($handle);
    $importMessage = "Data Imported successfully.";
} else {
    echo "Failed to open the CSV file.";
}
?>
