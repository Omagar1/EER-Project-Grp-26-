<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);

$otp_expiry_time = 10 * 60; // Code Lasts 10 Minutes

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
