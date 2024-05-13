<?php
// Ensure that Tesseract is in your system's PATH or provide the full path to the Tesseract executable.
$tesseractPath = 'C:\Program Files\Tesseract-OCR'; // Adjust this path as needed.

// Check if an image file was uploaded
if (isset($_FILES['image'])) {
    $imagePath = $_FILES['image']['tmp_name'];
    $outputFile = 'output'; // Output file for Tesseract

    // Run Tesseract OCR
    exec("$tesseractPath $imagePath $outputFile");

    // Read the extracted text from Tesseract's output file
    $extractedText = file_get_contents("$outputFile.txt");

    // Return the extracted text
    echo $extractedText;
} else {
    echo "No image file uploaded.";
}
?>
