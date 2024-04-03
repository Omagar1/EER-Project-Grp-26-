<?php
require("dbConnect.php");
session_start();
$userid = $_SESSION["userID"];
try{
    if (isset($_POST['save'])) {
        $stmt = "INSERT INTO (userID,propertyID)VALUES(:uid,:pid)";
        $sql = $conn->prepare($stmt);
        $sql->bindParam(':pid', $_REQUEST['pid'], PDO::PARAM_INT);
        $sql->bindParam(':uid', $userid, PDO::PARAM_INT);
        $sql->execute();
    }
}catch(PDOException $e){
    echo $e;
}
?>