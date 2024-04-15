<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
include_once("navBar.php");
include_once("search.php");
$userid = $_SESSION["userID"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Properties</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div>
            <?php

            try{
                if (isset($_SESSION['userRole'])){
                echo $_SESSION['userRole'];
                if ($_SESSION["userRole"]=="Tenant"){
                    $sql ="Select propertyID,EER,postcode,address FROM property ORDER BY propertyID ASC;";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div>
                        <div>
                            Energy efficiency rating: <?php echo $row["EER"]?><br>
                            Postcode: <?php echo $row["postcode"]?><br>
                            Address: <?php echo $row["address"]?><br>
                        </div>
                        <div>
                            <form method="post" action="saveProperty.php">
                                <input type="hidden" name="pid" value="<?php echo $row['propertyID'] ?>">
                                <input type="submit" value="Save" name="save">
                            </form>
                        </div>
                    </div>
                    <?php 
                    }//for while
                }//for if 
                elseif ($_SESSION["userRole"]== "Landlord"){
                    $sql ="Select propertyID,EER,postcode,address FROM property WHERE ownerID=:uid ORDER BY propertyID ASC;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':uid', $userid, PDO::PARAM_INT);
                    $stmt->execute();
                    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div>
                        <div>
                            Energy efficiency rating: <?php echo $row["EER"]?><br>
                            Postcode: <?php echo $row["postcode"]?><br>
                            Address: <?php echo $row["address"]?><br>
                            <a href="updateProperty.php?id=<?php echo $row["propertyID"];?>">Edit</a>
                            <a href="deleteProperty.php?id=<?php echo $row["propertyID"];?>">Delete</a>
                        </div>
                    </div>
            <?php
                    }//for while loop
                }//for else if
            }//if isset
            }catch(PDOException $e){
                echo $e;
            }
            ?>
        </div>
    </body>
    <footer class="footer">
    <p>EERCalc © Group 26 2024</p>
    </footer>
</html>
