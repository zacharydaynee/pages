<?php
include 'config.php'; // Include your config.php for database and email addresses
include '../includes/connection.php'; // Include the database connection

// Fetch data from 'bluetooth' and 'detection' tables
$query = $db->query("SELECT * FROM bluetooth ORDER BY id ASC"); 
$query2 = $db->query("SELECT * FROM detection ORDER BY id ASC"); 

$status = "-";
$poacherDetected = "-";
$emailsent = "-";
if($query->num_rows > 0){
  $count = 1;
  while($row = $query->fetch_assoc()){
    if($count <= $query2->num_rows)
      $row2 = $query2->fetch_assoc(); 
    else
      $row2 = null;

    if ($row2) {
      if ($row['nameb'] != "" && $row2['label'] == "person" && $row['bluetooth'] != "0") {
        $emailsent = "No";
      } elseif ($row['nameb'] != "" && $row2['label'] != "person" && $row['bluetooth'] != "0") {
        $emailsent = "No";
      } elseif ($row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] != "0") {
        $status = "Unauthorized";
        $poacherDetected = "Yes";
        $emailsent = "Yes";
      } elseif ($row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] != "0") {
        $status = "Unauthorized";
        $poacherDetected = "Yes";
        $emailsent = "Yes";
      } elseif ($row['nameb'] == "" && $row2['label'] != "person" && $row['bluetooth'] == "0") {
        $emailsent = "No";
      } elseif ($row['nameb'] == "" && $row2['label'] == "person" && $row['bluetooth'] == "0") {
        $emailsent = "Yes";
      }
    }

        // Only include rows where a poacher is detected
        if ($emailsent == "Yes") {
            $data[] = [
                'no' => $count,
                'type' => 'Email',
                'alert' => 'Unauthorized Person Detected',
                'recipient' => RECIPIENT, // Use the email from config.php
                'timestamp' => $row['date_time']
            ];
            $count++;
        }
    }
}

// Return the data as JSON
echo json_encode($data);
?>
