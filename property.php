<?php
session_start();
require_once 'dbConnect.php';
require_once 'calc.php';
require_once 'addProperty.php';

//var_dump($_SESSION);test

$msg = "";

if (isset($_POST['submit']))
{
    $EER = EERCalc($_POST['tfa'],$_POST['lc'],$_POST['hc'], $_POST['hwc']);
    $msg = addProperty($conn, $_SESSION['userID'], $EER, $_POST['postcode'], $_POST['address'],$_POST['propertyType']);
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
        
        <select name="propertyType">
            <option value="House">House</option>
            <option value="Flat">Flat</option>
            <option value="Maisonette">Maisonette</option>
            <option value="Bungalow">Bungalow</option>
        </select>

        <label for="tfa">Total Floor Area</label><br>
        <input type="text" name="tfa" required><br><br>

        <label for="lc">Lighting Cost</label><br>
        <input type="text" name="lc" required><br><br>
        
        <label for="hc">Heating Cost</label><br>
        <input type="text" name="hc" required><br><br>
        
        <label for="hwc">Hot Water Cost</label><br>
        <input type="text" name="hwc" required><br><br>
        
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