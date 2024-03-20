<?php
$servername = "eer-sever.database.windows.net";//eer-sever
$username = "crrzbzscbr"; 
$password = "IS5YSO8T40G6780X$";
$dbname = "eer-db"; 

try {
  $conn = new PDO("mysql:host=$servername; dbname=$dbname; charset=utf8mb4", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully </br>"; //test
} catch(PDOException $e) {
  echo $e;
}
?>