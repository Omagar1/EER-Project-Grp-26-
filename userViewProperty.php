<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
include_once("navBar.php");
// include_once("search.php");
require_once "notLoggedIn.php";
$userid = $_SESSION["userID"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Properties</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div class="<?php echo ratingTocolour($row["EER"])?>">
            <?php

            function ratingTocolour($eerInput){
               
                $ratingColour = "";

                switch($eerInput){
                    case "A":
                        $ratingColour = "view-0ab654-container";
                        return $ratingColour;
                    case "B":
                        $ratingColour = "view-f0ee07-container";
                        return $ratingColour;
                    case "C":
                        $ratingColour = "view-f7911a-container";
                        return $ratingColour;
                    case "D":
                        $ratingColour = "view-ca7b1e-container";
                        return $ratingColour;
                    case "E":
                        $ratingColour = "view-ca4d1e-container";
                        return $ratingColour;
                    case "F":
                        $ratingColour = "view-ca1e1e-container";
                        return $ratingColour;
                    case "G":
                        $ratingColour = "view-c60909-container";
                        return $ratingColour;
                    }
            }



            /*color values
            
            A - 0ab654
            B - f0ee07
            C - f7911a
            D - ca7b1e
            E - ca4d1e
            F - ca1e1e
            G - c60909

            */

            try{
                if ($_SESSION["userRole"]=="Tenant"){
                    $sql ="Select propertyID,propertyType,EER,postcode,address FROM property ORDER BY propertyID ASC;";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <!--<div class="<?php /*echo ratingTocolour($row["EER"])*/?>">-->
                    <div>
                        <div>
                            Property Type: <?php echo $row["propertyType"]?><br>
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
                    $sql ="Select propertyID,propertyType,EER,postcode,address FROM property WHERE ownerID=:uid ORDER BY propertyID ASC;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':uid', $userid, PDO::PARAM_INT);
                    $stmt->execute();
                    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <div>
                        <div>
                            Property Type: <?php echo $row["propertyType"]?><br>
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
            // }//if isset
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