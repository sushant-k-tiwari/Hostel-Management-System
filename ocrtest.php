<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Reading OCR</title>
</head>
<body>
<center>
<h3>PHP OCR Test</h3>
<form action="ocrtest.php" method="POST" enctype="multipart/form-data">
<input type="file" name="image" />
<input type="submit"/>
</form>
</center>
<?php
if(isset($_FILES['image'])){
$file_name = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
move_uploaded_file($file_tmp,"uploads/".$file_name);
echo "<h3>Image Upload Success</h3>";
echo '<img src="images/'.$file_name.'" style="width:100%">';

shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\Apache24\\htdocs\\test\\uploads\\'.$file_name.'" bill');

echo "<br><h3>OCR after reading</h3><br><pre>";

$myfile = fopen("bill.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("bill.txt"));
fclose($myfile);
echo "</pre>";
}
?>
</body>
</html>