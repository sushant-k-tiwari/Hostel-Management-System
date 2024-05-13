<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Data Import</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="add_csv.css">
</head>
<body>
    <h1>Upload Data in CSV Format</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="csvFile">Select a CSV file</label><br><br>
        <input type="file" name="csvFile" id="csvFile" accept=".csv">
        <button type="submit" name="import">Import CSV</button>
    </form>

    <?php
if (isset($_POST['import'])) {
    
    try {
        @include 'connection.php';
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
    @include 'csv.php';
    $conn = null;
}
?>
<div class="sidebar">
        <a class="active">Add Room Details</a>
        <a href = "room_detail.php">Room Details</a>
        <a href = "room_status.php">Room Status</a>
        <a href="login.php">Exit</a>
    </div>
    <div class="centered-message">
        <?php echo $importMessage; ?>
    </div>
</body>
</html>
