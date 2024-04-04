<?php
require("dbConnect.php");
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
            $sql ="SELECT propertyID, EER, postcode, address FROM property ORDER BY propertyID ASC;";
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
            }//for while loop
            }catch(PDOException $e){
                echo $e;
            }
            ?>
        </div>
    </body>
</html>