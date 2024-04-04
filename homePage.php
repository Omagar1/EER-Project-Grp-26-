<?php
session_start();
require_once "dbConnect.php";
require_once "notLoggedIn.php";
$_SESSION["role"] = "admin"; 
var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
</head>

<body>
    <?php include_once "navBar.php"; ?>
    <div id="container">
        <h2>Welcome <?php echo $_SESSION['username'];?></h2>
        <?php switch ($_SESSION["role"]):
            case "admin":?>
                <a href="manageUsers.php">Manage Users</a>
                <a href="#manageProperty.php">Manage Properties</a>
                <?php break;
            case "landlord":?>
                <a href="#addNewPropperty.php">Add New Property</a>
                <a href="#manageProperty.php">Manage Properties</a>
                <?php break; 
            case "tenants "?>
                <a href="veiwPropperties.php">View</a>
                <a href="veiwSavedPropperties.php">View Saved</a>
                <?php break;
        endswitch;?>
    </div>
</body>
</html>