<?php
require("dbConnect.php");
session_start();
$userid = $_SESSION["userID"];
include_once("navBar.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Saved Properties</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div>
            <?php
            try{
            $sql ="Select userSavedProperty.propertyID,property.EER,property.postcode,property.address FROM userSavedProperty 
            INNER JOIN property ON (property.propertyID=userSavedProperty.propertyID) WHERE userSavedProperty.userID=:uid ORDER BY userSavedProperty.ID ASC;";
            $stmt = $conn->prepare($sql);
            $sql->bindParam(':uid', $userid, PDO::PARAM_INT);
            $stmt->execute();
            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div>
                Energy efficiency rating: <?php echo $row["EER"]?><br>
                Postcode: <?php echo $row["postcode"]?><br>
                Address: <?php echo $row["address"]?><br>
            </div>
            
            <?php
            }//for while loop
            }catch(PDOException $e){
                echo $e;
            }
            ?>
        </div>
    </body>
</html>