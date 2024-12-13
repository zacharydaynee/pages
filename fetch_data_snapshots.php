<?php
include 'config.php'; // Include your config.php for database and email addresses

// Fetch data from the images table
$query = $db->query("SELECT * FROM images ORDER BY id DESC");

$data = [];

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        // Prepare the snapshot data
        $data[] = [
            'date_time' => $row['date_time'],
            'image_url' => str_replace("pages/", "", $row['image_url'])
        ];
    }
}

// Return the data as JSON
echo json_encode($data);
?>

<!-- WIP -->