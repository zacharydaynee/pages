<?php
// Include database connection
include '../includes/connection.php';

// Check if motion parameter is present in the POST request
if(isset($_POST['motionDetected'])) {
    // Retrieve the motion value from the POST request
    $motion = $_POST['motionDetected'];

    // Insert data into the database
    $query = "INSERT INTO pir (motion) VALUES ('$motion')";
    if ($db->query($query)) {
        echo "Data inserted successfully: Motion = " . $motion;
    } else {
        echo "Error inserting data into database: " . $db->error;
    }
} else {
    // Motion parameter is missing in the request
    echo "Motion parameter missing";
}
?>
