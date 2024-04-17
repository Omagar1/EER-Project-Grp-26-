<?php
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
require_once "notLoggedIn.php";
$userid = $_SESSION["userID"];
try{
    $sql1 = "SELECT userID,propertyID FROM userSavedProperty WHERE userID=:uid,propertyID=:pid";
    $result = $conn->prepare($sql1);
    $result->bindParam(':pid', $_REQUEST['pid'], PDO::PARAM_INT);
    $result->bindParam(':uid', $userid, PDO::PARAM_INT);
    $result->execute();
    if (isset($_POST['save']) && $result->rowCount() == 0) {
        $sql = "INSERT INTO userSavedProperty (userID,propertyID)VALUES(:uid,:pid)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pid', $_REQUEST['pid'], PDO::PARAM_INT);
        $stmt->bindParam(':uid', $userid, PDO::PARAM_INT);
        $stmt->execute();
    }
    header("location: userViewProperty.php");
}catch(PDOException $e){
    echo $e;
}
?>