<?php
ob_start();
session_start();
require_once "dbConnect.php";
require_once "loginValidation.php";
require_once "notLoggedIn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body>
<?php include_once "navBar.php"; ?>
<div id="container">
    <a href="#veiwPropperties.php">View</a>
    <a href="#veiwSavedPropperties.php">View Saved</a>
    <?php if($_SESSION["role"] == "landlord" Or $_SESSION["role"] == "admin"):?>
        <a href="#addNewPropperty.php">Add New</a>
    <?endif;
    if($_SESSION["role"] == "admin"): ?>
        <a href="#manageUsers.php">Manage Users</a>
    <?php endif?>
</div>



</body>
</html>