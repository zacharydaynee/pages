<!-- 192.168.254.120 -->
<?php

// Set the URL of your ESP32 server
$url = 'http:/192.168.254.120';

// Prepare the POST data
$postData = array(
    'key1' => '1',
   
);

// Initialize cURL session
$curl = curl_init($url);

// Set cURL options
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    echo 'Error: ' . curl_error($curl);
} else {
    // Print the response from the ESP32 server
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($curl);

?>
