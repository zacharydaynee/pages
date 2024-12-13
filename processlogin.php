<?php
require('session.php');
require('../includes/connection.php');

if (isset($_POST['btnlogin'])) {
    $users = $db->real_escape_string(trim($_POST['username']));
    $upass = $db->real_escape_string(trim($_POST['password']));

    // Create some SQL statement            
    $result = $db->query("SELECT * FROM users WHERE username='$users' AND password='$upass'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['MEMBER_ID'] = $row['id'];
        $_SESSION['acc_level'] = $row['account_type'];
        $_SESSION['f_name'] = $row['first_name'];
        $_SESSION['l_name'] = $row['last_name'];
        
        // Redirect to login page with success message
        header("Location: login.php?msg=success");
        exit; // Make sure to stop further execution
    } else {
        // Redirect with error
        header("Location: login.php?msg=0");
        exit;
    }
}

$db->close();
?>
