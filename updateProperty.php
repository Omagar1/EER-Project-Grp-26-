<?php
require("dbConnect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Property</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div>
            <h2>Update Property <?php echo $_GET['id'];?>?</h2>
        </div>
        <div>
            <?php
                try{
                    if (isset($_POST['update'])) {
                        $stmt = "UPDATE property SET ownerID=:oid ,EER=:eer ,postcode=:postcode ,address=:address ,reportIssueDate=:rdate ,certificateNumber=:certnum WHERE propertyID = :pid";
                        $sql = $conn->prepare($stmt);
                        $sql->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
                        $sql->bindParam(':oid', $_POST['oid'], PDO::PARAM_STR);
                        $sql->bindParam(':eer', $_POST['eer'], PDO::PARAM_STR);
                        $sql->bindParam(':postcode', $_POST['postcode'], PDO::PARAM_STR);
                        $sql->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
                        $sql->bindParam(':rdate', $_POST['rdate'], PDO::PARAM_STR);
                        $sql->bindParam(':certnum', $_POST['certnum'], PDO::PARAM_STR);
                        $sql->execute();
                        echo "Updated successfully.";
                    }
                    $sql = "SELECT propertyID,ownerID,EER,postcode,address,reportIssueDate,certificateNumber FROM property WHERE propertyID =:pid";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':pid', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form method="post">
                    <div>
                        <label>Owner ID</label>
                        <input  type="text" name = "oid" value="<?php echo $row["ownerID"]; ?>">
                   </div>

                   <div>
                        <label>EER</label>
                        <input  type="text" name = "eer" value="<?php echo $row["EER"]; ?>">
                   </div>

                   <div>
                        <label>Postcode</label>
                        <input  type="text" name = "postcode" value="<?php echo $row["postcode"]; ?>">
                   </div>

                   <div>
                        <label>Address</label>
                        <input  type="text" name = "address" value="<?php echo $row["address"]; ?>">
                   </div>

                   <div>
                        <label>Report Issue Date</label>
                        <input  type="text" name = "rdate" value="<?php echo $row["reportIssueDate"]; ?>">
                   </div>

                   <div>
                        <label>Certificate Number</label>
                        <input  type="text" name = "certnum" value="<?php echo $row["certificateNumber"]; ?>">
                   </div>

                   <div>
                       <input type="submit" name="update" value="Update">
                   </div>
                   <div>
                        <a href="viewProperty.php">Back</a>
                    </div>
            </form>
            <?php 
            }//while loop
            }catch(PDOException $e){
            echo $e;
            }?>
            
        </div>
    </body>
</html>