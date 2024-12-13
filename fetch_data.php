<?php
// Include database connection
include '../includes/connection.php';

// Fetch data from the alerts/history table, ordered by the most recent first
$query = $db->query("SELECT * FROM alerts ORDER BY timestamp DESC");

$data = [];

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        // Prepare data for JSON response
        $rowData = [
            'timestamp' => $row['timestamp'],
            'alert_type' => $row['alert_type'],
            'description' => $row['description'],
            'status' => $row['status'],
        ];
        
        // Append data to the array
        $data[] = $rowData;
    }
}

// Return the data as JSON
echo json_encode($data);
?>
