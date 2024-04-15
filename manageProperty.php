<?php
require("dbConnect.php");
include_once("navBar.php");
include_once("search.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Properties for Admin</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div>
            <h2>View Properties</h2>
        <table>
        <thead>
            <tr>
                <th>Property ID</th>
                <th>Owner ID</th>
                <th>Energy Efficiency Rating</th>
                <th>Postcode</th>
                <th>Address</th>
                <th>Report Issue Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try{
            $sql ="Select propertyID,ownerID,EER,postcode,address,reportIssueDate FROM property ORDER BY propertyID ASC;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?php echo $row["propertyID"]?></td>
                <td><?php echo $row["ownerID"]?></td>
                <td><?php echo $row["EER"]?></td>
                <td><?php echo $row["postcode"]?></td>
                <td><?php echo $row["address"]?></td>
                <td><?php echo $row["reportIssueDate"]?></td>
                <td><a href="updateProperty.php?id=<?php echo $row["propertyID"];?>">Edit</a></td>
                <td><a href="deleteProperty.php?id=<?php echo $row["propertyID"];?>">Delete</a></td>
            </tr>
            <?php
            }//for while loop
            }catch(PDOException $e){
                echo $e;
            }
            ?>
        </tbody>
        </table>
        </div>
    </body>
    <footer class="footer">
    <p>EERCalc © Group 26 2024</p>
    </footer>
</html>