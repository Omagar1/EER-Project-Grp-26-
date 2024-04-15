<?php
require("dbConnect.php");
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
$userid = $_SESSION["userID"];
try{
    if (isset($_POST['save'])) {
        $sql = "INSERT INTO userSavedProperty (userID,propertyID)VALUES(:uid,:pid)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pid', $_REQUEST['pid'], PDO::PARAM_INT);
        $stmt->bindParam(':uid', $userid, PDO::PARAM_INT);
        $stmt->execute();
    }
}catch(PDOException $e){
    echo $e;
}
?>