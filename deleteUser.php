<?php
require("dbConnect.php");
include_once("navBar.php");
try{
    if (isset($_POST['delete'])) {
        // $stmt = "UPDATE account SET active = 0 WHERE accountID = :aid";
        $stmt = "DELETE FROM account WHERE accountID = :aid";
        $sql = $conn->prepare($stmt);
        $sql->bindParam(':aid', $_GET['id'], PDO::PARAM_INT);
        $sql->execute();
        echo "Account deleted successfully.";
        $stmt2 = "DELETE FROM property WHERE ownerID = :oid";
        $sql2 = $conn->prepare($stmt2);
        $sql2->bindParam(':oid', $_GET['id'], PDO::PARAM_INT);
        $sql2->execute();
    }
}catch(PDOException $e){
    echo $e;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Delete User</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <div class="display-container">
            <h2>Delete User <?php echo $_GET['id'];?>?</h2>
        </div>
        <form method="post">
            <input type="submit" value="Delete" name="delete">
            <a href="manageUser.php">Back</a>
        </form>
    </body>
</html>