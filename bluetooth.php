<?php
include '../includes/connection.php';
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

fwrite($myfile, $_POST['mac'].' '.$_POST['nameb']);

fclose($myfile);

// Check if a MAC address parameter is present in the POST request
if(isset($_POST['mac'])) {
    // Retrieve the MApostDataC address from the POST request
    $macAddress = $_POST['mac'];
    $name =$_POST['nameb'];
    
    // Insert the MAC address into the database
    $query = "INSERT INTO bluetooth (bluetooth,nameb) VALUES ('$macAddress','$name')";
    if ($db->query($query)) {
        if($_POST['mac']==0){
            sleep(1);
            $label = $db->query("SELECT label FROM detection ORDER BY id DESC LIMIT 1")->fetch_assoc();
            if($label['label'] == 'person'){
                include 'send_email.php';
            }
        }
        echo "MAC address inserted successfully: " . $macAddress;
    } else {
        echo "Error inserting MAC address into database: " . $db->error;
    }
} else {
    // MAC address parameter is missing in the request
    echo "MAC address parameter missing";
}
?>




