<?php
require("dbConnect.php");
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
            <h2>Delete Property <?php echo $_GET['id'];?>?</h2>
        </div>
        <div>
            <form method="post">
                <input type="submit" value="Delete" name="delete">
                <a href="viewProperty.php">Back</a>
            </form>
        </div>
    </body>
</html>