<?php
// Include database connection
include '../includes/connection.php';


// Fetch data from both Bluetooth and Detection tables ordered by id DESC
$query = $db->query("SELECT * FROM bluetooth ORDER BY id DESC"); 
$query2 = $db->query("SELECT * FROM detection ORDER BY id DESC"); 

$data = [];

if ($query->num_rows > 0) {
    $count = 1;
    while ($row = $query->fetch_assoc()) {
        // Ensure detection data matches the current row
        if ($count <= $query2->num_rows)
            $row2 = $query2->fetch_assoc(); 
        else
            $row2 = null; // No detection data, set to null

        // Logic to determine status and poacher detection
        $status = "-";
        $poacherDetected = "-";
        if ($row2) {
            $status = match (true) {
                $row['nameb'] != "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "Authorized",
                $row['nameb'] != "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "Authorized",
                $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "Unauthorized",
                $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "Unauthorized",
                $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] == "0" => "-",
                $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] == "0" => "Unauthorized",
                default => ""
            };
            
            $poacherDetected = match (true) {
                $row['nameb'] != "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "No",
                $row['nameb'] != "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "No",
                $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] != "0" => "Yes",
                $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] != "0" => "Yes",
                $row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] == "0" => "-",
                $row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] == "0" => "Yes",
                default => ""
            };    
            
            if ($poacherDetected != "") {
                $updateSql = "UPDATE bluetooth SET poacherDetected = ? WHERE id = ?";
                $stmt = $db->prepare($updateSql);
                $stmt->bind_param("si", $poacherDetected, $row2['id']); // Assuming 'id' is the identifier in detection table
                $stmt->execute();
              }


        }

        // Prepare data to be sent in response
        $rowData = [
            'timestamp' => $row['date_time'],
            'pir_reading' => ($row2 ? "Motion Detected" : "-"),
            'object_detected' => ($row2 && trim($row2['label']) == "person" ? "Human Detected" : ($row2 ? "Motion Detected" : "-")),
            'mac_address' => $row['bluetooth'],
            'name' => ($row['nameb'] ? ucwords($row['nameb']) : "-"),
            'status' => $status,
            'poacher_detected' => $poacherDetected,
            'alert' => ($poacherDetected == "Yes" ? "Email Sent" : "-")
        ];

        

        // Append data to the array
        $data[] = $rowData;

        $count++;
    }
}

// Return the data as JSON
echo json_encode($data);
?>
