<?php

use App\Models\Database;
$conn =  Database::connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tableName']) && isset($_POST['id']) && isset($_POST['idtable'])) {
        $tableName = $_POST['tableName'];
        $id = $_POST['id'];
        $idtable = $_POST['idtable'];

        // Construct SET clause for textual data
        $setClause = "";
        foreach ($_POST as $column => $value) {
            if ($column != 'tableName' && $column != 'id' && $column != 'idtable' && $column != 'image_upload') {
                $setClause .= "$column = '$value', ";
            }
        }
        // Remove trailing comma
        $setClause = rtrim($setClause, ", ");

        // Handle file upload
        if (!empty($_FILES['image_upload']['name'])) {
            $targetDir = "uploads/"; // Directory where the file will be stored
            $targetFile = $targetDir . basename($_FILES["image_upload"]["name"]); // File path

            // Move uploaded file to the target directory
            if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $targetFile)) {
                // File upload successful, add the file path to the SET clause
                $setClause .= ", image = '$targetFile'";
            } else {
                echo "Error uploading file.";
                exit;
            }
        }

        // Construct the UPDATE query
        $query = "UPDATE $tableName SET $setClause WHERE $idtable = '$id'";
        
        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo "Data updated successfully!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Invalid data.";
    }
} else {
    echo "Method not supported.";
}

mysqli_close($conn);
?>
