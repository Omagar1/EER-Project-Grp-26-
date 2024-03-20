<?php
session_start();

$otp_expiry_time = 5 * 60; 

$otp_data = isset($_SESSION['otp_data']) ? $_SESSION['otp_data'] : null;


if ($otp_data && time() - $otp_data['timestamp'] < $otp_expiry_time) {
    
    $otp = $otp_data['otp'];

    
    $otp_from_url = isset($_GET['otp']) ? $_GET['otp'] : null;
    
    if ($otp_from_url) {
        
        
        if ($otp_from_url == $otp) {
            
            header("Location: loggedIn.php");
            exit;
        } else {
            
            echo "OTP from session: " . $otp . "<br>";
            echo "OTP from URL: " . $otp_from_url . "<br>";

            echo "Invalid OTP.";
        }
    } else {
        
        echo "OTP is missing from the URL.";
    }
} else {
    
    echo "OTP session data is expired or missing.";
}
