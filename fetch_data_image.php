<?php
include 'config.php'; // Include your config.php for database and email addresses
include '../includes/connection.php'; // Include the database connection

// Fetch the latest image from the database
$query = $db->query("SELECT * FROM images ORDER BY id DESC LIMIT 1");

$data = [];

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $image_url = str_replace("pages/", "", $row['image_url']);
        $file_name = basename($image_url);
        
        // Return the image URL and file name
        $data = [
            'image_url' => $image_url,
            'file_name' => $file_name
        ];
    }
}

// Return the data as JSON
echo json_encode($data);
?>
