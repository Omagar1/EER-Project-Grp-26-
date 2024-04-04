<?php
require("dbConnect.php");
include_once("navBar.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View User Accounts</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div>
            <h2>View Users</h2>
        <table>
        <thead>
            <tr>
                <th>Account ID</th>
                <th>Email Address</th>
                <th>Date Created</th>
                <th>Role</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try{
            $sql = "SELECT accountID, emailAddress, dateCreated, role FROM account WHERE active = true ORDER BY accountID ASC;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?php echo $row["accountID"]?></td>
                <td><?php echo $row["emailAddress"]?></td>
                <td><?php echo $row["dateCreated"]?></td>
                <td><?php echo $row["role"]?></td>
                <td><a href="deleteUser.php?id=<?php echo $row["accountID"];?>">Delete</a></td>
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
</html>