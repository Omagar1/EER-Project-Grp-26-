<?php
session_start();
require_once 'dbConnect.php';
require_once 'calc.php';
require_once 'addProperty.php';

$msg = "";

if (isset($_POST['submit']))
{
    $msg = addProperty($conn, $_SESSION['userID'], EERCalc($_POST['tfa'],$_POST['lc'],$_POST['hc'], $_POST['hwc']), $_POST['postcode'], $_POST['address']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Property</title>
</head>
<body>

<?php include_once "navBar.php"; ?>


<div class="property-container">
    <form action="property.php" method="post">
        <label for="postcode">Postcode</label><br>
        <input type="text" name="postcode" required><br><br>
        
        <label for="address">Address</label><br>
        <input type="text" name="address" required><br><br>

        <label for="tfa">Total Floor Area</label><br>
        <input type="text" name="tfa"><br><br>

        <label for="lc">Lighting Cost</label><br>
        <input type="text" name="lc"><br><br>
        
        <label for="hc">Heating Cost</label><br>
        <input type="text" name="hc"><br><br>
        
        <label for="hwc">Hot Water Cost</label><br>
        <input type="text" name="hwc"><br><br>
        
        <input type="submit" name="submit"><br><br>
        <div>
            <?php echo $msg; ?>
        </div>
    </form>
</div>
    
<footer class="footer">
<p>EERCalc © Group 26 2024</p>
</footer>

</body>
</html>