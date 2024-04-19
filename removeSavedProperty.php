<?php
// Values are in seconds // lasts an hour
session_start([ 
    'cookie_lifetime' => 3600, 
    'gc_maxlifetime' => 3600, 
   ]);
require("dbConnect.php");
$userid = $_SESSION["userID"];
try{
    if (isset($_POST['unsave'])) {
        $sql = "DELETE FROM userSavedProperty WHERE userID=:uid AND propertyID = :pid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':uid', $userid, PDO::PARAM_INT);
        $stmt->bindParam(':pid', $_GET['pid'], PDO::PARAM_INT);
        $stmt->execute();
    }
}catch(PDOException $e){
    echo $e;
}
?>
