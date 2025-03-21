<?php
if ($_FILES['file']) {
    $file = $_FILES['file'];

    // Example: Move the uploaded file to the desired location
    $uploadDirectory = 'uploads/';
    $uploadPath = $uploadDirectory . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file uploaded.";
}

?>