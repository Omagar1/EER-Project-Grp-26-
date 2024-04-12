<?php
require("dbConnect.php");
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
include_once("navBar.php");
try{
    if (isset($_POST['delete'])) {
        $stmt = "DELETE FROM property WHERE propertyID = :pid";
        $sql = $conn->prepare($stmt);
        $sql->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
        $sql->execute();
        echo "Deleted successfully.";
    }
}catch(PDOException $e){
    echo $e;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete Property</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div>
            <h2>Delete this property?</h2>
        </div>
        <?php
            $sql = "SELECT propertyID,EER,postcode,address FROM property WHERE propertyID =:pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div>
            <div>
                Postcode: <?php echo $row["postcode"]?><br>
                Address: <?php echo $row["address"]?><br>
            </div>
        </div>
        <?php 
        }//for while 
        if ($_SESSION['userRole']= 'Admin'){
        ?>
            <div>
                <form method="post">
                    <input type="submit" value="Delete" name="delete">
                    <a href="manageProperty.php">Back</a>
                </form>
            </div>
        <?php 
        }//for if
        elseif ($_SESSION['userRole']= 'Landlord'){
        ?>
            <div>
                <form method="post">
                    <input type="submit" value="Delete" name="delete">
                    <a href="userViewProperty.php">Back</a>
                </form>
            </div>
        <?php }//for elseif ?>
    </body>
</html>