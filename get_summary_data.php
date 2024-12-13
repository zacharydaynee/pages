<?php
// Include database connection
include '../includes/connection.php';

// Fetch data from both Bluetooth and Detection tables ordered by timestamp in descending order
$query = $db->query("SELECT * FROM bluetooth ORDER BY date_time DESC");
$query2 = $db->query("SELECT * FROM detection ORDER BY date_time DESC");

$data = [];

if ($query->num_rows > 0) {
    $count = 1;
    while ($row = $query->fetch_assoc()) {
        // Ensure detection data matches the current row
        if ($count <= $query2->num_rows)
            $row2 = $query2->fetch_assoc();
        else
            $row2 = null; // No detection data, set to null

        // Prepare data to be sent in response
        $rowData = [
            'timestamp' => $row['date_time'],
            'pir_reading' => ($row2 ? "Motion Detected" : "-"),
            'object_detected' => ($row2 && trim($row2['label']) == "person" ? "Human Detected" : ($row2 ? "Motion Detected" : "-")),
            'mac_address' => $row['bluetooth'],
            'name' => ($row['nameb'] ? ucwords($row['nameb']) : "-"),
            'status' => "-",
            'poacher_detected' => "-",
            'alert' => ($row2 && trim($row2['label']) == "person" ? "Email Sent" : "-")
        ];

        // Append data
        $data[] = $rowData;

        $count++;
    }
}

// Return data as JSON
echo json_encode($data);
?>
