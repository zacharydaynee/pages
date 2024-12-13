<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../includes/connection.php';  // Include your database connection
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'config.php';

// Function to rotate image
function rotateImage($imagePath) {
    // Load the image (adjust for the image type)
    $imageInfo = getimagesize($imagePath);
    $mime = $imageInfo['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($imagePath);
            break;
        case 'image/png':
            $image = imagecreatefrompng($imagePath);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($imagePath);
            break;
        default:
            return $imagePath;  // If unsupported format, return the original image path
    }

    // Rotate the image 90 degrees
    $rotatedImage = imagerotate($image, 90, 0);  // 90 degrees rotation, background color = 0

    // Save the rotated image to a temporary file
    $rotatedImagePath = 'rotated_' . basename($imagePath);
    imagejpeg($rotatedImage, $rotatedImagePath);  // Save as JPEG file

    // Clean up the image resources
    imagedestroy($image);
    imagedestroy($rotatedImage);

    return $rotatedImagePath;  // Return the path of the rotated image
}

// Function to send email with an 
function sendeMail($email, $subject, $message, $image_path) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = MAILHOST;
    $mail->Username = USERNAME;
    $mail->Password = PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom(SEND_FROM, SEND_FROM_NAME);
    $mail->addAddress($email);
    $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = $message;

    // Attach the rotated image if a valid image path is provided
    if ($image_path) {
        $mail->addAttachment($image_path);  // Attach the rotated image
    }

    if (!$mail->send()) {
        return "Email not sent. Please try again.";
    } else {
        return "success";
    }
}

// Fetch the latest poacher detection record from the database
$query = $db->query("SELECT * FROM bluetooth WHERE poacherDetected = 'Yes' AND emailSent = 0 LIMIT 1");

if ($query->num_rows > 0) {
    // Fetch the first row
    $row = $query->fetch_assoc();
    
    // Fetch the image related to this poacher detection from the images table
    $imageQuery = $db->query("SELECT image_url FROM images WHERE id = " . $row['id'] . " ORDER BY id DESC LIMIT 1");

    if ($imageQuery->num_rows > 0) {
        $imageRow = $imageQuery->fetch_assoc();
        $image_path = '../' . $imageRow['image_url'];  // Full path to the image

        // Rotate the image before attaching
        $rotatedImagePath = rotateImage($image_path);  // Rotate the image
    } else {
        $rotatedImagePath = null;  // No image found
    }

    // Retrieve the MAC address (if available)
    $mac_address = $row['bluetooth'] ?? 'None'; // Use 'None' if no MAC address is available

    // Prepare the message
    $message = "Unauthorized MAC Address: " . ($mac_address != '0' ? $mac_address : 'None') . "\n";

    // Send the email with the image attachment
    $result = sendeMail(RECIPIENT, 'Poacher Detected', $message, $rotatedImagePath);

    if ($result === "success") {
        // Update the emailSent to 1 after sending the email
        $updateSql = "UPDATE bluetooth SET emailSent = 1 WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();

        // Return a success response
        echo json_encode(['status' => 'email_sent']);
    } else {
        // Return an error response if email wasn't sent
        echo json_encode(['status' => 'error']);
    }
} else {
    // Return a response indicating no action was taken
    echo json_encode(['status' => 'no_action']);
}
?>