<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload</title>
</head>
<body>

<h2>Upload File</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <br><br>
    <button type="submit" name="upload">Upload</button>
</form>

</body>
</html>

<?php
    if (isset($_POST['upload'])) {

    $uploadDir = "uploads/";

    // Check if uploads directory exists
    if (!is_dir($uploadDir)) {
        die("Error: Upload directory does not exist.");
    }

    if (!is_writable($uploadDir)) {
        die("Error: Upload directory is not writable.");
    }

    $file = $_FILES['file'];

    // File details
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Allowed file types
    $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];

    // Get file extension using string functions
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Error handling
    if ($fileError !== 0) {
        die("Error: File upload failed.");
    }

    if (!in_array($fileExt, $allowedExtensions)) {
        die("Error: Only PDF, JPG, and PNG files are allowed.");
    }

    if ($fileSize > 2 * 1024 * 1024) { // 2MB
        die("Error: File size must be less than 2MB.");
    }

    // Rename file using string functions
    $baseName = pathinfo($fileName, PATHINFO_FILENAME);
    $safeName = strtolower(str_replace(" ", "_", $baseName));
    $newFileName = $safeName . "_" . time() . "." . $fileExt;

    $destination = $uploadDir . $newFileName;

    // Move file
    if (move_uploaded_file($fileTmp, $destination)) {
        echo "File uploaded successfully as <b>$newFileName</b>";
    } else {
        echo "Error: Failed to move uploaded file.";
    }
}
?>

