<?php
// Before we store information of our member, we need to start the session
date_default_timezone_set("Asia/Karachi");
session_start();

// Create a new function to check if the session variable MEMBER_ID is set
function logged_in() {
    return isset($_SESSION['MEMBER_ID']);
}

// This function checks if the member is logged in; if not, it will redirect to login.php
function confirm_logged_in() {
    if (!logged_in()) {
?>  
        <script type="text/javascript">
            window.location = "login"; // Redirect to login page
        </script>
<?php
        exit; // Stop further execution after redirect
    }
}

// Function to log out the user
function logout() {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: login"); // Redirect to the login page
    exit; // Stop further execution
}
?>
